<?php
namespace modules\sga\triagem;

use PDO;
use Exception;
use Novosga\Context;
use Novosga\Util\Arrays;
use Novosga\Util\DateUtil;
use Novosga\Http\JsonResponse;
use Novosga\Controller\ModuleController;
use Novosga\Business\AtendimentoBusiness;

/**
 * TriagemController
 *
 * @author Rogerio Lino <rogeriolino@gmail.com>
 */
class TriagemController extends ModuleController {

    
    public function index(Context $context) {
        $unidade = $context->getUser()->getUnidade();
        $this->app()->view()->set('unidade', $unidade);
        if ($unidade) {
            $this->app()->view()->set('servicos', $this->servicos($unidade));
        }
        $query = $this->em()->createQuery("SELECT e FROM Novosga\Model\Prioridade e WHERE e.status = 1 AND e.peso > 0 ORDER BY e.nome");
        $this->app()->view()->set('prioridades', $query->getResult());
    } 
    
    private function servicos(\Novosga\Model\Unidade $unidade) {
        $query = $this->em()->createQuery("SELECT e FROM Novosga\Model\ServicoUnidade e WHERE e.unidade = :unidade AND e.status = 1 ORDER BY e.nome");
        $query->setParameter('unidade', $unidade->getId());
        return $query->getResult();
    }
    
    public function imprimir(Context $context) {
        $id = (int) $context->request()->get('id');
        $atendimento = $this->em()->find("Novosga\Model\Atendimento", $id);
        if (!$atendimento) {
            $this->app()->redirect('index');
        }
        $context->response()->setRenderView(false);
        $this->app()->view()->set('atendimento', $atendimento);
        $this->app()->view()->set('data', DateUtil::now("d/m/Y H:i"));
    }
    
    public function ajax_update(Context $context) {
        $response = new JsonResponse();
        $unidade = $context->getUnidade();
        if ($unidade) {
            $ids = $context->request()->get('ids');
            $ids = Arrays::valuesToInt(explode(',', $ids));
            if (sizeof($ids)) {
                $conn = $this->em()->getConnection();
                $sql = "
                    SELECT 
                        servico_id as id, COUNT(*) as total 
                    FROM 
                        atendimentos
                    WHERE 
                        unidade_id = :unidade AND 
                        servico_id IN (" . implode(',', $ids) . ")
                ";
                // total senhas do servico (qualquer status)
                $stmt = $conn->prepare($sql . " GROUP BY servico_id");
                $stmt->bindValue('unidade', $unidade->getId(), PDO::PARAM_INT);
                $stmt->execute();
                $rs = $stmt->fetchAll();
                foreach ($rs as $r) {
                    $response->data[$r['id']] = array('total' => $r['total'], 'fila' => 0);
                }
                // total senhas esperando
                $stmt = $conn->prepare($sql . " AND status = :status GROUP BY servico_id");
                $stmt->bindValue('unidade', $unidade->getId(), PDO::PARAM_INT);
                $stmt->bindValue('status', AtendimentoBusiness::SENHA_EMITIDA, PDO::PARAM_INT);
                $stmt->execute();
                $rs = $stmt->fetchAll();
                foreach ($rs as $r) {
                    $response->data[$r['id']]['fila'] = $r['total'];
                }
                $response->success = true;
            }
        }
        return $response;
    }
    
    public function servico_info(Context $context) {
        $response = new JsonResponse();
        if ($context->request()->isPost()) {
            $id = (int) $context->request()->get('id');
            $servico = $this->em()->find("Novosga\Model\Servico", $id);
            if ($servico) {
                $response->data['nome'] = $servico->getNome();
                $response->data['descricao'] = $servico->getDescricao();
                // ultima senha
                $query = $this->em()->createQuery("SELECT e FROM Novosga\Model\Atendimento e JOIN e.servicoUnidade su WHERE su.servico = :servico AND su.unidade = :unidade ORDER BY e.numeroSenha DESC");
                $query->setParameter('servico', $servico->getId());
                $query->setParameter('unidade', $context->getUnidade()->getId());
                $atendimentos = $query->getResult();
                if (sizeof($atendimentos)) {
                    $response->data['senha'] = $atendimentos[0]->getSenha()->toString();
                    $response->data['senhaId'] = $atendimentos[0]->getId();
                } else {
                    $response->data['senha'] = '-';
                    $response->data['senhaId'] = '';
                }
                // subservicos
                $response->data['subservicos'] = array();
                $query = $this->em()->createQuery("SELECT e FROM Novosga\Model\Servico e WHERE e.mestre = :mestre ORDER BY e.nome");
                $query->setParameter('mestre', $servico->getId());
                $subservicos = $query->getResult();
                foreach ($subservicos as $s) {
                    $response->data['subservicos'][] = $s->getNome();
                }
            }
            $response->success = true;
        }
        return $response;
    }
    
    public function distribui_senha(Context $context) {
        $response = new JsonResponse();
        $unidade = $context->getUnidade();
        $usuario = $context->getUser();
        $servico = (int) $context->request()->post('servico');
        $prioridade = (int) $context->request()->post('prioridade');
        $nomeCliente = $context->request()->post('cli_nome', '');
        $documentoCliente = $context->request()->post('cli_doc', '');
        try {
            $ab = new AtendimentoBusiness($this->em());
            $response->data = $ab->distribuiSenha($unidade, $usuario, $servico, $prioridade, $nomeCliente, $documentoCliente);
            $response->success = true;
        } catch (Exception $e) {
            $response->message = $e->getMessage();
            $response->success = false;
        }
        return $response;
    }
    
    /**
     * Busca os atendimentos a partir do número da senha
     * @param Novosga\Context $context
     */
    public function consulta_senha(Context $context) {
        $response = new JsonResponse();
        $unidade = $context->getUser()->getUnidade();
        if ($unidade) {
            $numero = $context->request()->get('numero');
            $ab = new AtendimentoBusiness($this->em());
            $atendimentos = $ab->buscaAtendimentos($unidade, $numero);
            $response->data['total'] = sizeof($atendimentos);
            foreach ($atendimentos as $atendimento) {
                $response->data['atendimentos'][] = $atendimento->toArray();
            }
            $response->success = true;
        } else{
            $response->message = _('Nenhuma unidade selecionada');
        }
        return $response;
    }
    
}
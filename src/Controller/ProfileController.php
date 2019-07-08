<?php

/*
 * This file is part of the Novo SGA project.
 *
 * (c) Rogerio Lino <rogeriolino@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Controller;

use App\Form\ProfileType;
use App\Form\AccountType;
use App\Form\AccessTokenType;
use App\Entity\AccessToken;
use Exception;
use Novosga\Http\Envelope;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;
use Symfony\Component\Translation\TranslatorInterface;

/**
 * @Route("/profile")
 */
class ProfileController extends AbstractController
{
    /**
     * @Route("/", name="profile_index", methods={"GET", "POST"})
     */
    public function index(Request $request, TranslatorInterface $translator)
    {
        $user = $this->getUser();
        $form = $this
            ->createForm(ProfileType::class, $user)
            ->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->merge($user);
            $em->flush();
            
            $this->addFlash('success', $translator->trans('Perfil atualizado com sucesso!'));

            return $this->redirectToRoute('profile_index');
        }
        
        return $this->render('profile/index.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/lotacoes", name="profile_lotacoes", methods={"GET", "POST"})
     */
    public function lotacoes(Request $request, TranslatorInterface $translator)
    {
        $user = $this->getUser();
        
        return $this->render('profile/lotacoes.html.twig', [
            'user' => $user,
        ]);
    }

    /**
     * @Route("/account", name="profile_account", methods={"GET", "POST"})
     */
    public function account(Request $request, EncoderFactoryInterface $factory, TranslatorInterface $translator)
    {
        $user    = $this->getUser();
        $encoder = $factory->getEncoder($user);
        $salt    = $user->getSalt();
        $form    = $this
            ->createForm(AccountType::class)
            ->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $current      = $form->get('plainPassword')->getData();
            $password     = $form->get('newPassword')->get('first')->getData();
            $confirmation = $form->get('newPassword')->get('second')->getData();

            try {
                if (!$encoder->isPasswordValid($user->getPassword(), $current, $salt)) {
                    throw new Exception('A senha atual informada não confere.');
                }
                
                if (strlen($password) < 6) {
                    throw new Exception(sprintf('A nova senha precisa ter no mínimo %s caraceteres.', 6));
                }
        
                $encoded = $encoder->encodePassword($password, $salt);
                $user->setSenha($encoded);

                $em = $this->getDoctrine()->getManager();
                $em->merge($user);
                $em->flush();
                
                $this->addFlash('success', $translator->trans('Senha alterada com sucesso!'));

                return $this->redirectToRoute('profile_account');
            } catch (Exception $e) {
                $this->addFlash('error', $translator->trans($e->getMessage()));
            }
        }
        
        return $this->render('profile/account.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/access-tokens", name="profile_tokens", methods={"GET", "POST"})
     */
    public function accessTokens(Request $request, TranslatorInterface $translator)
    {
        $em    = $this->getDoctrine()->getManager();
        $user  = $this->getUser();
        $token = new AccessToken();
        $form  = $this
            ->createForm(AccessTokenType::class, $token)
            ->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $permissions = $form->get('permissions')->getData();
            $permission  = \array_sum($permissions);
            $hash        = substr(md5(time()), 0, 20);

            $token
                ->setToken($hash)
                ->setPermission($permission)
                ->setUser($user);

            $em->persist($token);
            $em->flush();
            
            $this->addFlash('success', $translator->trans('Token criado com sucesso!'));

            return $this->redirectToRoute('profile_tokens');
        }

        $permissionsChoices   = $form->get('permissions')->getConfig()->getOption('choices');
        $availablePermissions = \array_flip($permissionsChoices);

        $tokens = $em
            ->getRepository(AccessToken::class)
            ->findBy([
                'user'      => $user,
                'deletedAt' => null,
            ]);
        
        return $this->render('profile/access_tokens.html.twig', [
            'user'                 => $user,
            'tokens'               => $tokens,
            'form'                 => $form->createView(),
            'availablePermissions' => $availablePermissions,
        ]);
    }

    /**
     * @Route("/access-tokens/{id}", name="profile_tokens_delete", methods={"GET", "POST"})
     */
    public function removeAccessToken(Request $request, TranslatorInterface $translator, AccessToken $token)
    {
        $em    = $this->getDoctrine()->getManager();
        $user  = $this->getUser();

        if ($user === $token->getUser()) {
            $token->setDeletedAt(new \DateTime());
    
            $em->merge($token);
            $em->flush();

            $this->addFlash('success', $translator->trans('Token removido com sucesso!'));
        }

        return $this->redirectToRoute('profile_tokens');
    }
}

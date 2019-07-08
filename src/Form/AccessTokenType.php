<?php

namespace App\Form;

use App\Entity\AccessToken;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\NotNull;

class AccessTokenType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $helpMessages = [
            AccessToken::API_READ    => 'Concede acesso de leitura aos recursos da API',
            AccessToken::API_WRITE   => 'Concede acesso de alteração aos recursos da API',
            AccessToken::API_CREATE  => 'Concede acesso de criação aos recursos da API',
            AccessToken::API_DELETE  => 'Concede acesso de exclusão aos recursos da API',
        ];

        $builder
            ->add('name', TextType::class, [
                'constraints' => [
                    new NotBlank(),
                ]
            ])
            ->add('expiresAt', DateTimeType::class, [
                'widget'   => 'single_text',
                'required' => false,
            ])
            ->add('permissions', ChoiceType::class, [
                'mapped'   => false,
                'required' => false,
                'expanded' => true,
                'multiple' => true,
                'choices'  => [
                    'API Read'   => AccessToken::API_READ,
                    'API Write'  => AccessToken::API_WRITE,
                    'API Create' => AccessToken::API_CREATE,
                    'API Delete' => AccessToken::API_DELETE,
                ],
                'choice_attr' => function ($choice, $key, $value) use ($helpMessages) {
                    return [
                        'help' => $helpMessages[$value],
                    ];
                },
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => AccessToken::class,
        ]);
    }
}

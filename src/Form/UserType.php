<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username')
            ->add('password',PasswordType::class)
            ->add('roles',
                ChoiceType::class, [
                    'choices'=>[
                        'ROLE_ADMIN'=>'ROLE_ADMIN',
                        'ROLE_USER'=>'ROLE_USER',
                        'ROLE_SUPER_ADMIN'=>'ROLE_SUPER_ADMIN'
                    ],
                    'expanded'=>true,
                    'multiple'=>true,
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}

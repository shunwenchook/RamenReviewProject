<?php

namespace App\Form;

use App\Entity\Ramen;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RamenType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('photo')
            ->add('description')
            ->add('ingrediants')
            ->add('public')
            ->add('pricerange', ChoiceType::class, [
                'choices' => [
                    'under 5'=>'under 5',
                    '6 - 9'=>'6 - 9',
                    '10 - 14'=>'10 - 14',
                    '15 - 19'=>'15 - 19',
                    '20 - 39'=>'20 - 39',
                ]
            ])
            ->add('user', EntityType::class,[
                'class' => 'App:User',
                'choice_label'=>'username',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Ramen::class,
        ]);
    }
}

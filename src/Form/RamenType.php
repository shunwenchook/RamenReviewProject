<?php

namespace App\Form;

use App\Entity\Ramen;
use Symfony\Component\Form\AbstractType;
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
            ->add('pricerange')
            ->add('score')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Ramen::class,
        ]);
    }
}

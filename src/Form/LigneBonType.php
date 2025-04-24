<?php

namespace App\Form;

use App\Entity\LigneBon;
use App\Entity\Produit;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LigneBonType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('produit', EntityType::class, [
                'class' => Produit::class,
                'choice_label' => 'name',
                'required' => true,
                'placeholder'=>'Choisir un produit',
            ])
            ->add('quantity', null, [
                'required' => true,
                    'attr' => [
                        'min' => 1,
                    ],
            ]
            )
            ->add('prixUnitaire', NumberType::class, [
                'required' => true,
                    'attr' => [
                        'min' => 1,
                    ],
            ])
            ->add('remise', NumberType::class, [
                    'attr' => [
                        'min' => 0,
                    ],
                   'required' => false,
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => LigneBon::class,
        ]);
    }
}

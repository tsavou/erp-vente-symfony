<?php

namespace App\Form;

use App\Entity\BonLivraison;
use App\Entity\Client;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BonLivraisonType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('dateLivraison', null, [
                'widget' => 'single_text',
                'label' => 'Date de livraison'
            ])
            ->add('client', EntityType::class, [
                'class' => Client::class,
                'choice_label' => 'name',
                'placeholder' => 'Choisir un client',
                'label' => 'Client',
                'required' => true,
            ])
            ->add('ligneBons', CollectionType::class, [
                'entry_type' => LigneBonType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
                'prototype' => true,
                'prototype_name' => '__name__',
                'label' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => BonLivraison::class,
        ]);
    }
}

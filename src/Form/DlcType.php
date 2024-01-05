<?php

namespace App\Form;

use App\Entity\Dlc;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;


use App\Form\DetailType;
use App\Entity\Game;

class DlcType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', null, [
                'label' => "Nom",
                'attr' => [
                    'class' => 'mb-3 form-control',
                ],
            ])
            ->add('game', EntityType::class, [
                'class' => Game::class,
                'choice_label' => 'name',
                'multiple' => false,
                'label' => "Jeu de base",
                'placeholder' => 'null',
                'required' => false,
                'attr' => [
                    'class' => 'mb-3 form-select',
                ],
                'empty_data' => null,
            ])
            ->add('detail', DetailType::class, [
                'label' => false,
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Valider',
                'attr' => [
                    'class' => 'btn btn-outline-success mt-3',
                    'style' => 'width:200px'
                ],
            ]);
    }
}

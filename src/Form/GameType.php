<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

use App\Entity\Game;
use App\Entity\Tag;
use App\Entity\Dlc;
use App\Entity\Developer;
use App\Form\DetailType;

class GameType extends AbstractType
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
            ->add('status', ChoiceType::class, [
                'choices' => [
                    'Libéré' => 'released',
                    'Inédit' => 'unreleased',
                    'Retiré' => 'withdrawn',
                ],
                'label' => "Etat",
                'attr' => [
                    'class' => 'mb-3 form-select',
                ],
            ])
            ->add('developer', EntityType::class, [
                'class' => Developer::class,
                'choice_label' => 'name',
                'multiple' => false,
                'label' => "Développer",
                'attr' => [
                    'class' => 'mb-3 form-select',
                ],
            ])
            ->add('tags', EntityType::class, [
                'class' => Tag::class,
                'choice_label' => 'name',
                'multiple' => true,
                'expanded' => true,
                'attr' => [
                    'class' => 'mb-3 form-check',
                ]
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

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Game::class,
        ]);
    }
}

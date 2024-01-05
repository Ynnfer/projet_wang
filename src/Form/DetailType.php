<?php

namespace App\Form;

use App\Entity\Detail;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\NumberType;

class DetailType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('description', null, [
                'label' => "Description",
                'attr' => [
                    'class' => 'mb-2 form-control',
                ]
            ])
            ->add('image', null, [
                'label' => "Lien vers l'image",
                'attr' => [
                    'class' => 'mb-2 form-control',
                ],
            ])
            ->add('price', NumberType::class, [
                'label' => "Prix",
                'scale' => 2,
                'attr' => [
                    'class' => 'mb-2 form-control',
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Detail::class,
        ]);
    }
}

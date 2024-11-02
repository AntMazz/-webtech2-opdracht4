<?php

namespace App\Form;

use App\Entity\Boek;
use App\Entity\Klant;
use App\Entity\Uitlening;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UitleningType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('uitgeleend_op', null, [
                'widget' => 'single_text',
            ])
            ->add('teruggebracht_op', null, [
                'widget' => 'single_text',
            ])
            ->add('klant', EntityType::class, [
                'class' => Klant::class,
                'choice_label' => 'id',
            ])
            ->add('boek', EntityType::class, [
                'class' => Boek::class,
                'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Uitlening::class,
        ]);
    }
}
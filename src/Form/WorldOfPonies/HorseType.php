<?php

namespace App\Form\WorldOfPonies;

use App\Entity\WorldOfPonies\Horse;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class HorseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('horseName')
            ->add('horseDiseaseResistance')
            ->add('horseHygieneResistance')
            ->add('horseRecovery')
            ->add('horseStamina')
            ->add('horseJumpheight')
            ->add('horseSpeed')
            ->add('horseSociability')
            ->add('horseIntelligence')
            ->add('horseTemper')
            ->add('horseHealthState')
            ->add('horseMoralState')
            ->add('horseStressState')
            ->add('horseTirednessState')
            ->add('horseHungerState')
            ->add('horseCleaninessState')
            ->add('player')
            ->add('infrastructure')
            ->add('breed')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Horse::class,
        ]);
    }
}

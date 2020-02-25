<?php

namespace App\Form\WorldOfPonies;

use App\Entity\WorldOfPonies\Infrastructure;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InfrastructureType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('infrastructureType')
            ->add('infrastructureLvl')
            ->add('infrastructureDescription')
            ->add('infrastructureFamily')
            ->add('infrastructurePrice')
            ->add('infrastructureRessource')
            ->add('infrastructureItemCapacity')
            ->add('infrastructureHorseCapacity')
            ->add('infrastructureCleaninessDegree')
            ->add('horseclub')
            ->add('equestriancenter')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Infrastructure::class,
        ]);
    }
}

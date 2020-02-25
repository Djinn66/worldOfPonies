<?php

namespace App\Form\WorldOfPonies;

use App\Entity\WorldOfPonies\Newspaper;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class NewspaperType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('weatherforecast')
            ->add('releaseDate')
            ->add('player')
            ->add('advertisements')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Newspaper::class,
        ]);
    }
}

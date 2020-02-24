<?php

namespace App\Form;

use App\Entity\AutomaticTask;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AutomaticTaskType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('taskToDo')
            ->add('taskFrequency')
            ->add('item')
            ->add('equestriancenter')
            ->add('player')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => AutomaticTask::class,
        ]);
    }
}

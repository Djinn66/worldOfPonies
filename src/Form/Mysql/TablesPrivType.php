<?php

namespace App\Form\Mysql;

use App\Entity\Mysql\TablesPriv;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TablesPrivType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('host')
            ->add('db')
            ->add('user')
            ->add('tableName')
            ->add('grantor')
           // ->add('timestamp', DateTimeType::class)
            ->add('tablePriv')
            ->add('columnPriv')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => TablesPriv::class,
        ]);
    }
}

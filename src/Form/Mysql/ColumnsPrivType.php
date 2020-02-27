<?php

namespace App\Form\Mysql;

use App\Entity\Mysql\ColumnsPriv;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class ColumnsPrivType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('host')
            ->add('db')
            ->add('user')
            ->add('tableName')
            ->add('columnName')
            //->add('timestamp',DateTimeType::class)
            ->add('columnPriv')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ColumnsPriv::class,
        ]);
    }
}

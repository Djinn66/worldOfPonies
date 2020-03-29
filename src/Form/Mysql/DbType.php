<?php

namespace App\Form\Mysql;

use App\Entity\Mysql\Db;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DbType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $db = new Db();
        $builder
            ->add('host')
            ->add('db')
            ->add('user')
            ->add('allPrivileges',ChoiceType::class,[
                    'choices'=> $db->allPrivileges,
                    'multiple'=>true,
                    'expanded'=>false,
                    'required'=> false
                ]
            )
            /*->add('selectPriv')
            ->add('insertPriv')
            ->add('updatePriv')
            ->add('deletePriv')
            ->add('createPriv')
            ->add('dropPriv')
            ->add('grantPriv')
            ->add('referencesPriv')
            ->add('indexPriv')
            ->add('alterPriv')
            ->add('createTmpTablePriv')
            ->add('lockTablesPriv')
            ->add('createViewPriv')
            ->add('showViewPriv')
            ->add('createRoutinePriv')
            ->add('alterRoutinePriv')
            ->add('executePriv')
            ->add('eventPriv')
            ->add('triggerPriv')*/
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Db::class,
        ]);
    }
}

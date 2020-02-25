<?php

namespace App\Form\Mysql;

use App\Entity\Mysql\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $user = new User();
        $builder
            ->add('host')
            ->add('user')
            ->add('password',PasswordType::class)
            ->add('allPrivileges',ChoiceType::class,[
                    'choices'=> $user->allPrivileges,
                    'multiple'=>true,
                    'expanded'=>false,
                    'required'=> false
                ]
            )
            //->add('sslType')
            ->add('sslCipher')
            ->add('x509Issuer')
            ->add('x509Subject')
            ->add('maxQuestions')
            ->add('maxUpdates')
            ->add('maxConnections')
            ->add('maxUserConnections')
            //->add('plugin')
            //->add('authenticationString')
            ->add('passwordExpired')
            ->add('isRole')
            //->add('defaultRole')
            //->add('maxStatementTime')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }

}

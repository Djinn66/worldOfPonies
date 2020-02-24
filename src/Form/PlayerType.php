<?php

namespace App\Form;

use App\Entity\Player;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PlayerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('playerUsername')
            ->add('playerEmail')
            ->add('playerPwd')
            ->add('playerFirstname')
            ->add('playerLastname')
            ->add('playerGender')
            ->add('playerBirthDate')
            ->add('playerPhonenumber')
            ->add('playerAddress')
            ->add('playerAvatar')
            ->add('playerDescription')
            ->add('playerWebsite')
            ->add('playerFunds')
            ->add('playerIp')
            ->add('playerInscriptionDate')
            ->add('playerLastconnectionDate')
            ->add('contests')
            ->add('horseclubs')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Player::class,
        ]);
    }
}

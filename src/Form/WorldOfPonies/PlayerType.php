<?php

namespace App\Form\WorldOfPonies;

use App\Entity\WorldOfPonies\Player;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PlayerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('playerUsername')
            ->add('playerEmail')
            //->add('playerPwd',PasswordType::class,['required'=> false])
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

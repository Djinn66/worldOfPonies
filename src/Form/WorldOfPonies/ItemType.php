<?php

namespace App\Form\WorldOfPonies;

use App\Entity\WorldOfPonies\Item;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ItemType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('itemLvl')
            ->add('itemDescription')
            ->add('itemPrice')
            ->add('contest')
            ->add('itemfamily')
            ->add('infrastruture')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Item::class,
        ]);
    }
}

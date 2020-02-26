<?php

namespace App\DataFixtures;


use App\Entity\WorldOfPonies\Item;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class ItemFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');
        for($i = 0 ; $i < 100; ++$i)
        {
            $item = new Item();
            $item
                ->setItemLvl($faker->randomDigit)
                ->setItemDescription($faker->text(254))
                ->setItemPrice($faker->randomDigit)
                ->setContest()
                ->setItemfamily()
                ->setInfrastruture();

            $manager->persist($breed);
        }
        $manager->flush();
    }
}

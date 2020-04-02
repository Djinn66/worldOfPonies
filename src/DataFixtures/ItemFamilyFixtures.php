<?php

namespace App\DataFixtures;

use App\Entity\WorldOfPonies\ItemFamily;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class ItemFamilyFixtures extends Fixture implements FixtureGroupInterface
{
    public function load(ObjectManager $manager)
    {
        for($i = 0 ; $i<100000; ++$i )
        {
        $faker = Factory::create('fr_FR');

            $itemFamily = new ItemFamily();
            $itemFamily
                ->setItemFamilyLabel($faker->word);

            $manager->persist($itemFamily);

            $manager->flush();
            echo "Item Family : ".$i."\r\n";
        }

    }
    public static function getGroups(): array
    {
        return ['group1'];
    }
}

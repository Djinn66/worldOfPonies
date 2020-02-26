<?php

namespace App\DataFixtures;

use App\Entity\WorldOfPonies\ItemFamily;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class ItemFamilyFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');
        for($i = 0 ; $i<100; $i++ )
        {
            $itemFamily = new ItemFamily();
            $itemFamily
                ->setItemFamilyLabel($faker->word);

            $manager->persist($itemFamily);
        }


        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}

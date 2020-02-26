<?php

namespace App\DataFixtures;

use App\Entity\WorldOfPonies\Breed;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class BreedFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');
        for($i = 0 ; $i < 100; ++$i)
        {
            $breed = new Breed();
            $breed
                ->setBreedName($faker->word)
                ->setBreedDescription($faker->text(35));

            $manager->persist($breed);
        }
        $manager->flush();
    }
}

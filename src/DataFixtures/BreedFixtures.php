<?php

namespace App\DataFixtures;

use App\Entity\WorldOfPonies\Breed;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class BreedFixtures extends Fixture implements FixtureGroupInterface
{
    public function load(ObjectManager $manager)
    {
        for ($j = 0 ; $j < 100000; ++$j) {
            $faker = Factory::create('fr_FR');

            $breed = new Breed();
            $breed
                ->setBreedName($faker->unique()->word)
                ->setBreedDescription($faker->text(35));

            $manager->persist($breed);

            $manager->flush();
            echo "Breed : ".$j."\r\n";
        }
    }
    public static function getGroups(): array
    {
        return ['group1'];
    }
}

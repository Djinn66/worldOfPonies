<?php

namespace App\DataFixtures;

use App\Entity\WorldOfPonies\Horse;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class HorseFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');
        for($i = 0 ; $i < 100; ++$i)
        {
            $horse = new Horse();
            $horse
                ->setHorseName($faker->word)
                ->setHorseDiseaseResistance($faker->randomDigit)
                ->setHorseHygieneResistance($faker->randomDigit)
                ->setHorseRecovery($faker->randomDigit)
                ->setHorseStamina($faker->randomDigit)
                ->setHorseJumpheight($faker->randomDigit)
                ->setHorseSpeed($faker->randomDigit)
                ->setHorseSociability($faker->randomDigit)
                ->setHorseIntelligence($faker->randomDigit)
                ->setHorseHealthState($faker->randomDigit)
                ->setHorseMoralState($faker->randomDigit)
                ->setHorseStressState($faker->randomDigit)
                ->setHorseTirednessState($faker->randomDigit)
                ->setHorseHungerState($faker->randomDigit)
                ->setHorseCleaninessState($faker->randomDigit)
                ->setPlayer()
                ->setInfrastructure()
                ->setBreed();

            $manager->persist($horse);
        }
        $manager->flush();
    }
}

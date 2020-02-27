<?php

namespace App\DataFixtures;

use App\Entity\WorldOfPonies\Breed;
use App\Entity\WorldOfPonies\Horse;
use App\Entity\WorldOfPonies\Infrastructure;
use App\Entity\WorldOfPonies\Player;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class HorseFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');
        $players = $manager->getRepository(Player::class)->findAll();
        $infrastructures = $manager->getRepository(Infrastructure::class)->findAll();
        $breeds = $manager->getRepository(Breed::class)->findAll();

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
                ->setHorseTemper($faker->randomDigit)
                ->setHorseHealthState($faker->randomDigit)
                ->setHorseMoralState($faker->randomDigit)
                ->setHorseStressState($faker->randomDigit)
                ->setHorseTirednessState($faker->randomDigit)
                ->setHorseHungerState($faker->randomDigit)
                ->setHorseCleaninessState($faker->randomDigit)
                ->setPlayer($faker->randomElement($players))
                ->setInfrastructure($faker->randomElement($infrastructures))
                ->setBreed($faker->randomElement($breeds));

            $manager->persist($horse);
        }
        $manager->flush();
    }

    /**
     * @inheritDoc
     */
    public function getDependencies()
    {
        return array(
            PlayerFixtures::class,
            InfrastructureFixtures::class,
            BreedFixtures::class,
        );
    }
}

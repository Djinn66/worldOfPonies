<?php

namespace App\DataFixtures;

use App\Entity\WorldOfPonies\Contest;
use App\Entity\WorldOfPonies\HorseClub;
use App\Entity\WorldOfPonies\Infrastructure;
use App\Entity\WorldOfPonies\Newspaper;
use App\Entity\WorldOfPonies\Player;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class ContestFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');
        $horseclubs = $manager->getRepository(HorseClub::class)->findAll();
        $infrastructures = $manager->getRepository(Infrastructure::class)->findAll();
        $newspapers = $manager->getRepository(Newspaper::class)->findAll();
        $players = $manager->getRepository(Player::class)->findAll();

        for($i = 0 ; $i < 100000; ++$i)
        {
            $contest = new Contest();
            $contest
                ->setStartDate($faker->dateTime)
                ->setEndDate($faker->dateTime)
                ->setPrice($faker->randomDigitNotNull)
                ->setHorseclub($faker->randomElement($horseclubs))
                ->setInfrastructure($faker->randomElement($infrastructures))
                ->setNewspaper($faker->randomElement($newspapers));

           for($i = 0; $i < $faker->numberBetween(5,10); ++$i)
            {
                $contest->addPlayer($faker->randomElement($players));
            }

            $manager->persist($contest);
        }
        $manager->flush();
    }

    /**
     * @inheritDoc
     */
    public function getDependencies()
    {
        return array(
            HorseClubFixtures::class,
            InfrastructureFixtures::class,
            NewspaperFixtures::class,
            PlayerFixtures::class,
        );
    }
}

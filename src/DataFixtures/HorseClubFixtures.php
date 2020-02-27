<?php

namespace App\DataFixtures;

use App\Entity\WorldOfPonies\HorseClub;
use App\Entity\WorldOfPonies\Player;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class HorseClubFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');
        $managers = $manager->getRepository(Player::class)->findAll();

        for($i = 0 ; $i < 100; ++$i)
        {
            $horseClub = new HorseClub();
            $horseClub
                ->setHorseClubCapacity($faker->randomDigit)
                ->setManager($faker->randomElement($managers));

            $manager->persist($horseClub);
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
        );
    }
}

<?php

namespace App\DataFixtures;

use App\Entity\WorldOfPonies\HorseClub;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class HorseClubFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');
        for($i = 0 ; $i < 100; ++$i)
        {
            $horseClub = new HorseClub();
            $horseClub
                ->setHorseClubCapacity($faker->randomDigit)
                ->setManager();

            $manager->persist($horseClub);
        }
        $manager->flush();
    }
}

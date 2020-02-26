<?php

namespace App\DataFixtures;

use App\Entity\WorldOfPonies\Contest;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class ContestFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');
        for($i = 0 ; $i < 100; ++$i)
        {
            $contest = new Contest();
            $contest
                ->setStartDate($faker->dateTime)
                ->setEndDate($faker->dateTime)
                ->setPrice($faker->randomDigitNotNull);

            $manager->persist($contest);
        }
        $manager->flush();
    }
}

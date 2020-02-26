<?php

namespace App\DataFixtures;

use App\Entity\WorldOfPonies\Newspaper;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class NewspaperFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');
        for($i = 0 ; $i < 100; ++$i)
        {
            $newspaper = new Newspaper();
            $newspaper
                ->setPlayer()
                ->setReleaseDate($faker->dateTime)
                ->setWeatherforecast($faker->word);

            $manager->persist($newspaper);
        }
        $manager->flush();
    }
}

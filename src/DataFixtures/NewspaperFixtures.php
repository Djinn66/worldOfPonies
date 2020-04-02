<?php

namespace App\DataFixtures;

use App\Entity\WorldOfPonies\Advertisement;
use App\Entity\WorldOfPonies\Newspaper;
use App\Entity\WorldOfPonies\Player;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class NewspaperFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');

        $players = $manager->getRepository(Player::class)->findAll();
        $advertisement = $manager->getRepository(Advertisement::class)->findAll();

        for($i = 0 ; $i < 100000; ++$i)
        {
            $newspaper = new Newspaper();
            $newspaper
                ->setReleaseDate(\DateTime::createFromFormat('Y-m-d', $faker->date($format = 'Y-m-d', $max = 'now')))
                ->setWeatherforecast($faker->randomDigit)
                ->setPlayer($faker->randomElement($players));

            /*for($i = 0; $i < 100000; ++$i)
            {
                $newspaper->addAdvertisement($faker->randomElement($advertisement));
            }*/

            $manager->persist($newspaper);
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
            AdvertisementFixtures::class,
        );
    }
}

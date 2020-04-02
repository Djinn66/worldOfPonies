<?php

namespace App\DataFixtures;

use App\Entity\WorldOfPonies\Advertisement;
use App\Entity\WorldOfPonies\Newspaper;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class AdvertisementFixtures extends Fixture implements FixtureGroupInterface
{
    public function load(ObjectManager $manager)
    {
        for($i = 0 ; $i < 100000; ++$i)
        {
        $faker = Factory::create('fr_FR');


            $advertisement = new Advertisement();
            $advertisement
                ->setAdvertisementContent($faker->text(63));

            $manager->persist($advertisement);
            $manager->flush();
            echo "Advertisement : ".$i."\r\n";
        }

    }

    /**
     * @inheritDoc
     */
    public static function getGroups(): array
    {
        return ['group1'];
    }
}

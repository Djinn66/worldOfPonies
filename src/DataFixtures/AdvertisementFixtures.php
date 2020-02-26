<?php

namespace App\DataFixtures;

use App\Entity\WorldOfPonies\Advertisement;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class AdvertisementFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');
        for($i = 0 ; $i < 100; ++$i)
        {
            $advertisement = new Advertisement();
            $advertisement
                ->setAdvertisementContent($faker->text(63));

            $manager->persist($advertisement);
        }
        $manager->flush();
    }
}

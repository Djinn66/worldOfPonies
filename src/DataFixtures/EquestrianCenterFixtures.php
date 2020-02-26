<?php

namespace App\DataFixtures;

use App\Entity\WorldOfPonies\EquestrianCenter;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class EquestrianCenterFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');
        for($i = 0 ; $i < 100; ++$i)
        {
            $equestrianCenter = new EquestrianCenter();
            $equestrianCenter
                ->setEquestrianCenterCapacity($faker->randomDigit)
                ->setOwner();

            $manager->persist($equestrianCenter);
        }
        $manager->flush();
    }
}

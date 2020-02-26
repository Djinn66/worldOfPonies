<?php

namespace App\DataFixtures;

use App\Entity\WorldOfPonies\Infrastructure;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class InfrastructureFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');
        for($i = 0 ; $i < 100; ++$i)
        {
            $infrastructure = new Infrastructure();
            $infrastructure
                ->setInfrastructureType($faker->word)
                ->setInfrastructureType($faker->word)
                ->setInfrastructureLvl($faker->randomDigit)
                ->setInfrastructureDescription($faker->text(254))
                ->setInfrastructureFamily($faker->word)
                ->setInfrastructurePrice($faker->randomDigit)
                ->setInfrastructureRessource($faker->randomDigit)
                ->setInfrastructureItemCapacity($faker->randomDigit)
                ->setInfrastructureCleaninessDegree($faker->randomDigit);

            $manager->persist($infrastructure);
        }
        $manager->flush();
    }
}

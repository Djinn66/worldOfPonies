<?php

namespace App\DataFixtures;

use App\Entity\WorldOfPonies\EquestrianCenter;
use App\Entity\WorldOfPonies\HorseClub;
use App\Entity\WorldOfPonies\Infrastructure;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class InfrastructureFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');
        $equestriancenters = $manager->getRepository(EquestrianCenter::class)->findAll();
        $horseclubs = $manager->getRepository(HorseClub::class)->findAll();

        for($i = 0 ; $i < 100000; ++$i)
        {
            $infrastructure = new Infrastructure();
            $infrastructure
                ->setInfrastructureType($faker->word)
                ->setInfrastructureLvl($faker->randomDigit)
                ->setInfrastructureDescription($faker->text(254))
                ->setInfrastructureFamily($faker->word)
                ->setInfrastructurePrice($faker->numberBetween(100,100000))
                ->setInfrastructureRessource($faker->randomDigit)
                ->setInfrastructureItemCapacity($faker->randomDigit)
                ->setInfrastructureCleaninessDegree($faker->randomDigit)
                ->setInfrastructureHorseCapacity($faker->numberBetween(2,10));

            if (rand(0,1)==0)
            {
                $infrastructure->setHorseclub($faker->randomElement($horseclubs));
            }
            else
            {
                $infrastructure->setEquestriancenter($faker->randomElement($equestriancenters));
            }


            $manager->persist($infrastructure);
        }
        $manager->flush();
    }

    /**
     * @inheritDoc
     */
    public function getDependencies()
    {
        return array(
            EquestrianCenterFixtures::class,
            HorseClubFixtures::class,
        );
    }
}

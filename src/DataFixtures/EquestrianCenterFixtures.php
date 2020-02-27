<?php

namespace App\DataFixtures;

use App\Entity\WorldOfPonies\EquestrianCenter;
use App\Entity\WorldOfPonies\Player;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class EquestrianCenterFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');
        $owner = $manager->getRepository(Player::class)->findAll();

        for($i = 0 ; $i < 100; ++$i)
        {
            $equestrianCenter = new EquestrianCenter();
            $equestrianCenter
                ->setEquestrianCenterCapacity($faker->randomDigit)
                ->setOwner($faker->randomElement($owner));

            $manager->persist($equestrianCenter);
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

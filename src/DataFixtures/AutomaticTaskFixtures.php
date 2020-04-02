<?php

namespace App\DataFixtures;

use App\Entity\WorldOfPonies\AutomaticTask;
use App\Entity\WorldOfPonies\EquestrianCenter;
use App\Entity\WorldOfPonies\Item;
use App\Entity\WorldOfPonies\Player;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class AutomaticTaskFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');
        $items = $manager->getRepository(Item::class)->findAll();
        $equestrianCenters = $manager->getRepository(EquestrianCenter::class)->findAll();
        $players = $manager->getRepository(Player::class)->findAll();

        for($i = 0 ; $i < 100000; ++$i)
        {
            $automaticTask = new AutomaticTask();
            $automaticTask
                ->setTaskToDo($faker->word)
                ->setTaskFrequency($faker->randomDigitNotNull)
                ->setItem($faker->randomElement($items))
                ->setEquestriancenter($faker->randomElement($equestrianCenters))
                ->setPlayer($faker->randomElement($players));

            $manager->persist($automaticTask);
        }
        $manager->flush();
    }

    /**
     * @inheritDoc
     */
    public function getDependencies()
    {
        return array(
            ItemFixtures::class,
            EquestrianCenterFixtures::class,
            PlayerFixtures::class,
        );
    }
}

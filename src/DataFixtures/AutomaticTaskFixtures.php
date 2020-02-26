<?php

namespace App\DataFixtures;

use App\Entity\WorldOfPonies\AutomaticTask;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class AutomaticTaskFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');
        for($i = 0 ; $i < 100; ++$i)
        {
            $automaticTask = new AutomaticTask();
            $automaticTask
                ->setTaskToDo($faker->word)
                ->setTaskFrequency($faker->randomDigitNotNull)
                ->setItem()
                ->setEquestriancenter()
                ->setPlayer();

            $manager->persist($automaticTask);
        }
        $manager->flush();
    }
}

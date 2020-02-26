<?php

namespace App\DataFixtures;

use App\Entity\WorldOfPonies\Article;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class ArticleFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');
        for($i = 0 ; $i < 100; ++$i)
        {
            $horse = new Article();
            $horse
                ->setTitle($faker->word)
                ->setDescription($faker->word)
                ->setNewspaper();

            $manager->persist($horse);
        }
        $manager->flush();
    }
}

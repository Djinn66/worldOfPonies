<?php

namespace App\DataFixtures;

use App\Entity\WorldOfPonies\Article;
use App\Entity\WorldOfPonies\Newspaper;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class ArticleFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');
        $newspapers = $manager->getRepository(Newspaper::class)->findAll();
        for($i = 0 ; $i < 100; ++$i)
        {
            $horse = new Article();
            $horse
                ->setTitle($faker->word)
                ->setDescription($faker->word)
                ->setImage($faker->imageUrl($width = 640, $height = 480))
                ->setNewspaper($faker->randomElement($newspapers));

            $manager->persist($horse);
        }
        $manager->flush();
    }

    /**
     * @inheritDoc
     */
    public function getDependencies()
    {
        return array(
            NewspaperFixtures::class,
        );
    }
}

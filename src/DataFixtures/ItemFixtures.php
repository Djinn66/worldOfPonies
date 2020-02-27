<?php

namespace App\DataFixtures;


use App\Entity\WorldOfPonies\Contest;
use App\Entity\WorldOfPonies\Infrastructure;
use App\Entity\WorldOfPonies\Item;
use App\Entity\WorldOfPonies\ItemFamily;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class ItemFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');
        $infrastructures = $manager->getRepository(Infrastructure::class)->findAll();
        $contests = $manager->getRepository(Contest::class)->findAll();
        $itemFamilies = $manager->getRepository(ItemFamily::class)->findAll();

        for($i = 0 ; $i < 100; ++$i)
        {
            $item = new Item();
            $item
                ->setItemLvl($faker->randomDigit)
                ->setItemDescription($faker->text(254))
                ->setItemPrice($faker->randomDigit)
                ->setContest($faker->randomElement($array = array (null,$faker->randomElement($contests))))
                ->setItemfamily($faker->randomElement($itemFamilies))
                ->setInfrastruture($faker->randomElement($array = array (null,$faker->randomElement($infrastructures))));

            $manager->persist($item);
        }
        $manager->flush();
    }

    /**
     * @inheritDoc
     */
    public function getDependencies()
    {
        return array(
            InfrastructureFixtures::class,
            ContestFixtures::class,
            ItemFamilyFixtures::class,
        );
    }
}

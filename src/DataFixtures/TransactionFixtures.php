<?php

namespace App\DataFixtures;

use App\Entity\WorldOfPonies\Player;
use App\Entity\WorldOfPonies\Transaction;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class TransactionFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');
        $players = $manager->getRepository(Player::class)->findAll();

        for($i = 0 ; $i<100000; $i++ )
        {
            $transaction = new Transaction();
            $transaction
                ->setTransactionAmount($faker->randomNumber($nbDigits = 7, $strict = false))
                ->setTransactionLabel($faker->word)
                ->setPlayer($faker->randomElement($players));

            $manager->persist($transaction);
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

<?php

namespace App\DataFixtures;

use App\Entity\WorldOfPonies\Player;
use App\Entity\WorldOfPonies\Transaction;
use App\Repository\WorldOfPonies\PlayerRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class TransactionFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');
        for($i = 0 ; $i<100; $i++ )
        {
            $players = $manager->getRepository(Player::class)->findAll();

            $transaction = new Transaction();
            $transaction
                ->setTransactionAmount($faker->randomNumber($nbDigits = 7, $strict = false))
                ->setTransactionLabel($faker->word)
                ->setPlayer($faker->randomElement($players));

            $manager->persist($transaction);
        }


        $manager->flush();
    }
}

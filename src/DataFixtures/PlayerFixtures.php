<?php

namespace App\DataFixtures;

use App\Entity\WorldOfPonies\Player;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class PlayerFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');
        for($i = 0 ; $i<100; $i++ )
        {

            $player = new Player();
            $gender = $faker->randomElement($array = array ('M','F'));
            $player
                ->setPlayerUsername($faker->word)
                ->setPlayerEmail($faker->email)
                ->setPlayerPwd($faker->password)
                ->setPlayerFirstname($faker->firstName($gender = ($gender=='M')?'male':'female'))
                ->setPlayerLastname($faker->lastName)
                ->setPlayerGender(strtoupper($gender))
                ->setPlayerBirthDate(\DateTime::createFromFormat('Y-m-d', $faker->date($format = 'Y-m-d', $max = 'now')))
                ->setPlayerPhonenumber($faker->phoneNumber)
                ->setPlayerAddress($faker->address)
                ->setPlayerAvatar($faker->imageUrl($width = 640, $height = 480))
                ->setPlayerDescription($faker->text(140))
                ->setPlayerWebsite($faker->url)
                ->setPlayerFunds($faker->randomNumber($nbDigits = 7, $strict = false))
                ->setPlayerIp($faker->ipv4)
                ->setPlayerInscriptionDate(\DateTime::createFromFormat('Y-m-d', $faker->date($format = 'Y-m-d', $max = 'now')))
                ->setPlayerLastconnectionDate(\DateTime::createFromFormat('Y-m-d', $faker->date($format = 'Y-m-d', $max = 'now')));

            $manager->persist($player);
        }


        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}

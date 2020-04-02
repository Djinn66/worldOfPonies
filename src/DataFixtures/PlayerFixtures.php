<?php

namespace App\DataFixtures;

use App\Entity\WorldOfPonies\Player;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class PlayerFixtures extends Fixture implements FixtureGroupInterface
{
    public function load(ObjectManager $manager)
    {
        for ($j = 0 ; $j < 1000000; $j++) {
            $faker = Factory::create('fr_FR');

            $player = new Player();
            $gender = $faker->randomElement($array = array('M', 'F'));
            $player
                ->setPlayerUsername($faker->word)
                ->setPlayerEmail($faker->email)
                ->setPlayerPwd($faker->password)
                ->setPlayerFirstname($faker->firstName($gender = ($gender == 'M') ? 'male' : 'female'))
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

            $manager->flush();
            echo "Player : ".$j."\r\n";
        }
    }
    public static function getGroups(): array
    {
        return ['group1'];
    }
}

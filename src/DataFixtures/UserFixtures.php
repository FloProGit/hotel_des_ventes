<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    public function __construct(private UserPasswordHasherInterface $hasher)
    {}

    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create("fr_FR");

        for($i = 0; $i < 5; $i++) {

            $user = new User;
            $genre = ["male","female","other"];
            $user->setname($faker->lastName())
                ->setFirstName($faker->firstName())
                ->setGenre($genre[rand(0,2)])
                ->setBirthday($faker->dateTimeThisCentury('-13 years'))
                ->setPhoneNumber("0000000000")
                ->setMail($faker->email())
                ->setPassword($this->hasher->hashPassword($user, '123456'));

            $this->addReference('user' . $i, $user);

            $manager->persist($user);
        }

        $manager->flush();
    }
}

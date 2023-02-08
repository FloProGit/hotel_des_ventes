<?php

namespace App\DataFixtures;

use App\Entity\Address;
use App\Entity\Product;
use Faker;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class AddressFixtures extends Fixture implements DependentFixtureInterface
{
    
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create();
        for($i = 0 ; $i < 5; $i++){
            $product = new Address();
            $product->setAddress($faker->address())
                    ->setCity($faker->city())
                    ->setCountry($faker->country())
                    ->setPostalCode($faker->postcode())
                    ->setIsLivraison(rand(0,1))
                    ->setUser($this->getReference('user' . rand(0, 4)));
            $manager->persist($product);
            
        }
        $manager->flush();
    }
    public function getDependencies()
    {
        return [
            UserFixtures::class,
        ];
    }
}

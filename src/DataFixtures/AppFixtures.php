<?php

namespace App\DataFixtures;
use App\Entity\Product;
use Faker;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture implements DependentFixtureInterface
{
    
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create();
        for($i = 0 ; $i < 100; $i++){
            $product = new Product();
            $product->setName($faker->word())
                    ->setDescription($faker->sentence())
                    ->setPriceExclTaxe($faker->randomNumber(2, false))
                    ->setBarCode($faker->ean8())
                    ->addCategory($this->getReference('category' . rand(0, 4)));

            $manager->persist($product);
            
        }
        $manager->flush();
    }
    public function getDependencies()
    {
        return [
            CategoryFixtures::class,
        ];
    }
}

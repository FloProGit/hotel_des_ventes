<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Faker;
use Doctrine\Bundle\FixturesBundle\Fixture;

use Doctrine\Persistence\ObjectManager;

class CategoryFixtures extends Fixture
{
    
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create();
        $cat = ['Homme','Femme','Enfant','Animaux','Autre'];
        for($i = 0 ; $i < 5; $i++){
            $category = new Category();
            $category->setLabel($cat[$i]);
            $manager->persist($category);
            
            $this->addReference('category' . $i, $category);
            
        }
        $manager->flush();
    }

}

<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\DeliveryCompany;
use Faker;
use Doctrine\Bundle\FixturesBundle\Fixture;

use Doctrine\Persistence\ObjectManager;

class DeliveryFixtures extends Fixture
{
    
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create();
        $cat = ['Homme','Femme','Enfant','Animaux','Autre'];

            $delivery = new DeliveryCompany();
            $delivery->setType("Chronopost")
                     ->setDeliveryTime("3 jours")
                     ->setTermsOfReturn("bla bla bla")
                     ->setGuaranteedBreakage("oui")
            ;
            $manager->persist($delivery);
            
            $this->addReference('delivery' . 1, $delivery);

        $manager->flush();
    }

}

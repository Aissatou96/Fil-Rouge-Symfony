<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Promo;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class PromoFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
       $faker = Factory::create('fr_FR');
       for ($i=0; $i < 5; $i++) { 
           $promo = new Promo();
           $promo->setLangue('Français')
                 ->setTitre($faker->realText(25))
                 ->setDescription($faker->realText(50))
                 ->setLieu($faker->realText(25))
                 ->setReferenceAgate($faker->realText(50))
                 ->setDateDebut($faker->dateTime('2020-02-17 08:00:00', 'UTC'))
                 ->setDateFinProvisoire($faker->dateTime('2021-04-30 08:00:00', 'UTC'))
                 ->setDateFinReelle($faker->dateTime('2020-06-31 08:00:00', 'UTC'))
                 ->setEtat($faker->randomElement(['En cours', 'Fermé']));
            $manager->persist($promo);



           
       }
        $manager->flush();
    }
}

<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Promo;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class PromoFixtures extends Fixture implements DependentFixtureInterface
{
    public const PROMO_REF = 'Promo';
    public function load(ObjectManager $manager) 
    {
       $faker = Factory::create('fr_FR');
       for ($i=0; $i < 3; $i++) { 
           $promo = new Promo();
           $promo->setLangue('Français')
                 ->setTitre($faker->realText(25))
                 ->setDescription($faker->realText(50))
                 ->setLieu($faker->realText(25))
                 ->setReferenceAgate($faker->realText(50))
                 ->setDateDebut($faker->dateTime('2020-02-17 08:00:00', 'UTC'))
                 ->setDateFinProvisoire($faker->dateTime('2021-04-30 08:00:00', 'UTC'))
                 ->setDateFinReelle($faker->dateTime('2020-06-31 08:00:00', 'UTC'))
                 ->setEtat($faker->randomElement(['En cours', 'Fermé']))
                 ->setReferentiel($this->getReference(ReferentielFixtures::REF.$i));       
            $manager->persist($promo);
            $this->addReference(self::PROMO_REF.$i,$promo);
           
       }
        $manager->flush();
    }
        

        public function getDependencies()
        {
            return[
                ReferentielFixtures::class
            ];
        }
    }


<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Groupe;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class GroupeFixtures extends Fixture implements DependentFixtureInterface
{

    public function load(ObjectManager $manager)
    {
      $faker = Factory::create('fr_FR');
      $groupes = ['Principal','Secondaire'];
      for ($i=0; $i < count($groupes) ; $i++) { 
       $grp = new Groupe();
       $grp->setNom('Groupe_'.$i)
           ->setType($groupes[$i])
           ->setStatut('Ouvert')
           ->setCreatedAt($faker->dateTime('2020-02-17 08:00:00', 'UTC'))
           ->setNbreApprenants(23)
           ->setPromo($this->getReference(PromoFixtures::PROMO_REF.$i));

      $manager->persist($grp);
      }

        $manager->flush();
    }

    public function getDependencies()
    {
      return[
        PromoFixtures::class
      ];
    }
}

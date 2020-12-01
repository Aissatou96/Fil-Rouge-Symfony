<?php

namespace App\DataFixtures;

use App\Entity\ProfilDeSortie;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ProfilDeSortieFixtures extends Fixture
{
   
    public function load(ObjectManager $manager)
    { 
        $profilSortie = ['DEVELOPPEUR FULLSTACK','DEVELOPPEUR FRONT','DEVELOPPEUR BACK','INTEGRATEUR WEB'];
        foreach ($profilSortie as $value) {
          $ps = new ProfilDeSortie();
          $ps->setLibelle($value);
          $manager->persist($ps);
          $this->addReference($value,$ps);
        }
        
        $manager->flush();
    }

    
}

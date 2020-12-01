<?php

namespace App\DataFixtures;

use App\Entity\Profil;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ProfilFixtures extends Fixture
{
    public const ADMIN_REFERENCE = 'ADMIN';
    public const FORMATEUR_REFERENCE = 'FORMATEUR';
    public const APPRENANT_REFERENCE = 'APPRENANT';
    public const CM_REFERENCE = 'CM';
    public function load(ObjectManager $manager)
    { 
        $admin = new Profil() ;
        $admin->setLibelle(self::ADMIN_REFERENCE);
        $manager->persist($admin);
        $this->addReference(self::ADMIN_REFERENCE,$admin);
        
        $formateur = new Profil();
        $formateur->setLibelle(self::FORMATEUR_REFERENCE);
        $manager->persist($formateur);  
        $this->addReference(self::FORMATEUR_REFERENCE,$formateur);

        $apprenant = new Profil();
        $apprenant->setLibelle(self::APPRENANT_REFERENCE);
        $manager->persist($apprenant);
        $this->addReference(self::APPRENANT_REFERENCE,$apprenant);

        $cm = new Profil();
        $cm->setLibelle(self::CM_REFERENCE);
        $manager->persist($cm);
        $this->addReference(self::CM_REFERENCE,$cm);

        $manager->flush();
    }
}

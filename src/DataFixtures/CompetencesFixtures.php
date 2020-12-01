<?php

namespace App\DataFixtures;

use App\Entity\Competences;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CompetencesFixtures extends Fixture
{
    public const MAQU_REFERENCE = 'Maquetter une application';
    public const DESCMAQU_REFERENCE = 'Description maquettage';
    public const DEVF_REFERENCE = 'Développer le frontend d\'une application';
    public const DESCDEVF_REFERENCE = 'Description développement frontend';
    public const DEVB_REFERENCE = 'Développer le backend d\'une application';
    public const DESCDEVB_REFERENCE = 'Description développement backend';
    public function load(ObjectManager $manager)
    { 
        $maqApp = new Competences() ;
        $maqApp->setLibelle(self::MAQU_REFERENCE);
        $maqApp->setDescription(self::DESCMAQU_REFERENCE);
        $manager->persist($maqApp);
        $this->addReference(self::DESCMAQU_REFERENCE,$maqApp);
        $this->addReference(self::MAQU_REFERENCE,$maqApp);

        $devFront = new Competences() ;
        $devFront->setLibelle(self::DEVF_REFERENCE);
        $devFront->setDescription(self::DESCDEVF_REFERENCE);
        $manager->persist($devFront);
        $this->addReference(self::DEVF_REFERENCE,$devFront);
        $this->addReference(self::DESCDEVF_REFERENCE,$devFront);

        $devBack = new Competences() ;
        $devBack->setLibelle(self::DEVB_REFERENCE);
        $devBack->setDescription(self::DESCDEVB_REFERENCE);
        $manager->persist($devBack);
        $this->addReference(self::DEVB_REFERENCE,$devBack);
        $this->addReference(self::DESCDEVB_REFERENCE,$devBack);

        $manager->flush();
    }

}

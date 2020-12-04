<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Competences;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class CompetencesFixtures extends Fixture
{
    public const COMPETENCE ="competence";

    public function load(ObjectManager $manager)
    {
        $competences = ['Maquetter une application','Développer le frontend d\'une application', 'Développer le backend d\'une application'];

        $faker = Factory::create('fr_FR');
        for ($i=0; $i < count($competences) ; $i++) { 
            $compet = new Competences();
            $compet->setLibelle($competences[$i])
                   ->setDescription($faker->realText(25));
            $manager->persist($compet);
            $this->addReference(self::COMPETENCE.$i, $compet);
        }
        
        $manager->flush();
    }
    // public const MAQU_REFERENCE = 'Maquetter une application';
    // public const DESCMAQU_REFERENCE = 'Description maquettage';
    // public const DEVF_REFERENCE = 'Développer le frontend d\'une application';
    // public const DESCDEVF_REFERENCE = 'Description développement frontend';
    // public const DEVB_REFERENCE = 'Développer le backend d\'une application';
    // public const DESCDEVB_REFERENCE = 'Description développement backend';
    // public function load(ObjectManager $manager)
    // { 
    //     $maqApp = new Competences() ;
    //     $maqApp->setLibelle(self::MAQU_REFERENCE);
    //     $maqApp->setDescription(self::DESCMAQU_REFERENCE);
    //     $manager->persist($maqApp);
    //     $this->addReference(self::DESCMAQU_REFERENCE,$maqApp);
    //     $this->addReference(self::MAQU_REFERENCE,$maqApp);

    //     $devFront = new Competences() ;
    //     $devFront->setLibelle(self::DEVF_REFERENCE);
    //     $devFront->setDescription(self::DESCDEVF_REFERENCE);
    //     $manager->persist($devFront);
    //     $this->addReference(self::DEVF_REFERENCE,$devFront);
    //     $this->addReference(self::DESCDEVF_REFERENCE,$devFront);

    //     $devBack = new Competences() ;
    //     $devBack->setLibelle(self::DEVB_REFERENCE);
    //     $devBack->setDescription(self::DESCDEVB_REFERENCE);
    //     $manager->persist($devBack);
    //     $this->addReference(self::DEVB_REFERENCE,$devBack);
    //     $this->addReference(self::DESCDEVB_REFERENCE,$devBack);

    //     $manager->flush();
    // }

}

<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Referentiel;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use PhpParser\Node\Stmt\Foreach_;

class ReferentielFixtures extends Fixture
{
    public const REF = 'ref';
    public function load(ObjectManager $manager)
    {
        
        $referentiels = ['DEV WEB MOBILE', 'REFERENT DIGITAL', 'DATA ARTISAN'];
        $faker = Factory::create('fr_FR');
        for ($i=0; $i < count($referentiels) ; $i++) {
            $ref = new Referentiel();
            $ref->setLibelle($referentiels[$i])
                ->setPresentation($faker->realText(25))
                ->setProgramme($faker->realText(25))
                ->setCritereEvaluation($faker->realText(25))
                ->setCritereAdmission($faker->realText(25));
        $manager->persist($ref); 
        $this->addReference(self::REF.$i,$ref);     
        }

                $manager->flush();
    }
}

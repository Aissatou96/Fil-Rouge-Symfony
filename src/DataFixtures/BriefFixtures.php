<?php

namespace App\DataFixtures;

use App\Entity\Brief;
use Faker\Factory;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class BriefFixtures extends Fixture implements DependentFixtureInterface
{
    public const BRIEF='brief';
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');
        for ($i=0; $i < 3; $i++) { 
          $brief = new Brief();
          $brief->setLangue('Français')
                ->setTitre($faker->realText(25))
                ->setDescription($faker->realText(30))
                ->setContexte($faker->realText(25))
                ->setModalitePedagogiques($faker->realText(30))
                ->setCritereDePerformances($faker->realText(30))
                ->setModalitesEvaluation($faker->realText(25))
                ->setAvatar($faker->imageUrl($width = 640, $height = 480))
                ->setCreatedAt($faker->dateTime('2020-02-17 08:00:00', 'UTC'))
                ->setStatut($faker->randomElement(['En cours', 'affecté']))
                ->setReferentiel($this->getReference(ReferentielFixtures::REF.$i ));
        $manager->persist($brief);
        $this->addReference(self::BRIEF.$i, $brief);
        
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

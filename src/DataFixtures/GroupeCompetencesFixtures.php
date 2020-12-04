<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\GroupeCompetence;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class GroupeCompetencesFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager){
        $faker = Factory::create('fr_FR');
        for ($i=0; $i < 3; $i++) { 
            $grpComp = new GroupeCompetence();
            $grpComp->setLibelle('GroupeCompet'.$i)
                    ->setDescription($faker->realText(25));

            $nbrComp=$faker->randomElement([1,2,3]);
            for($j = 0; $j < $nbrComp; $j++)
            {
                $key=$faker->unique(true)->numberBetween(0,2);
            
                $grpComp->addCompetence($this->getReference(CompetencesFixtures::COMPETENCE.$key));
            }
            
            $manager->persist($grpComp);
        }
        $manager->flush();

    }
   
    public function getDependencies()
    {
        return[
            CompetencesFixtures::class
        ];
    }

}

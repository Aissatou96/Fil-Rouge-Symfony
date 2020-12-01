<?php

namespace App\DataFixtures;

use App\Entity\GroupeTag;
use Faker\Factory;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class GroupeTagFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');
        for ($i=0; $i < 5; $i++) { 
            $grpTag = new GroupeTag();
            $grpTag->setLibelle($faker->realText(25));
            $manager->persist($grpTag);
        }

        $manager->flush();
    }
}

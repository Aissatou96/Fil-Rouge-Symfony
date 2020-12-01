<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Tag;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class TagFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');
        for ($i=0; $i < 5; $i++) { 
            $tag = new Tag();
            $tag->setLibelle($faker->realText(25))
                ->setDescription($faker->realText(25));
            $manager->persist($tag);
        }

        $manager->flush();
    }
}

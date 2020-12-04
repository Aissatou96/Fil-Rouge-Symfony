<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Tag;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class TagFixtures extends Fixture
{
    public const TAG="tag";
    public function load(ObjectManager $manager)
    {
        $tags = ['Data','Code de l\'entreprise', 'culture tech', 'objet connecté', 'Blockchain'];
        $faker = Factory::create('fr_FR');
        for ($i=0; $i < count($tags) ; $i++) { 
            $tag = new Tag();
            $tag->setLibelle($tags[$i])
                ->setDescription($faker->realText(25));
            $manager->persist($tag);
            $this->addReference(self::TAG.$i, $tag);
        }
        
        $manager->flush();
    }
}

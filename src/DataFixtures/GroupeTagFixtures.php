<?php

namespace App\DataFixtures;

use App\Entity\GroupeTag;
use App\Entity\Tag;
use Faker\Factory;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class GroupeTagFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');
        for ($i=0; $i < 3; $i++) { 
            $grpTag = new GroupeTag();
            $grpTag->setLibelle('GroupeTag'.$i);

            // $tag = $this->getReference('Tag_'.$i);
            $nbrTag=$faker->randomElement([1,2,3]);
            for($j = 0; $j < $nbrTag; $j++)
            {
                $key=$faker->unique(true)->numberBetween(0,4);
               // $t="Tag_".$key;
                $grpTag->addTag($this->getReference(TagFixtures::TAG.$key));
            }
            
            $manager->persist($grpTag);
        }

        $manager->flush();
    }
    public function getDependencies()
    {
        return[
            TagFixtures::class
        ];
    }
}

<?php

namespace App\DataFixtures;

use App\Entity\GroupeCompetence;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class GroupeCompetencesFixtures extends Fixture
{
    public const GRPMAQU_REFERENCE = 'Maquettage';
    public const DESCGRPMAQU_REFERENCE = 'Description maquette';
    public const DEV_REFERENCE = 'Développement Web';
    public const DESCDEV_REFERENCE = 'Description développement web';
    public const DESIGN_REFERENCE = 'Design Web';
    public const DESCDESIGN_REFERENCE = 'Description design web';
    public function load(ObjectManager $manager)
    { 
        $maq = new GroupeCompetence() ;
        $maq->setLibelle(self::GRPMAQU_REFERENCE);
        $maq->setDescription(self::DESCGRPMAQU_REFERENCE);
        $manager->persist($maq);
        $this->addReference(self::DESCGRPMAQU_REFERENCE,$maq);
        $this->addReference(self::GRPMAQU_REFERENCE,$maq);

        $dev = new GroupeCompetence() ;
        $dev->setLibelle(self::DEV_REFERENCE);
        $dev->setDescription(self::DESCDEV_REFERENCE);
        $manager->persist($dev);
        $this->addReference(self::DEV_REFERENCE,$dev);
        $this->addReference(self::DESCDEV_REFERENCE,$dev);

        $des = new GroupeCompetence() ;
        $des->setLibelle(self::DESIGN_REFERENCE);
        $des->setDescription(self::DESCDESIGN_REFERENCE);
        $manager->persist($des);
        $this->addReference(self::DESIGN_REFERENCE,$des);
        $this->addReference(self::DESCDESIGN_REFERENCE,$des);

        $manager->flush();
    }

}

<?php

namespace App\DataFixtures;

use App\Entity\NiveauEvaluation;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class NiveauFixtures extends Fixture
{
    public const NIVEAU1_REFERENCE = "Niveau1";
    public const CRITERE1_REFERENCE = "Critere1";
    public const ACTION1_REFERENCE = "Action1";

    public const NIVEAU2_REFERENCE = "Niveau2";
    public const CRITERE2_REFERENCE = "Critere2";
    public const ACTION2_REFERENCE = "Action2";

    public const NIVEAU3_REFERENCE = "Niveau3";
    public const CRITERE3_REFERENCE = "Critere3";
    public const ACTION3_REFERENCE = "Action3";

    public function load(ObjectManager $manager)
    {
      $niveau1 = new NiveauEvaluation();
      $niveau1->setLibelle(self::NIVEAU1_REFERENCE);
      $niveau1->setCritereEvaluation(self::CRITERE1_REFERENCE);
      $niveau1->setGroupeActions(self::ACTION1_REFERENCE);
      $manager->persist($niveau1);
      $this->addReference(self:: NIVEAU1_REFERENCE,$niveau1);
      $this->addReference(self::CRITERE1_REFERENCE,$niveau1);
      $this->addReference(self::ACTION1_REFERENCE,$niveau1);

      $niveau2 = new NiveauEvaluation();
      $niveau2->setLibelle(self::NIVEAU2_REFERENCE);
      $niveau2->setCritereEvaluation(self::CRITERE2_REFERENCE);
      $niveau2->setGroupeActions(self::ACTION2_REFERENCE);
      $manager->persist($niveau2);
      $this->addReference(self:: NIVEAU2_REFERENCE,$niveau2);
      $this->addReference(self::CRITERE2_REFERENCE,$niveau2);
      $this->addReference(self::ACTION2_REFERENCE,$niveau2);

      $niveau3 = new NiveauEvaluation();
      $niveau3->setLibelle(self::NIVEAU3_REFERENCE);
      $niveau3->setCritereEvaluation(self::CRITERE3_REFERENCE);
      $niveau3->setGroupeActions(self::ACTION3_REFERENCE);
      $manager->persist($niveau3);
      $this->addReference(self:: NIVEAU3_REFERENCE,$niveau3);
      $this->addReference(self::CRITERE3_REFERENCE,$niveau3);
      $this->addReference(self::ACTION3_REFERENCE,$niveau3);

        $manager->flush();
    }
}

<?php

namespace App\DataFixtures;

use App\Entity\CM;
use Faker\Factory;
use App\Entity\User;
use App\Entity\Admin;
use App\Entity\Profil;
use App\Entity\Apprenant;
use App\Entity\Formateur;
use App\DataFixtures\ProfilFixtures;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    public function __construct(UserPasswordEncoderInterface $encoder) {
        $this->encoder=$encoder;
    }

    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');

        $profils = ['ADMIN', 'FORMATEUR', 'APPRENANT', 'CM'];
          
           for ($i=0; $i < count($profils); $i++) { 

               for ($j=0; $j < 3 ; $j++) { 
                if($profils[$i]=='ADMIN'){
           
                $user = new Admin();
                $user->setProfil($this->getReference(ProfilFixtures::ADMIN_REFERENCE))
                     ->setUsername('admin'.($j+1));
                $manager->persist($user);
                }
                elseif($profils[$i] == 'FORMATEUR'){
                    $user = new Formateur();
                    $user->setProfil($this->getReference(ProfilFixtures::FORMATEUR_REFERENCE))
                         ->setUsername('formateur'.($j+1));
                    $manager->persist($user);
                }
                elseif($profils[$i] == 'APPRENANT'){
                    $user = new Apprenant();
                    $user->setProfil($this->getReference(ProfilFixtures::APPRENANT_REFERENCE))
                         ->setUsername('apprenant'.($j+1))
                         ->setGenre($faker->randomElement(['F','M']));
                         
                    $manager->persist($user);
                }
                elseif($profils[$i] == 'CM'){
                    $user = new Cm();
                    $user->setProfil($this->getReference(ProfilFixtures::CM_REFERENCE))
                         ->setUsername('cm'.($j+1));
                    $manager->persist($user);

                }
               
                $user->setPrenom($faker->firstName)
                     ->setNom($faker->lastName)
                     ->setEmail($faker->safeEmail)
                     ->setPassword($this->encoder->encodePassword($user, "password123"))
                     ->setAvatar($faker->imageUrl(640,480,'cats'))
                     ->setStatut("Actif");
                    
                 
            $manager->persist($user);
               }

           

        $manager->flush();
    }
}
}
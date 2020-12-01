<?php

namespace App\Controller;

use App\Entity\Competences;
use App\Entity\NiveauEvaluation;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class CompetencesController extends AbstractController
{
    /**
     * @Route(
     *     path="/api/admin/competences",
     *     methods={"POST"}
     * )
     */
    public function addCompetence(Request $request, SerializerInterface $serializer,                 EntityManagerInterface $em){
        $data = $request->getContent();
        //dd($data);
        $competence = $serializer->deserialize($data, Competences::class, 'json');
        //dd($competence);
        $em->persist($competence);
        $em->flush();

        for ($i=1; $i <4 ; $i++) { 
            $niveau = new NiveauEvaluation();
            $niveau->setLibelle("Niveau $i")
                   ->setCritereEvaluation('critères evaluation')
                   ->setGroupeActions('actions');
            $em->persist($niveau);
            $competence->addNiveau($niveau);
        }
        $em->persist($competence);
        $em->flush();
        return $this->json($competence,Response::HTTP_CREATED);
    }
    

     /**
     * @Route(
     *     path="/api/admin/competences/{id}",
     *     methods={"PUT"}
     * )
     */

     public function updateCompetence(){
         
     }
}

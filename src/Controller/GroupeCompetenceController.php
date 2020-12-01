<?php

namespace App\Controller;

use App\Entity\Competences;
use App\Entity\GroupeCompetence;
use App\Repository\CompetencesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class GroupeCompetenceController extends AbstractController
{
   /**
     * @Route(
     *     path="/api/admin/groupe_competences",
     *     methods={"POST"}
     * )
     */
    public function addGroupeCompetence(Request $request, SerializerInterface $serializer, EntityManagerInterface $em, CompetencesRepository $repoCompetence){
        $data = $request->getContent();
        $grpCompetence[] = $serializer->deserialize($data, GroupeCompetence::class, 'json');
        $em->persist($grpCompetence);
        $em->flush();

        $competence = new Competences();
         
       
        
       

    }
}

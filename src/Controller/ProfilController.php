<?php

namespace App\Controller;

use App\Entity\Profil;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class ProfilController extends AbstractController
{
/**
     * @Route(
     *     path="/api/admin/profils",
     *     methods={"POST"}
     * )
     */
    public function createProfil(Request $request, SerializerInterface $serializer, EntityManagerInterface $em)
    {
        $data = $request->getContent();
        $profil = $serializer->deserialize($data, Profil::class, 'json');
        //dd($profil);
        $em->persist($profil);
        $em->flush();
        return $this->json(['message'=> 'Profil créée avec succès!'], Response::HTTP_CREATED);
    }
}

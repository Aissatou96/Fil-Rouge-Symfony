<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use ApiPlatform\Core\Validator\ValidatorInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class ApprenantController extends AbstractController
{
   /**
     * @Route(
     *     path="/api/admin/apprenants",
     *     methods={"POST"}
     * )
     */
    public function addUser(Request $request, \Swift_Mailer $mailer, UserPasswordEncoderInterface $encoder, SerializerInterface $serializer, ValidatorInterface $validator, EntityManagerInterface $manager)
    {
        $apprenant = $request->request->all();
        $avatar = $request->files->get("avatar");
        $avatar = fopen($avatar->getRealPath(), "rb");
        $apprenant["avatar"] = $avatar;
        $username = $apprenant['username'];
        $apprenant = $serializer->denormalize($apprenant, "App\Entity\Apprenant");
        $errors = $validator->validate($apprenant);
        if (@count($errors)) {
            $errors = $serializer->serialize($errors, "json");
            return new JsonResponse($errors, Response::HTTP_BAD_REQUEST, [], true);
        }
        function randomPassword($length = 10)
        {
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
            return $randomString;
        }
        $password = randomPassword();
        $apprenant->setPassword($encoder->encodePassword($apprenant, $password));
        $manager->persist($apprenant);
        $manager->flush();
        //Envoi de l'Email de confirmation 

        $message = (new \Swift_Message('Orange Digital Center'))
            ->setFrom('cissendeyeaissatou11@gmail.com')
            ->setTo($apprenant->getEmail())
            ->setBody("mot de passe est $password , pour " . $username);
        $mailer->send($message);

        fclose($avatar);

        return  $this->json(['message'=> 'Apprenant créé'], Response::HTTP_CREATED);

       
    }

}

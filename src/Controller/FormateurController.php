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

class FormateurController extends AbstractController
{
   /**
     * @Route(
     *     path="/api/admin/formateurs",
     *     methods={"POST"}
     * )
     */
    public function addUser(Request $request, \Swift_Mailer $mailer, UserPasswordEncoderInterface $encoder, SerializerInterface $serializer, ValidatorInterface $validator, EntityManagerInterface $manager)
    {
        $formateur = $request->request->all();
        $avatar = $request->files->get("avatar");
        $avatar = fopen($avatar->getRealPath(), "rb");
        $formateur["avatar"] = $avatar;
        $username = $formateur['username'];
        $formateur = $serializer->denormalize($formateur, "App\Entity\Formateur");
        $errors = $validator->validate($formateur);
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
        $formateur->setPassword($encoder->encodePassword($formateur, $password));
        $manager->persist($formateur);
        $manager->flush();
        //Envoi de l'Email de confirmation 

        $message = (new \Swift_Message('Orange Digital Center'))
            ->setFrom('cissendeyeaissatou11@gmail.com')
            ->setTo($formateur->getEmail())
            ->setBody("mot de passe est $password , pour " . $username);
        $mailer->send($message);

        fclose($avatar);

        return  $this->json(['message'=> 'Formateur créé'], Response::HTTP_CREATED);

       
    }

}

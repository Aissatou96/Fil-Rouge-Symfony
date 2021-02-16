<?php

namespace App\Controller;

use App\Entity\Admin;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use ApiPlatform\Core\Validator\ValidatorInterface;
use App\Entity\Apprenant;
use App\Entity\Cm;
use App\Entity\Formateur;
use App\Repository\ProfilRepository;
use App\Repository\UserRepository;
use App\services\GestionImage;
use App\services\SendMail;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoder;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserController extends AbstractController
{
   /**
     * @Route(
     *     path="/api/admin/users",
     *     methods={"POST"}
     * )
     */
    public function addUser(Request $request, SendMail $sendMailer, UserPasswordEncoderInterface $encoder, SerializerInterface $serializer, ValidatorInterface $validator, EntityManagerInterface $manager,
    ProfilRepository $profilRepository
    )
    {
        $user = $request->request->all();
        $type = $request->get('type');
        $password = $request->get('password');
        if($type=='ADMIN'){
            $typeUser=Admin::class;
        }elseif($type=='FORMATEUR'){
            $typeUser=Formateur::class;
        }elseif($type=='APPRENANT'){
            $typeUser=Apprenant::class;
        }else{
            $typeUser=Cm::class;
        }
        if($avatar = $request->files->get("avatar")){
            $avatar = fopen($avatar->getRealPath(), "rb");
            $user["avatar"] = $avatar;
        }
       
        $username = $user['username'];
        $newUser = $serializer->denormalize($user, $typeUser);
        $errors = $validator->validate($newUser);
        if (@count($errors)) {
            $errors = $serializer->serialize($errors, "json");
            return new JsonResponse($errors, Response::HTTP_BAD_REQUEST, [], true);
        }
        $newUser->setProfil($profilRepository->findOneBy(['libelle'=>$type]));
        $newUser->setPassword($encoder->encodePassword($newUser,$password));

        $manager->persist($newUser);
        $manager->flush();
        $sendMailer->send($newUser->getEmail(),'Création de compte', 'Votre mot de passe est : passer123');

        return  $this->json(['message'=> 'Utilisateur créé avec succès!'], Response::HTTP_CREATED);

       
    }

    
    /**
     * @Route(
     *     name="putusers",
     *     path="/api/admin/users/{id}",
     *     methods={"POST"},
     *     defaults={
     *         "_api_resource_class" = User::class,
     *         "_api_item_operation_name"="putusers"
     *     }
     * )
     */
    public function UpdateUser(GestionImage $gestionImage, Request $request, $id, UserRepository $userRepository, UserPasswordEncoderInterface $encoder, EntityManagerInterface $em, ProfilRepository $profilRepository){
       $userUpdate = $gestionImage->GestionImage($request,'avatar');
       dd($userUpdate);
       $utilisateur = $userRepository->find($id);
       foreach ($userUpdate as $key => $value) {
         $setteur = 'set'.ucfirst(strtolower($key));
         if($setteur=='setType'){
             
            $utilisateur->setProfil($userUpdate['type']);
         }
        if(method_exists(User::class,$setteur)){
            if ($setteur=='setPassword') {
               $utilisateur->setPassword($encoder->encodePassword($utilisateur,$userUpdate['password']));
            }else{
                $utilisateur->$setteur($value);
            }
        }
       }
       $em->persist($utilisateur);
       $em->flush();

       dd($utilisateur);


      
    }
}

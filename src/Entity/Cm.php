<?php

namespace App\Entity;

use App\Repository\CMRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=CMRepository::class)
 * @ApiResource(
 *       routePrefix="/admin",
 *       attributes={
 *                     
 *                      "security"="is_granted('ROLE_ADMIN')",
 *                      "security_message"="Accès non autorisé",
 *                     
 *                 },
 *       collectionOperations={
 *                                "POST"={"path"="/cms"},
 *                                "GET"={"path"="/cms"}
 *                             },
 * 
 *      itemOperations={
 *                         "GET"={"path"="/cm/{id}"},
 *                          "PUT"={"path"="/cm/{id}"},
 *                          "DELETE"={"path"="/cm/{id}"}
 *                      }
 * )
 */
class Cm extends User
{
 

    
}

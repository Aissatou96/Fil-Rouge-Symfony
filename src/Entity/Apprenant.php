<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\ApprenantRepository;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;


/**
 * @ORM\Entity(repositoryClass=ApprenantRepository::class)
 * @ApiResource(
 *       routePrefix="/admin",
 *       attributes={
 *                     
 *                      "security"="is_granted('ROLE_ADMIN')",
 *                      "security_message"="Accès non autorisé",
 *                     
 *                 },
 *       collectionOperations={
 *                                "POST"={"path"="/apprenants"},
 *                                "GET"={"path"="/apprenants"}
 *                             },
 * 
 *      itemOperations={
 *                         "GET"={"path"="/apprenant/{id}"},
 *                          "PUT"={"path"="/apprenant/{id}"},
 *                          "DELETE"={"path"="/apprenant/{id}"}
 *                      }
 * )
 */
class Apprenant extends User
{
    

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $genre;

    
    public function getGenre(): ?string
    {
        return $this->genre;
    }

    public function setGenre(string $genre): self
    {
        $this->genre = $genre;

        return $this;
    }
}

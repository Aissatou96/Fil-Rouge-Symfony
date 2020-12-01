<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ProfilDeSortieRepository;

/**
 * @ORM\Entity(repositoryClass=ProfilDeSortieRepository::class)
 * @ApiResource(
 * 
 *  routePrefix="/admin",
 * 
 * attributes={
 *              "security"="is_granted('ROLE_ADMIN')",
 *              "security_message"="Accès non autorisé",
 *              "pagination_items_per_page"=5,
 *             },
 * 
 *  collectionOperations={
 *                          "GET"={
 *                                  "path"="/profils_sortie"
 *                                },
 *     
 *                          "POST"={
 *                                   "path"="/profils_sortie"
 *                                 }
 *   },
 *   itemOperations={
 *      
 *                      "GET"={
 *                              "path"="/profils_sortie/{id}"
 *                            },
 * 
 *                      "PUT"={
 *                              "path"="/profils_sortie/{id}"
 *                            },
 * 
 *                      "DELETE"={
 *                                  "path"="/profils_sortie/{id}"
 *                               }
 *      }
 * )
 */
class ProfilDeSortie
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $libelle;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }
}

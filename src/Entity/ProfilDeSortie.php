<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ProfilDeSortieRepository;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=ProfilDeSortieRepository::class)
 * @ApiResource(
 * 
 *  routePrefix="/admin",
 * 
 * attributes={
 *              "security"="is_granted('ROLE_ADMIN')",
 *              "security_message"="Accès non autorisé"
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
 *                              "path"="/profils_sortie/{id}",
 *                              "denormalization_context"={"groups":"profilSortie:write"}
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
     * @Groups({"groups":"profilSortie:write"})
     */
    private $libelle;

    /**
     * @ORM\Column(type="boolean")
     * @Groups({"groups":"profilSortie:write"})
     */
    private $archive=0;

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

    public function getArchive(): ?bool
    {
        return $this->archive;
    }

    public function setArchive(bool $archive): self
    {
        $this->archive = $archive;

        return $this;
    }
}

<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\GroupeRepository;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * @ORM\Entity(repositoryClass=GroupeRepository::class)
 * @ApiResource(
 *      routePrefix="/admin",
 *      attributes={},
 *      normalizationContext={"groups"={"grp_read"}},
 *      denormalizationContext={"groups"={"grp_write"}},
 *      collectionOperations={
 *                              "listGroupes"={
 *                                              "method"="GET",
 *                                              "path"="/groupes"
 *                                            },
 * 
 *                              "grpAprenants"={
 *                                                "method"="GET",
 *                                                "path"="/groupe/{id}/apprenants"
 *                                              },
 *                              "addGrp"={
 *                                          "method"="POST",
 *                                          "path"="/groupes"
 *                                        },
 *                         
 *                          },
 *      itemOperations={
 *                          
 *                      }
 * )
 */
class Groupe
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
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $type;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $statut;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbreApprenants;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getStatut(): ?string
    {
        return $this->statut;
    }

    public function setStatut(string $statut): self
    {
        $this->statut = $statut;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getNbreApprenants(): ?int
    {
        return $this->nbreApprenants;
    }

    public function setNbreApprenants(int $nbreApprenants): self
    {
        $this->nbreApprenants = $nbreApprenants;

        return $this;
    }
}

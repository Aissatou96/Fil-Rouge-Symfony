<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\GroupeRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

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
 *                                                "path"="/groupes/{id}/apprenants"
 *                                              },
 * 
 *                              "addGrp"={
 *                                          "method"="POST",
 *                                          "path"="/groupes"
 *                                        }
 *                         
 *                          },
 * 
 *      itemOperations={
 *                          "getGroup"={
 *                                    "method"="GET",
 *                                    "path"="/groupes/{id}"
 *                                  },
 * 
 *                           "updateGroup"={
 *                                    "method"="PUT",
 *                                    "path"="/groupes/{id}"
 *                                  },
 * 
 *                          "getApprGroup"={
 *                                    "method"="DELETE",
 *                                    "path"="/groupes/{id}/apprenants/{id1}"
 *                                  },
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
     * @groups({"grp_read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @groups({"grp_read"})
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     * @groups({"grp_read"})
     */
    private $type;

    /**
     * @ORM\Column(type="string", length=255)
     * @groups({"grp_read"})
     */
    private $statut;

    /**
     * @ORM\Column(type="datetime")
     * @groups({"grp_read"})
     */
    private $createdAt;

    /**
     * @ORM\Column(type="integer")
     * @groups({"grp_read"})
     */
    private $nbreApprenants;

    /**
     * @ORM\ManyToOne(targetEntity=Promo::class, inversedBy="groupe")
     * @groups({"grp_read"})
     */
    private $promo;

    /**
     * @ORM\ManyToMany(targetEntity=Apprenant::class, inversedBy="groupes")
     * @ApiSubresource
     * @groups({"grp_read"})
     */
    private $apprenants;

    /**
     * @ORM\ManyToMany(targetEntity=Formateur::class, inversedBy="groupes")
     */
    private $formateur;

    public function __construct()
    {
        $this->apprenants = new ArrayCollection();
        $this->formateur = new ArrayCollection();
    }

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

    public function getPromo(): ?Promo
    {
        return $this->promo;
    }

    public function setPromo(?Promo $promo): self
    {
        $this->promo = $promo;

        return $this;
    }

    /**
     * @return Collection|Apprenant[]
     */
    public function getApprenants(): Collection
    {
        return $this->apprenants;
    }

    public function addApprenant(Apprenant $apprenant): self
    {
        if (!$this->apprenants->contains($apprenant)) {
            $this->apprenants[] = $apprenant;
        }

        return $this;
    }

    public function removeApprenant(Apprenant $apprenant): self
    {
        $this->apprenants->removeElement($apprenant);

        return $this;
    }

    /**
     * @return Collection|Formateur[]
     */
    public function getFormateur(): Collection
    {
        return $this->formateur;
    }

    public function addFormateur(Formateur $formateur): self
    {
        if (!$this->formateur->contains($formateur)) {
            $this->formateur[] = $formateur;
        }

        return $this;
    }

    public function removeFormateur(Formateur $formateur): self
    {
        $this->formateur->removeElement($formateur);

        return $this;
    }
}

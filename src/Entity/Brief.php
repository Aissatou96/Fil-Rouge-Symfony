<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\BriefRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *      routePrefix="/formateur",
 *      attributes={},
 *      normalizationContext={"groups"={"brief_read"}},
 *      denormalizationContext={"groups"={"brief_write"}},
 *      collectionOperations={
 *                              "listBriefs"={
 *                                              "method"="GET",
 *                                              "path"="/briefs"
 *                                     },
 * 
 *                              "promoGrpBriefs"={
 *                                                  "method"="GET",
 *                                                  "path"="/promo/{id}/groupe/{id1}/briefs"
 *                                                },
 *                              "promoBriefs"={
 *                                              "method"="GET",
 *                                              "path"="/promo/{id}/briefs"
 *                                             },
 * 
 *                              "briefBrouillons"={
 *                                                    "method"="GET",
 *                                                    "path"="/{id}/brief/brouillons"
 *                                                 },
 * 
 *                              "briefValides"={
 *                                                    "method"="GET",
 *                                                    "path"="/{id}/briefs/valides"
 *                                                 },
 *                               "Briefs"={
 *                                              "method"="POST",
 *                                              "path"="/briefs"
 *                                     },
 * 
 *                                "addBrief"={
 *                                              "method"="POST",
 *                                              "path"="/briefs/{id}"
 *                                     },
 * 
 *                                 "addBriefPromo"={
 *                                              "method"="POST",
 *                                              "path"="/promo/{id}/briefs/{id1}"
 *                                     }
 *                           },
 *      itemOperations={
 *                      "briefAssign"={
 *                                       "method"="GET",
 *                                       "path"="/promo/{id}/brief/{id1}/assignation"
 *                                     },
 *                      
 *                       "getBriefPromo"={
 *                                       "method"="PUT",
 *                                       "path"="/promo/{id}/brief/{id1}"
 *                                     }
 *                      }
 * )
 * @ORM\Entity(repositoryClass=BriefRepository::class)
 */
class Brief
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @groups({"ref_write", "brief_read","ref_read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @groups({"ref_write", "brief_read","ref_read"})
     */
    private $langue;

    /**
     * @ORM\Column(type="string", length=255)
     * @groups({"ref_write","ref_read"})
     */
    private $titre;

    /**
     * @ORM\Column(type="string", length=255)
     * @groups({"ref_write","ref_read"})
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     * @groups({"ref_write"})
     */
    private $contexte;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $modalitePedagogiques;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $critereDePerformances;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $modalitesEvaluation;

    /**
     * @ORM\Column(type="blob")
     */
    private $avatar;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $statut;

    /**
     * @ORM\ManyToOne(targetEntity=Referentiel::class, inversedBy="briefs")
     */
    private $referentiel;

    /**
     * @ORM\OneToMany(targetEntity=NiveauEvaluation::class, mappedBy="brief")
     */
    private $niveau;

    /**
     * @ORM\ManyToOne(targetEntity=Formateur::class, inversedBy="briefs")
     */
    private $formateur;

    /**
     * @ORM\OneToMany(targetEntity=PromoBrief::class, mappedBy="brief")
     */
    private $promoBrief;

    /**
     * @ORM\OneToMany(targetEntity=Ressources::class, mappedBy="brief")
     */
    private $ressources;

    public function __construct()
    {
        $this->niveau = new ArrayCollection();
        $this->promoBrief = new ArrayCollection();
        $this->ressources = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLangue(): ?string
    {
        return $this->langue;
    }

    public function setLangue(string $langue): self
    {
        $this->langue = $langue;

        return $this;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getContexte(): ?string
    {
        return $this->contexte;
    }

    public function setContexte(string $contexte): self
    {
        $this->contexte = $contexte;

        return $this;
    }

    public function getModalitePedagogiques(): ?string
    {
        return $this->modalitePedagogiques;
    }

    public function setModalitePedagogiques(string $modalitePedagogiques): self
    {
        $this->modalitePedagogiques = $modalitePedagogiques;

        return $this;
    }

    public function getCritereDePerformances(): ?string
    {
        return $this->critereDePerformances;
    }

    public function setCritereDePerformances(string $critereDePerformances): self
    {
        $this->critereDePerformances = $critereDePerformances;

        return $this;
    }

    public function getModalitesEvaluation(): ?string
    {
        return $this->modalitesEvaluation;
    }

    public function setModalitesEvaluation(string $modalitesEvaluation): self
    {
        $this->modalitesEvaluation = $modalitesEvaluation;

        return $this;
    }

    public function getAvatar()
    {
        return $this->avatar;
    }

    public function setAvatar($avatar): self
    {
        $this->avatar = $avatar;

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

    public function getStatut(): ?string
    {
        return $this->statut;
    }

    public function setStatut(string $statut): self
    {
        $this->statut = $statut;

        return $this;
    }

    public function getReferentiel(): ?Referentiel
    {
        return $this->referentiel;
    }

    public function setReferentiel(?Referentiel $referentiel): self
    {
        $this->referentiel = $referentiel;

        return $this;
    }

    /**
     * @return Collection|NiveauEvaluation[]
     */
    public function getNiveau(): Collection
    {
        return $this->niveau;
    }

    public function addNiveau(NiveauEvaluation $niveau): self
    {
        if (!$this->niveau->contains($niveau)) {
            $this->niveau[] = $niveau;
            $niveau->setBrief($this);
        }

        return $this;
    }

    public function removeNiveau(NiveauEvaluation $niveau): self
    {
        if ($this->niveau->removeElement($niveau)) {
            // set the owning side to null (unless already changed)
            if ($niveau->getBrief() === $this) {
                $niveau->setBrief(null);
            }
        }

        return $this;
    }

    public function getFormateur(): ?Formateur
    {
        return $this->formateur;
    }

    public function setFormateur(?Formateur $formateur): self
    {
        $this->formateur = $formateur;

        return $this;
    }

    /**
     * @return Collection|PromoBrief[]
     */
    public function getPromoBrief(): Collection
    {
        return $this->promoBrief;
    }

    public function addPromoBrief(PromoBrief $promoBrief): self
    {
        if (!$this->promoBrief->contains($promoBrief)) {
            $this->promoBrief[] = $promoBrief;
            $promoBrief->setBrief($this);
        }

        return $this;
    }

    public function removePromoBrief(PromoBrief $promoBrief): self
    {
        if ($this->promoBrief->removeElement($promoBrief)) {
            // set the owning side to null (unless already changed)
            if ($promoBrief->getBrief() === $this) {
                $promoBrief->setBrief(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Ressources[]
     */
    public function getRessources(): Collection
    {
        return $this->ressources;
    }

    public function addRessource(Ressources $ressource): self
    {
        if (!$this->ressources->contains($ressource)) {
            $this->ressources[] = $ressource;
            $ressource->setBrief($this);
        }

        return $this;
    }

    public function removeRessource(Ressources $ressource): self
    {
        if ($this->ressources->removeElement($ressource)) {
            // set the owning side to null (unless already changed)
            if ($ressource->getBrief() === $this) {
                $ressource->setBrief(null);
            }
        }

        return $this;
    }
}

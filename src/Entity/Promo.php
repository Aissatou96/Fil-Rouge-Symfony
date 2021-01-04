<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\PromoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 * 
 *      routePrefix="/admin",
 *      normalizationContext={"groups"={"promo_read"}},
 *      denormalizationContext={"groups"={"promo_write"}},
 *      attributes= {},
 * 
 *      collectionOperations={
 *                              "listPromo"={
 *                                              "method"="GET",
 *                                              "path"="/promo"
 *                                          },
 * 
 *                              "promoPrincipal"={
 *                                              "method"="GET",
 *                                              "path"="/promo/principal"
 *                                               },
 * 
 *                              "promoAprAttente"={
 *                                              "method"="GET",
 *                                              "path"="/promo/apprenants/attente"
 *                                          },
 * 
 *                              "AddPromo"={
 *                                              "method"="POST",
 *                                              "path"="/promo"
 *                                          }
 *                           },
 * 
 *      itemOperations={
 *                        "onePromo"={
 *                                      "method"="GET",
 *                                      "path"="/promo/{id}"
 *                                    },
 *                        
 *                        "onePromoPrincipal"={
 *                                              "method"="GET",
 *                                              "path"="/promo/{id}/principal"
 * 
 *                                             },
 *                        
 *                       "refsPromo"={
 *                                      "method"="GET",
 *                                      "path"="/promo/{id}/referentiels"
 *                                  },
 * 
 *                       "apprAttPromo"={
 *                                      "method"="GET",
 *                                      "path"="/promo/{id}/apprenants/attente"
 *                                  },
 * 
 *                       "grpApprAttPromo"={
 *                                      "method"="GET",
 *                                      "path"="/promo/{id1}/groupes/{id}/apprenants"
 *                                  },
 * 
 *                      "formateursPromo"={
 *                                      "method"="GET",
 *                                      "path"="/promo/{id}/formateurs"
 *                                  },
 *                      
 *                      "majPromo"={
 *                                    "method"="PUT",
 *                                    "path"="/promo/{id}"
 *                                  },
 * 
 *                      "majPromoAppr"={
 *                                    "method"="PUT",
 *                                    "path"="/promo/id/apprenants"
 *                                  },
 * 
 *                      "majPromoForm"={
 *                                    "method"="PUT",
 *                                    "path"="/promo/id/formateurs"
 *                                  },
 * 
 *                      "majPromoGrp"={
 *                                    "method"="PUT",
 *                                    "path"="/promo/{id1}/groupes/{id}"
 *                                  }
 * 
 *                      }
 * )
 * @ORM\Entity(repositoryClass=PromoRepository::class)
 */
class Promo
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @groups({"promo_read","grp_read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @groups({"promo_read","grp_read"})
     */
    private $langue;

    /**
     * @ORM\Column(type="string", length=255)
     * @groups({"promo_read","grp_read"})
     */
    private $titre;

    /**
     * @ORM\Column(type="string", length=255)
     * @groups({"promo_read","grp_read"})
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     * @groups({"promo_read"})
     */
    private $lieu;

    /**
     * @ORM\Column(type="string", length=255)
     * @groups({"promo_read","grp_read"})
     */
    private $referenceAgate;

    /**
     * @ORM\Column(type="datetime")
     * @groups({"promo_read","grp_read"})
     */
    private $dateDebut;

    /**
     * @ORM\Column(type="datetime")
     * @groups({"promo_read","grp_read"})
     */
    private $dateFinProvisoire;

    /**
     * @ORM\Column(type="datetime")
     * @groups({"promo_read","grp_read"})
     */
    private $dateFinReelle;

    /**
     * @ORM\Column(type="string", length=255)
     * @groups({"promo_read","grp_read"})
     */
    private $etat;

    /**
     * @ORM\ManyToOne(targetEntity=Referentiel::class, inversedBy="promos")
     * @groups({"promo_read"})
     */
    private $referentiel;

    /**
     * @ORM\OneToMany(targetEntity=Groupe::class, mappedBy="promo")
     */
    private $groupe;

    /**
     * @ORM\ManyToMany(targetEntity=Formateur::class, inversedBy="promos")
     */
    private $formateur;

    public function __construct()
    {
        $this->groupe = new ArrayCollection();
        $this->formateur = new ArrayCollection();
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

    public function getLieu(): ?string
    {
        return $this->lieu;
    }

    public function setLieu(string $lieu): self
    {
        $this->lieu = $lieu;

        return $this;
    }

    public function getReferenceAgate(): ?string
    {
        return $this->referenceAgate;
    }

    public function setReferenceAgate(string $referenceAgate): self
    {
        $this->referenceAgate = $referenceAgate;

        return $this;
    }

    public function getDateDebut(): ?\DateTimeInterface
    {
        return $this->dateDebut;
    }

    public function setDateDebut(\DateTimeInterface $dateDebut): self
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    public function getDateFinProvisoire(): ?\DateTimeInterface
    {
        return $this->dateFinProvisoire;
    }

    public function setDateFinProvisoire(\DateTimeInterface $dateFinProvisoire): self
    {
        $this->dateFinProvisoire = $dateFinProvisoire;

        return $this;
    }

    public function getDateFinReelle(): ?\DateTimeInterface
    {
        return $this->dateFinReelle;
    }

    public function setDateFinReelle(\DateTimeInterface $dateFinReelle): self
    {
        $this->dateFinReelle = $dateFinReelle;

        return $this;
    }

    public function getEtat(): ?string
    {
        return $this->etat;
    }

    public function setEtat(string $etat): self
    {
        $this->etat = $etat;

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
     * @return Collection|Groupe[]
     */
    public function getGroupe(): Collection
    {
        return $this->groupe;
    }

    public function addGroupe(Groupe $groupe): self
    {
        if (!$this->groupe->contains($groupe)) {
            $this->groupe[] = $groupe;
            $groupe->setPromo($this);
        }

        return $this;
    }

    public function removeGroupe(Groupe $groupe): self
    {
        if ($this->groupe->removeElement($groupe)) {
            // set the owning side to null (unless already changed)
            if ($groupe->getPromo() === $this) {
                $groupe->setPromo(null);
            }
        }

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

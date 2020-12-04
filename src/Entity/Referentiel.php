<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\ReferentielRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 * 
 *      routePrefix="/admin",
 * 
 *      normalizationContext={"groups"={"ref_read"}},
 *      denormalizationContext={"groups"={"ref_write"}},
 * 
 *      collectionOperations={
 *                              "addRef"={
 *                                       "method"="POST",
 *                                       "path"="/referentiels"
 *                                      },
 * 
 *                              "listRefs"={
 *                                           "method"="GET",
 *                                           "path"="/referentiels"
 *                                          },
 *                              
 *                               "refGrpComp"={
 *                                           "method"="GET",
 *                                           "path"="/referentiels/grpecompetences"
 *                                          },
 * 
 *                           },
 *      
 *      itemOperations={
 *                        "oneRef"={
 *                                    "method"="GET",
 *                                    "path"="/referentiels/{id}"
 *                                  },
 *                          
 *                        "grpCompetRef"={
 *                                    "method"="GET",
 *                                    "path"="/referentiels/{id1}/grpecompetences/{id}/competences"
 *                                  },
 * 
 *                        "majRef"={
 *                                    "method"="PUT",
 *                                    "path"="/referentiels/{id}"
 *                                  }
 *                      }
 *                              
 * )
 * @ORM\Entity(repositoryClass=ReferentielRepository::class)
 */
class Referentiel
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @groups({"ref_write","promo_read","ref_read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @groups({"ref_write", "ref_read","promo_read", "ref_read"})
     */
    private $libelle;

    /**
     * @ORM\Column(type="string", length=255)
     * @groups({"ref_write", "ref_read", "promo_read", "ref_read"})
     */
    private $presentation;

    /**
     * @ORM\Column(type="string", length=255)
     * @groups({"ref_write","ref_read","promo_read"})
     */
    private $programme;

    /**
     * @ORM\Column(type="string", length=255)
     * @groups({"ref_write","ref_read","promo_read"})
     */
    private $critereEvaluation;

    /**
     * @ORM\Column(type="string", length=255)
     * @groups({"ref_write","ref_read"})
     */
    private $critereAdmission;

    /**
     * @ORM\Column(type="boolean")
     * @groups({"ref_write"})
     */
    private $archivage = 0;

    /**
     * @ORM\OneToMany(targetEntity=Brief::class, mappedBy="referentiel")
     * @groups({"ref_write", "ref_read"})
     */
    private $briefs;

    /**
     * @ORM\ManyToMany(targetEntity=GroupeCompetence::class, mappedBy="referentiel")
     * @groups({"ref_write", "ref_read"})
     * @ApiSubresource()
     */
    private $groupeCompetences;

    /**
     * @ORM\OneToMany(targetEntity=Promo::class, mappedBy="referentiel")
     */
    private $promos;

    public function __construct()
    {
        $this->briefs = new ArrayCollection();
        $this->groupeCompetences = new ArrayCollection();
        $this->promos = new ArrayCollection();
    }

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

    public function getPresentation(): ?string
    {
        return $this->presentation;
    }

    public function setPresentation(string $presentation): self
    {
        $this->presentation = $presentation;

        return $this;
    }

    public function getProgramme(): ?string
    {
        return $this->programme;
    }

    public function setProgramme(string $programme): self
    {
        $this->programme = $programme;

        return $this;
    }

    public function getCritereEvaluation(): ?string
    {
        return $this->critereEvaluation;
    }

    public function setCritereEvaluation(string $critereEvaluation): self
    {
        $this->critereEvaluation = $critereEvaluation;

        return $this;
    }

    public function getCritereAdmission(): ?string
    {
        return $this->critereAdmission;
    }

    public function setCritereAdmission(string $critereAdmission): self
    {
        $this->critereAdmission = $critereAdmission;

        return $this;
    }

    public function getArchivage(): ?bool
    {
        return $this->archivage;
    }

    public function setArchivage(bool $archivage): self
    {
        $this->archivage = $archivage;

        return $this;
    }

    /**
     * @return Collection|Brief[]
     */
    public function getBriefs(): Collection
    {
        return $this->briefs;
    }

    public function addBrief(Brief $brief): self
    {
        if (!$this->briefs->contains($brief)) {
            $this->briefs[] = $brief;
            $brief->setReferentiel($this);
        }

        return $this;
    }

    public function removeBrief(Brief $brief): self
    {
        if ($this->briefs->removeElement($brief)) {
            // set the owning side to null (unless already changed)
            if ($brief->getReferentiel() === $this) {
                $brief->setReferentiel(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|GroupeCompetence[]
     */
    public function getGroupeCompetences(): Collection
    {
        return $this->groupeCompetences;
    }

    public function addGroupeCompetence(GroupeCompetence $groupeCompetence): self
    {
        if (!$this->groupeCompetences->contains($groupeCompetence)) {
            $this->groupeCompetences[] = $groupeCompetence;
            $groupeCompetence->addReferentiel($this);
        }

        return $this;
    }

    public function removeGroupeCompetence(GroupeCompetence $groupeCompetence): self
    {
        if ($this->groupeCompetences->removeElement($groupeCompetence)) {
            $groupeCompetence->removeReferentiel($this);
        }

        return $this;
    }

    /**
     * @return Collection|Promo[]
     */
    public function getPromos(): Collection
    {
        return $this->promos;
    }

    public function addPromo(Promo $promo): self
    {
        if (!$this->promos->contains($promo)) {
            $this->promos[] = $promo;
            $promo->setReferentiel($this);
        }

        return $this;
    }

    public function removePromo(Promo $promo): self
    {
        if ($this->promos->removeElement($promo)) {
            // set the owning side to null (unless already changed)
            if ($promo->getReferentiel() === $this) {
                $promo->setReferentiel(null);
            }
        }

        return $this;
    }
}

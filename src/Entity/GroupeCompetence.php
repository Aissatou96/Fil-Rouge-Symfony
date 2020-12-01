<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\GroupeCompetenceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 * 
 *    routePrefix="/admin",
 *    denormalizationContext={"groups"={"grp_compet_read"}},
 * 
 *    collectionOperations={
 *                          "POST"={
 *                                     "path"="/groupe_competences"   
 *                                 },
 * 
 *                          "GET"={
 *                                     "path"="/groupe_competences"
 *                                },
 * 
 *                          "competGrpComp"= {
 *                                              "method"="GET",
 *                                              "path"="/groupe_competences/competences"
 *                                            }
 *                          },
 *      
 *    itemOperations={
 *                      "GET"={
 *                              "path"="/groupe_competences/{id}"
 *                            },
 * 
 *                      "compOneGrpComp"={
 *                                          "method"="GET",
 *                                          "path"="/groupe_competences/{id}/competences"
 *                                       },
 * 
 *                      "PUT"={
 *                              "path"="/groupe_competences/{id}"
 *                            },
 * 
 *                      "DELETE"={
 *                                  "path"="/groupe_competences/{id}"
 *                                }
 *                    }
 *    
 * )
 * @ORM\Entity(repositoryClass=GroupeCompetenceRepository::class)
 */
class GroupeCompetence
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @groups({"grp_compet_read","compet_read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @groups({"grp_compet_read","compet_read"})
     */
    private $libelle;

    /**
     * @ORM\Column(type="string", length=255)
     * @groups({"grp_compet_read","compet_read"})
     */
    private $description;

    /**
     * @ORM\Column(type="boolean")
     */
    private $archivage = 0;

    /**
     * @ORM\ManyToMany(targetEntity=Competences::class, mappedBy="groupeCompetences",
     * cascade={"persist"})
     */
    private $competences;

    /**
     * @ORM\ManyToMany(targetEntity=Referentiel::class, inversedBy="groupeCompetences")
     */
    private $referentiel;

    public function __construct()
    {
        $this->competences = new ArrayCollection();
        $this->referentiel = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

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
     * @return Collection|Competences[]
     */
    public function getCompetences(): Collection
    {
        return $this->competences;
    }

    public function addCompetence(Competences $competence): self
    {
        if (!$this->competences->contains($competence)) {
            $this->competences[] = $competence;
            $competence->addGroupeCompetence($this);
        }

        return $this;
    }

    public function removeCompetence(Competences $competence): self
    {
        if ($this->competences->removeElement($competence)) {
            $competence->removeGroupeCompetence($this);
        }

        return $this;
    }

    /**
     * @return Collection|Referentiel[]
     */
    public function getReferentiel(): Collection
    {
        return $this->referentiel;
    }

    public function addReferentiel(Referentiel $referentiel): self
    {
        if (!$this->referentiel->contains($referentiel)) {
            $this->referentiel[] = $referentiel;
        }

        return $this;
    }

    public function removeReferentiel(Referentiel $referentiel): self
    {
        $this->referentiel->removeElement($referentiel);

        return $this;
    }
}

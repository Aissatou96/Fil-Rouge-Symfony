<?php

namespace App\Entity;

use App\Entity\GroupeCompetence;
use App\Entity\NiveauEvaluation;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\CompetencesRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=CompetencesRepository::class)
 * @ApiResource(
 * 
 *    routePrefix="/admin",
 *    
 *    normalizationContext={"groups"={"competence_read"}},
 *    denormalizationContext={"groups"={"competence_write"}},
 * 
 *    attributes={},
 * 
 *    collectionOperations={
 *                          "POST"={
 *                                     "path"="/competences"   
 *                                 },
 * 
 *                          "GET"={
 *                                     "path"="/competences"
 *                                }
 *                          },
 *      
 *    itemOperations={
 *                      "GET"={
 *                              "path"="/competences/{id}"
 *                            },
 * 
 *                      "PUT"={
 *                              "path"="/competences/{id}"
 *                            },
 * 
 *                      "DELETE"={
 *                                  "path"="/competences/{id}"
 *                                }
 *                    }
 *    
 * )
 */
class Competences
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")*
     * @groups({"competence_read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @groups({"competence_write", "competence_read"})
     */
    private $libelle;

    /**
     * @ORM\Column(type="string", length=255)
     * @groups({"competence_write", "competence_read"})
     */
    private $description;

    /**
     * @ORM\Column(type="boolean")
     */
    private $archivage = 0;

    /**
     * @ORM\ManyToMany(targetEntity=GroupeCompetence::class, inversedBy="competences",cascade={"persist"})
     * @groups({"competence_write", "competence_read"})
     */
    private $groupeCompetences;

    /**
     * @ORM\OneToMany(targetEntity=NiveauEvaluation::class, mappedBy="competences",cascade={"persist"})
     * @groups({"competence_write","competence_read"})
     */
    private $niveau;

    public function __construct()
    {
        $this->groupeCompetences = new ArrayCollection();
        $this->niveau = new ArrayCollection();
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
        }

        return $this;
    }

    public function removeGroupeCompetence(GroupeCompetence $groupeCompetence): self
    {
        $this->groupeCompetences->removeElement($groupeCompetence);

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
            $niveau->setCompetences($this);
        }

        return $this;
    }

    public function removeNiveau(NiveauEvaluation $niveau): self
    {
        if ($this->niveau->removeElement($niveau)) {
            // set the owning side to null (unless already changed)
            if ($niveau->getCompetences() === $this) {
                $niveau->setCompetences(null);
            }
        }

        return $this;
    }
}

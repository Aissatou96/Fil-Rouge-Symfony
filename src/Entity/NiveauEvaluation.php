<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\NiveauEvaluationRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *  
 *    routePrefix="/admin",
 *    
 * 
 *    attributes={},
 * 
 *    collectionOperations={
 *                          "POST"={
 *                                     "path"="/niveau_evaluation"   
 *                                 },
 * 
 *                          "GET"={
 *                                     "path"="/niveau_evaluation"
 *                                }
 *                          },
 *      
 *    itemOperations={
 *                      "GET"={
 *                              "path"="/niveau_evaluation/{id}"
 *                            },
 * 
 *                      "PUT"={
 *                              "path"="/niveau_evaluation/{id}"
 *                            },
 * 
 *                      "DELETE"={
 *                                  "path"="/niveau_evaluation/{id}"
 *                                }
 *                    }
 * )
 * @ORM\Entity(repositoryClass=NiveauEvaluationRepository::class)
 */
class NiveauEvaluation
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
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
    private $critereEvaluation;

    /**
     * @ORM\Column(type="string", length=255)
     * @groups({"competence_write", "competence_read"})
     */
    private $groupeActions;

    /**
     * @ORM\ManyToOne(targetEntity=Brief::class, inversedBy="niveau")
     */
    private $brief;

    /**
     * @ORM\ManyToOne(targetEntity=Competences::class, inversedBy="niveau",cascade={"persist"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $competences;

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

    public function getCritereEvaluation(): ?string
    {
        return $this->critereEvaluation;
    }

    public function setCritereEvaluation(string $critereEvaluation): self
    {
        $this->critereEvaluation = $critereEvaluation;

        return $this;
    }

    public function getGroupeActions(): ?string
    {
        return $this->groupeActions;
    }

    public function setGroupeActions(string $groupeActions): self
    {
        $this->groupeActions = $groupeActions;

        return $this;
    }

    public function getBrief(): ?Brief
    {
        return $this->brief;
    }

    public function setBrief(?Brief $brief): self
    {
        $this->brief = $brief;

        return $this;
    }

    public function getCompetences(): ?Competences
    {
        return $this->competences;
    }

    public function setCompetences(?Competences $competences): self
    {
        $this->competences = $competences;

        return $this;
    }
}

<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\FormateurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=FormateurRepository::class)
 * @ApiResource(
 *       routePrefix="/admin",
 *       attributes={
 *                     
 *                      "security"="is_granted('ROLE_ADMIN')",
 *                      "security_message"="Accès non autorisé",
 *                     
 *                 },
 *       collectionOperations={
 *                                "POST"={"path"="/formateurs"},
 *                                "GET"={"path"="/formateurs"}
 *                             },
 * 
 *      itemOperations={
 *                         "GET"={"path"="/formateur/{id}"},
 *                          "PUT"={"path"="/formateur/{id}"},
 *                          "DELETE"={"path"="/formateur/{id}"}
 *                      }
 * )
 */
class Formateur extends User
{
    /**
     * @ORM\OneToMany(targetEntity=Brief::class, mappedBy="formateur")
     */
    private $briefs;

    public function __construct()
    {
        $this->briefs = new ArrayCollection();
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
            $brief->setFormateur($this);
        }

        return $this;
    }

    public function removeBrief(Brief $brief): self
    {
        if ($this->briefs->removeElement($brief)) {
            // set the owning side to null (unless already changed)
            if ($brief->getFormateur() === $this) {
                $brief->setFormateur(null);
            }
        }

        return $this;
    }
}

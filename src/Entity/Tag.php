<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\TagRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 * 
 *      routePrefix="/admin",
 *      normalizationContext={"groups"={"tag_read"}},
 *      denormalizationContext={"groups"={"tag_write"}},
 * 
 *      attributes= {},
 * 
 *      collectionOperations={
 *                              "POST"={"path"="/tags"},
 *                              "GET"={"path"="/tags"}
 *                           },
 * 
 *      itemOperations={
 *                        "GET"={"path"="/tags/{id}"},
 *                        "PUT"={"path"="/tags/{id}"}
 *                      }
 * )
 * @ORM\Entity(repositoryClass=TagRepository::class)
 */
class Tag
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @groups({"tag_read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @groups({"tag_read"})
     */
    private $libelle;

    /**
     * @ORM\Column(type="string", length=255)
     * @groups({"tag_read"})
     */
    private $description;

    /**
     * @ORM\ManyToMany(targetEntity=GroupeTag::class, mappedBy="tag")
     * @groups({"tag_read"})
     */
    private $groupeTags;

    public function __construct()
    {
        $this->groupeTags = new ArrayCollection();
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

    /**
     * @return Collection|GroupeTag[]
     */
    public function getGroupeTags(): Collection
    {
        return $this->groupeTags;
    }

    public function addGroupeTag(GroupeTag $groupeTag): self
    {
        if (!$this->groupeTags->contains($groupeTag)) {
            $this->groupeTags[] = $groupeTag;
            $groupeTag->addTag($this);
        }

        return $this;
    }

    public function removeGroupeTag(GroupeTag $groupeTag): self
    {
        if ($this->groupeTags->removeElement($groupeTag)) {
            $groupeTag->removeTag($this);
        }

        return $this;
    }
}

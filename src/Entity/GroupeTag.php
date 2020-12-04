<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\GroupeTagRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 * 
 *      routePrefix="/admin",
 *      normalizationContext={"groups"={"grp_tag_read"}},
 *      denormalizationContext={"groups"={"grp_tag_write"}},
 * 
 *      attributes= {},
 * 
 *      collectionOperations={
 *                              "POST"={"path"="/grptags"},
 *                              "GET"={"path"="/grptags"}
 *                           },
 *      itemOperations={
 *                        "GET"={"path"="/grptags/{id}"},
 *      
 *                        "PUT"={"path"="/grptags/{id}"}
 *                      }
 * )
 * @ORM\Entity(repositoryClass=GroupeTagRepository::class)
 */
class GroupeTag
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
     * @ORM\ManyToMany(targetEntity=Tag::class, inversedBy="groupeTags")
     */
    private $tag;

    public function __construct()
    {
        $this->tag = new ArrayCollection();
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

    /**
     * @return Collection|Tag[]
     */
    public function getTag(): Collection
    {
        return $this->tag;
    }

    public function addTag(Tag $tag): self
    {
        if (!$this->tag->contains($tag)) {
            $this->tag[] = $tag;
        }

        return $this;
    }

    public function removeTag(Tag $tag): self
    {
        $this->tag->removeElement($tag);

        return $this;
    }
}

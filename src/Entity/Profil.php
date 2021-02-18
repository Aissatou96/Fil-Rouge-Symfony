<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\ProfilRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=ProfilRepository::class)
 * @ApiResource(
 *     routePrefix="/admin",
 *     attributes={
 *                  "security"="is_granted('ROLE_ADMIN')",
 *                  "security_message"="Accès non autorisé",
 *                  "pagination_items_per_page"=10
 *                },
 * 
 *     collectionOperations={
 *                            "POST"={
 *                                      "path"="/profils",
 *                                      "denormalization_context"={"profil_write"}
 *                                   },
 * 
 *                            "GET"={
 *                                      "path"="/profils",
 *                                      "normalization_context"={"groups"={"profil_read"}}
 *                                  }
 *                          },
 *     
 *     itemOperations={
 *                      "get_users_profil"={
 *                                   "method"="GET",
 *                                   "path"="/profils/{id}/users",
 *                                    "normalization_context"={"group"={"profil_users_read"}}
 *                                          },
 * 
 *                      "GET"={
 *                              "path"="/profils/{id}", 
 *                              "normalization_context"={"groups"={"profil_detail_read"}}
 *                            }, 
 * 
 *                      "DELETE"={"path"="/profils/{id}"},
 * 
 *                      "PUT"={"path"="/profils/{id}"},
 *                  }
 * )
 */
class Profil
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     *  @Groups({"profil_read", "profil_detail_read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"profil_read", "profil_detail_read", "user_read","profil_write"})
    
     */
    private $libelle;

    /**
     * @ORM\OneToMany(targetEntity=User::class, mappedBy="profil")
     * @Groups({"profil_detail_read"})
     * 
     */
    private $users;

    /**
     * @ORM\Column(type="boolean")
     */
    private $archive = 0;

    public function __construct()
    {
        $this->users = new ArrayCollection();
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
     * @return Collection|User[]
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
            $user->setProfil($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->removeElement($user)) {
            // set the owning side to null (unless already changed)
            if ($user->getProfil() === $this) {
                $user->setProfil(null);
            }
        }

        return $this;
    }

    public function getArchive(): ?bool
    {
        return $this->archive;
    }

    public function setArchive(bool $archive): self
    {
        $this->archive = $archive;

        return $this;
    }
}

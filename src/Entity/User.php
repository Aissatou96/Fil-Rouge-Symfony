<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\UserRepository;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="profil", type="string")
 * @ORM\DiscriminatorMap({"USER" = "User","ADMIN" = "Admin", "APPRENANT" = "Apprenant", "FORMATEUR" = "Formateur", "CM" = "Cm"})
 * @ApiResource(
 *       routePrefix="/admin",
 *
 *       attributes={
 *                     
 *                      "security"="is_granted('ROLE_ADMIN')",
 *                      "security_message"="Accès non autorisé",
 *                     
 *                 },
 * 
 *     collectionOperations={
 * 
 *                              "POST"={
 *                                       "path"="/users",
 *                                        "deserialize"=false
 *                                     },
 * 
 *                              "GET"={
 *                                      "path"="/users",
 *                                      "normalization_context"={"groups"={"user_read"}},
 *                                      
 *                                    }
 *                         },
 *     
 *     itemOperations={
 * 
 *                      "GET"={
 *                              "path"="/users/{id}", 
 *                              "normalization_context"={"groups"={"user_details_read"}}
 *                            }, 
 * 
 *                      "DELETE"={
 *                                  "path"="/users/{id}"},
 * 
 *                      "putUser"={
 *                                 "path"="/users/{id}",
 *                                  "route_name":"putusers",
 *                                  "deserialize"=false
 *                              }
 *                  }
 * )
 */
class User implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"profil_users_read"})
     * @Groups({"user_read"})
     */
    protected $id;
    /**
     * @ORM\Column(type="string", length=180, unique=true)
     * @Groups({"user_read", "user_details_read"})
     */
    protected $username;

    protected $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
    
     */
    protected $password;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"user_read","user_details_read","profil_users_read"})
     */
    protected $prenom;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"user_read","user_details_read","profil_users_read"})
     */
    protected $nom;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"user_read", "user_details_read"})
     */
    protected $email;

    /**
     * @ORM\Column(type="blob")
     * @Groups({"user_read", "user_details_read"})
     */
    protected $avatar;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"user_read"})
     */
    protected $statut;

    /**
     * @ORM\ManyToOne(targetEntity=Profil::class, inversedBy="users")
     * @ORM\JoinColumn(nullable=false)
     * @groups({"grp_read", "user_read","user_details_read"})
     */
    protected $profil;

    /**
     * @ORM\Column(type="boolean")
     */
    private $archive = 0;

    public function getId(): ?int
    {
        return $this->id;
    }




    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_' . $this->profil->getLibelle();

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        $this->plainPassword = null;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getAvatar()
    {
        if($this->avatar != null){
            return base64_encode(stream_get_contents($this->avatar));
        }else{
            return $this->avatar;
        }
        
    }

    public function setAvatar($avatar): self
    {
        $this->avatar = $avatar;

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

    public function getProfil(): ?Profil
    {
        return $this->profil;
    }

    public function setProfil(?Profil $profil): self
    {
        $this->profil = $profil;

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

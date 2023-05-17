<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use App\Repository\UtilisateurRepository;
use App\State\UserPasswordHasher;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: UtilisateurRepository::class)]
#[ApiResource(
    operations: [
        new Delete(security: "is_granted('ROLE_USER') and object == user"),
        new Post(processor: UserPasswordHasher::class),
        new Put(security: "is_granted('ROLE_USER') and object == user", processor: UserPasswordHasher::class),
    ]
)]
#[ApiResource(normalizationContext: ["groups" => ["utilisateur:read", "annonce:read", "reponse:read"]])]
class Utilisateur implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['utilisateur:read'])]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    #[Assert\Email]
    #[Groups(['utilisateur:read'])]
    #[Assert\NotBlank]
    #[Assert\NotNull]
    private ?string $email = null;

    #[ORM\Column]
    #[Groups(['utilisateur:read'])]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column(length: 255, nullable: false)]
    #[ApiProperty(readable: false, writable: false)]
    private ?string $password = null;

    #[Assert\Regex(pattern: "#^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,30}$#")]
    #[Assert\NotNull]
    #[Assert\NotBlank]
    private ?string $plainPassword = null;

    #[ORM\Column(length: 30)]
    #[Assert\Length(min : 2, max: 30)]
    #[Groups(['utilisateur:read'])]
    private ?string $nom = null;

    #[ORM\Column(length: 30)]
    #[Assert\Length(min : 2, max: 30)]
    #[Groups(['utilisateur:read'])]
    private ?string $prenom = null;

    #[ORM\OneToMany(mappedBy: 'utilisateur', targetEntity: Reponse::class, orphanRemoval: true)]
    #[Groups(['utilisateur:read'])]
    private Collection $reponses;

    #[ORM\OneToMany(mappedBy: 'utilisateur', targetEntity: Annonce::class, orphanRemoval: true)]
    #[Groups(['utilisateur:read'])]
    private Collection $annonces;

    public function __construct()
    {
        $this->reponses = new ArrayCollection();
        $this->annonces = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
         $this->plainPassword = null;
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

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * @return Collection<int, Reponse>
     */
    public function getReponses(): Collection
    {
        return $this->reponses;
    }

    public function addReponse(Reponse $reponse): self
    {
        if (!$this->reponses->contains($reponse)) {
            $this->reponses->add($reponse);
            $reponse->setUtilisateur($this);
        }

        return $this;
    }

    public function removeReponse(Reponse $reponse): self
    {
        if ($this->reponses->removeElement($reponse)) {
            // set the owning side to null (unless already changed)
            if ($reponse->getUtilisateur() === $this) {
                $reponse->setUtilisateur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Annonce>
     */
    public function getAnnonces(): Collection
    {
        return $this->annonces;
    }

    public function addAnnonce(Annonce $annonce): self
    {
        if (!$this->annonces->contains($annonce)) {
            $this->annonces->add($annonce);
            $annonce->setUtilisateur($this);
        }

        return $this;
    }

    public function removeAnnonce(Annonce $annonce): self
    {
        if ($this->annonces->removeElement($annonce)) {
            // set the owning side to null (unless already changed)
            if ($annonce->getUtilisateur() === $this) {
                $annonce->setUtilisateur(null);
            }
        }

        return $this;
    }

    /**
     * @return string
     */
    public function getPlainPassword(): string
    {
        return $this->plainPassword;
    }

    /**
     * @param string $plainPassword
     */
    public function setPlainPassword(string $plainPassword): void
    {
        $this->plainPassword = $plainPassword;
    }


}

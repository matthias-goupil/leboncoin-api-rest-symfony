<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Link;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use App\Repository\AnnonceRepository;
use App\State\UserPasswordHasher;
use App\State\UserSetter;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: AnnonceRepository::class)]
#[ApiResource(
    operations: [
        new Delete(security: "is_granted('ROLE_USER') and object.utilisateur == user"),
        new Post(security: "is_granted('ROLE_USER') and user != null", processor: UserSetter::class),
        new Put(security: "is_granted('ROLE_USER') and user != null"),
    ]
)]
#[ApiResource(normalizationContext: ["groups" => ["annonce:read", "reponse:read"]])]
#[ApiResource(
    uriTemplate: "/utilisateurs/{idUtilisateur}/annonces",
    operations: [new GetCollection()],
    uriVariables: [
        'idUtilisateur' => new Link(
            fromProperty: 'annonces',
            fromClass: Utilisateur::class
        )
    ],
)]
class Annonce
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['annonce:read'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\Length(min : 4, max: 255)]
    #[Assert\NotBlank]
    #[Assert\NotNull]
    #[Groups(['annonce:read'])]
    private ?string $titre = null;

    #[ORM\Column(length: 2000)]
    #[Assert\Length(min : 4, max: 2000)]
    #[Assert\NotBlank]
    #[Assert\NotNull]
    #[Groups(['annonce:read'])]
    private ?string $description = null;

    #[ORM\Column(length: 2083)]
    #[Assert\NotBlank]
    #[Assert\NotNull]
    #[Groups(['annonce:read'])]
    private ?string $image = null;

    #[ORM\Column]
    #[Assert\NotBlank]
    #[Assert\NotNull]
    #[Groups(['annonce:read'])]
    private ?float $prix = null;

    #[ORM\OneToMany(mappedBy: 'annonce', targetEntity: Reponse::class, orphanRemoval: true)]
    #[Groups(['annonce:read'])]
    private Collection $reponses;

    #[ORM\ManyToOne(inversedBy: 'annonces')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Utilisateur $utilisateur = null;

    public function __construct()
    {
        $this->reponses = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

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

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): self
    {
        $this->prix = $prix;

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
            $reponse->setAnnonce($this);
        }

        return $this;
    }

    public function removeReponse(Reponse $reponse): self
    {
        if ($this->reponses->removeElement($reponse)) {
            // set the owning side to null (unless already changed)
            if ($reponse->getAnnonce() === $this) {
                $reponse->setAnnonce(null);
            }
        }

        return $this;
    }

    public function getUtilisateur(): ?Utilisateur
    {
        return $this->utilisateur;
    }

    public function setUtilisateur(?Utilisateur $utilisateur): self
    {
        $this->utilisateur = $utilisateur;

        return $this;
    }
}

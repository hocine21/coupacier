<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\CommandeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\UX\Turbo\Attribute\Broadcast;

#[ORM\Entity(repositoryClass: CommandeRepository::class)]
#[ApiResource]
#[Broadcast]
class Commande
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateCommande = null;

    #[ORM\Column(type: Types::BLOB)]
    private $codeQrCommande = null;

    #[ORM\Column(length: 255)]
    private ?string $etat = null;

    #[ORM\Column]
    private ?bool $demandeDevis = null;

    #[ORM\Column(length: 255)]
    private ?string $etatDevis = null;

    #[ORM\Column(nullable: true)]
    private ?float $ristourne = null;

    #[ORM\ManyToOne(inversedBy: 'commandes')]
    private ?Client $client = null;

    #[ORM\OneToMany(targetEntity: Detail::class, mappedBy: 'commande')]
    private Collection $details;

    #[ORM\OneToMany(targetEntity: CommandeLivraison::class, mappedBy: 'commande')]
    private Collection $commandeLivraisons;

    public function __construct()
    {
        $this->details = new ArrayCollection();
        $this->commandeLivraisons = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateCommande(): ?\DateTimeInterface
    {
        return $this->dateCommande;
    }

    public function setDateCommande(\DateTimeInterface $dateCommande): static
    {
        $this->dateCommande = $dateCommande;

        return $this;
    }

    public function getCodeQrCommande()
    {
        return $this->codeQrCommande;
    }

    public function setCodeQrCommande($codeQrCommande): static
    {
        $this->codeQrCommande = $codeQrCommande;

        return $this;
    }

    public function getEtat(): ?string
    {
        return $this->etat;
    }

    public function setEtat(string $etat): static
    {
        $this->etat = $etat;

        return $this;
    }

    public function isDemandeDevis(): ?bool
    {
        return $this->demandeDevis;
    }

    public function setDemandeDevis(bool $demandeDevis): static
    {
        $this->demandeDevis = $demandeDevis;

        return $this;
    }

    public function getEtatDevis(): ?string
    {
        return $this->etatDevis;
    }

    public function setEtatDevis(string $etatDevis): static
    {
        $this->etatDevis = $etatDevis;

        return $this;
    }

    public function getRistourne(): ?float
    {
        return $this->ristourne;
    }

    public function setRistourne(?float $ristourne): static
    {
        $this->ristourne = $ristourne;

        return $this;
    }

    public function getClient(): ?Client
    {
        return $this->client;
    }

    public function setClient(?Client $client): static
    {
        $this->client = $client;

        return $this;
    }

    /**
     * @return Collection<int, Detail>
     */
    public function getDetails(): Collection
    {
        return $this->details;
    }

    public function addDetail(Detail $detail): static
    {
        if (!$this->details->contains($detail)) {
            $this->details->add($detail);
            $detail->setCommande($this);
        }

        return $this;
    }

    public function removeDetail(Detail $detail): static
    {
        if ($this->details->removeElement($detail)) {
            // set the owning side to null (unless already changed)
            if ($detail->getCommande() === $this) {
                $detail->setCommande(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, CommandeLivraison>
     */
    public function getCommandeLivraisons(): Collection
    {
        return $this->commandeLivraisons;
    }

    public function addCommandeLivraison(CommandeLivraison $commandeLivraison): static
    {
        if (!$this->commandeLivraisons->contains($commandeLivraison)) {
            $this->commandeLivraisons->add($commandeLivraison);
            $commandeLivraison->setCommande($this);
        }

        return $this;
    }

    public function removeCommandeLivraison(CommandeLivraison $commandeLivraison): static
    {
        if ($this->commandeLivraisons->removeElement($commandeLivraison)) {
            // set the owning side to null (unless already changed)
            if ($commandeLivraison->getCommande() === $this) {
                $commandeLivraison->setCommande(null);
            }
        }

        return $this;
    }
}

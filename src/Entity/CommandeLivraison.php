<?php

namespace App\Entity;

use App\Repository\CommandeLivraisonRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommandeLivraisonRepository::class)]
class CommandeLivraison
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?float $prixLivraisonParKm = null;

    #[ORM\ManyToOne(inversedBy: 'commandeLivraisons')]
    private ?Livraison $livraison = null;

    #[ORM\ManyToOne(inversedBy: 'commandeLivraisons')]
    private ?Commande $commande = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrixLivraisonParKm(): ?float
    {
        return $this->prixLivraisonParKm;
    }

    public function setPrixLivraisonParKm(float $prixLivraisonParKm): static
    {
        $this->prixLivraisonParKm = $prixLivraisonParKm;

        return $this;
    }

    public function getLivraison(): ?Livraison
    {
        return $this->livraison;
    }

    public function setLivraison(?Livraison $livraison): static
    {
        $this->livraison = $livraison;

        return $this;
    }

    public function getCommande(): ?Commande
    {
        return $this->commande;
    }

    public function setCommande(?Commande $commande): static
    {
        $this->commande = $commande;

        return $this;
    }
}

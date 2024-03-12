<?php

namespace App\Entity;

use App\Repository\ProduitRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProduitRepository::class)]
class Produit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nomProduit = null;

    #[ORM\Column(length: 255)]
    private ?string $image = null;

    #[ORM\Column]
    private ?float $largeurProduit = null;

    #[ORM\Column]
    private ?float $epaisseurProduit = null;

    #[ORM\Column(nullable: true)]
    private ?float $masseProduit = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $formeProduit = null;

    #[ORM\Column(nullable: true)]
    private ?float $hauteurProduit = null;

    #[ORM\Column(nullable: true)]
    private ?float $sectionProduit = null;

    #[ORM\Column]
    private ?float $marge = null;

    #[ORM\Column]
    private ?float $prixML = null;

    #[ORM\ManyToOne(inversedBy: 'produits')]
    private ?Categorie $categorie = null;

    #[ORM\OneToMany(targetEntity: Detail::class, mappedBy: 'produit')]
    private Collection $details;

    #[ORM\OneToMany(targetEntity: Barre::class, mappedBy: 'produit')]
    private Collection $barres;

    #[ORM\OneToMany(targetEntity: ProduitFournisseur::class, mappedBy: 'produit')]
    private Collection $produitFournisseurs;

    public function __construct()
    {
        $this->details = new ArrayCollection();
        $this->barres = new ArrayCollection();
        $this->produitFournisseurs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomProduit(): ?string
    {
        return $this->nomProduit;
    }

    public function setNomProduit(string $nomProduit): static
    {
        $this->nomProduit = $nomProduit;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): static
    {
        $this->image = $image;

        return $this;
    }

    public function getLargeurProduit(): ?float
    {
        return $this->largeurProduit;
    }

    public function setLargeurProduit(float $largeurProduit): static
    {
        $this->largeurProduit = $largeurProduit;

        return $this;
    }

    public function getEpaisseurProduit(): ?float
    {
        return $this->epaisseurProduit;
    }

    public function setEpaisseurProduit(float $epaisseurProduit): static
    {
        $this->epaisseurProduit = $epaisseurProduit;

        return $this;
    }

    public function getMasseProduit(): ?float
    {
        return $this->masseProduit;
    }

    public function setMasseProduit(?float $masseProduit): static
    {
        $this->masseProduit = $masseProduit;

        return $this;
    }

    public function getFormeProduit(): ?string
    {
        return $this->formeProduit;
    }

    public function setFormeProduit(?string $formeProduit): static
    {
        $this->formeProduit = $formeProduit;

        return $this;
    }

    public function getHauteurProduit(): ?float
    {
        return $this->hauteurProduit;
    }

    public function setHauteurProduit(?float $hauteurProduit): static
    {
        $this->hauteurProduit = $hauteurProduit;

        return $this;
    }

    public function getSectionProduit(): ?float
    {
        return $this->sectionProduit;
    }

    public function setSectionProduit(?float $sectionProduit): static
    {
        $this->sectionProduit = $sectionProduit;

        return $this;
    }

    public function getMarge(): ?float
    {
        return $this->marge;
    }

    public function setMarge(float $marge): static
    {
        $this->marge = $marge;

        return $this;
    }

    public function getPrixML(): ?float
    {
        return $this->prixML;
    }

    public function setPrixML(float $prixML): static
    {
        $this->prixML = $prixML;

        return $this;
    }

    public function getCategorie(): ?Categorie
    {
        return $this->categorie;
    }

    public function setCategorie(?Categorie $categorie): static
    {
        $this->categorie = $categorie;

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
            $detail->setProduit($this);
        }

        return $this;
    }

    public function removeDetail(Detail $detail): static
    {
        if ($this->details->removeElement($detail)) {
            // set the owning side to null (unless already changed)
            if ($detail->getProduit() === $this) {
                $detail->setProduit(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Barre>
     */
    public function getBarres(): Collection
    {
        return $this->barres;
    }

    public function addBarre(Barre $barre): static
    {
        if (!$this->barres->contains($barre)) {
            $this->barres->add($barre);
            $barre->setProduit($this);
        }

        return $this;
    }

    public function removeBarre(Barre $barre): static
    {
        if ($this->barres->removeElement($barre)) {
            // set the owning side to null (unless already changed)
            if ($barre->getProduit() === $this) {
                $barre->setProduit(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, ProduitFournisseur>
     */
    public function getProduitFournisseurs(): Collection
    {
        return $this->produitFournisseurs;
    }

    public function addProduitFournisseur(ProduitFournisseur $produitFournisseur): static
    {
        if (!$this->produitFournisseurs->contains($produitFournisseur)) {
            $this->produitFournisseurs->add($produitFournisseur);
            $produitFournisseur->setProduit($this);
        }

        return $this;
    }

    public function removeProduitFournisseur(ProduitFournisseur $produitFournisseur): static
    {
        if ($this->produitFournisseurs->removeElement($produitFournisseur)) {
            // set the owning side to null (unless already changed)
            if ($produitFournisseur->getProduit() === $this) {
                $produitFournisseur->setProduit(null);
            }
        }

        return $this;
    }
}

<?php

namespace App\Entity;

use App\Repository\LivraisonRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LivraisonRepository::class)]
class Livraison
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateLivraison = null;

    #[ORM\Column(length: 255)]
    private ?string $statutLivraison = null;

    #[ORM\Column(type: Types::BLOB)]
    private $codeQRLivraison = null;

    #[ORM\Column]
    private ?int $codePostaleLivraison = null;

    #[ORM\Column(length: 255)]
    private ?string $rueLivraison = null;

    #[ORM\Column(length: 255)]
    private ?string $villeLivraison = null;

    #[ORM\OneToMany(targetEntity: CommandeLivraison::class, mappedBy: 'livraison')]
    private Collection $commandeLivraisons;

    public function __construct()
    {
        $this->commandeLivraisons = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateLivraison(): ?\DateTimeInterface
    {
        return $this->dateLivraison;
    }

    public function setDateLivraison(\DateTimeInterface $dateLivraison): static
    {
        $this->dateLivraison = $dateLivraison;

        return $this;
    }

    public function getStatutLivraison(): ?string
    {
        return $this->statutLivraison;
    }

    public function setStatutLivraison(string $statutLivraison): static
    {
        $this->statutLivraison = $statutLivraison;

        return $this;
    }

    public function getCodeQRLivraison()
    {
        return $this->codeQRLivraison;
    }

    public function setCodeQRLivraison($codeQRLivraison): static
    {
        $this->codeQRLivraison = $codeQRLivraison;

        return $this;
    }

    public function getCodePostaleLivraison(): ?int
    {
        return $this->codePostaleLivraison;
    }

    public function setCodePostaleLivraison(int $codePostaleLivraison): static
    {
        $this->codePostaleLivraison = $codePostaleLivraison;

        return $this;
    }

    public function getRueLivraison(): ?string
    {
        return $this->rueLivraison;
    }

    public function setRueLivraison(string $rueLivraison): static
    {
        $this->rueLivraison = $rueLivraison;

        return $this;
    }

    public function getVilleLivraison(): ?string
    {
        return $this->villeLivraison;
    }

    public function setVilleLivraison(string $villeLivraison): static
    {
        $this->villeLivraison = $villeLivraison;

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
            $commandeLivraison->setLivraison($this);
        }

        return $this;
    }

    public function removeCommandeLivraison(CommandeLivraison $commandeLivraison): static
    {
        if ($this->commandeLivraisons->removeElement($commandeLivraison)) {
            // set the owning side to null (unless already changed)
            if ($commandeLivraison->getLivraison() === $this) {
                $commandeLivraison->setLivraison(null);
            }
        }

        return $this;
    }
}

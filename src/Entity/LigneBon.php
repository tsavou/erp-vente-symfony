<?php

namespace App\Entity;

use App\Repository\LigneBonRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LigneBonRepository::class)]
class LigneBon
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $quantity = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2)]
    private ?string $prixUnitaire = null;

    #[ORM\ManyToOne(inversedBy: 'ligneBons')]
    #[ORM\JoinColumn(nullable: false)]
    private ?BonLivraison $bonLivraison = null;

    #[ORM\ManyToOne(inversedBy: 'ligneBons')]
    private ?Produit $produit = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): static
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getPrixUnitaire(): ?string
    {
        return $this->prixUnitaire;
    }

    public function setPrixUnitaire(string $prixUnitaire): static
    {
        $this->prixUnitaire = $prixUnitaire;

        return $this;
    }

    public function getBonLivraison(): ?BonLivraison
    {
        return $this->bonLivraison;
    }

    public function setBonLivraison(?BonLivraison $bonLivraison): static
    {
        $this->bonLivraison = $bonLivraison;

        return $this;
    }

    public function getProduit(): ?Produit
    {
        return $this->produit;
    }

    public function setProduit(?Produit $produit): static
    {
        $this->produit = $produit;

        return $this;
    }
}

<?php

namespace App\Entity;

use App\Repository\ProduitRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProduitRepository::class)]
class Produit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $name = null;

    #[ORM\Column]
    private ?int $quantiteStock = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2)]
    private ?string $prixUnitaire = null;

    /**
     * @var Collection<int, LigneBon>
     */
    #[ORM\OneToMany(targetEntity: LigneBon::class, mappedBy: 'produit')]
    private Collection $ligneBons;

    public function __construct()
    {
        $this->ligneBons = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getQuantiteStock(): ?int
    {
        return $this->quantiteStock;
    }

    public function setQuantiteStock(int $quantiteStock): static
    {
        $this->quantiteStock = $quantiteStock;

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

    /**
     * @return Collection<int, LigneBon>
     */
    public function getLigneBons(): Collection
    {
        return $this->ligneBons;
    }

    public function addLigneBon(LigneBon $ligneBon): static
    {
        if (!$this->ligneBons->contains($ligneBon)) {
            $this->ligneBons->add($ligneBon);
            $ligneBon->setProduit($this);
        }

        return $this;
    }

    public function removeLigneBon(LigneBon $ligneBon): static
    {
        if ($this->ligneBons->removeElement($ligneBon)) {
            // set the owning side to null (unless already changed)
            if ($ligneBon->getProduit() === $this) {
                $ligneBon->setProduit(null);
            }
        }

        return $this;
    }
}

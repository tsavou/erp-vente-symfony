<?php

namespace App\Entity;

use App\Repository\BonLivraisonRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BonLivraisonRepository::class)]
class BonLivraison
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $dateLivraison = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2, nullable: true)]
    private ?string $montantTotal = null;

    #[ORM\ManyToOne(inversedBy: 'bonLivraisons')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Client $client = null;

    /**
     * @var Collection<int, LigneBon>
     */
    #[ORM\OneToMany(targetEntity: LigneBon::class, mappedBy: 'bonLivraison')]
    private Collection $ligneBons;

    /**
     * @var Collection<int, Alerte>
     */
    #[ORM\OneToMany(targetEntity: Alerte::class, mappedBy: 'bon')]
    private Collection $alertes;

    public function __construct()
    {
        $this->ligneBons = new ArrayCollection();
        $this->alertes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateLivraison(): ?\DateTimeImmutable
    {
        return $this->dateLivraison;
    }

    public function setDateLivraison(\DateTimeImmutable $dateLivraison): static
    {
        $this->dateLivraison = $dateLivraison;

        return $this;
    }

    public function getMontantTotal(): ?string
    {
        return $this->montantTotal;
    }

    public function setMontantTotal(?string $montantTotal): static
    {
        $this->montantTotal = $montantTotal;

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
            $ligneBon->setBonLivraison($this);
        }

        return $this;
    }

    public function removeLigneBon(LigneBon $ligneBon): static
    {
        if ($this->ligneBons->removeElement($ligneBon)) {
            // set the owning side to null (unless already changed)
            if ($ligneBon->getBonLivraison() === $this) {
                $ligneBon->setBonLivraison(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Alerte>
     */
    public function getAlertes(): Collection
    {
        return $this->alertes;
    }

    public function addAlerte(Alerte $alerte): static
    {
        if (!$this->alertes->contains($alerte)) {
            $this->alertes->add($alerte);
            $alerte->setBon($this);
        }

        return $this;
    }

    public function removeAlerte(Alerte $alerte): static
    {
        if ($this->alertes->removeElement($alerte)) {
            // set the owning side to null (unless already changed)
            if ($alerte->getBon() === $this) {
                $alerte->setBon(null);
            }
        }

        return $this;
    }
}

<?php

namespace App\Entity;

use App\Repository\AlerteRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AlerteRepository::class)]
class Alerte
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $message = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $dateAlerte = null;

    #[ORM\ManyToOne(inversedBy: 'alertes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?BonLivraison $bon = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(string $message): static
    {
        $this->message = $message;

        return $this;
    }

    public function getDateAlerte(): ?\DateTimeImmutable
    {
        return $this->dateAlerte;
    }

    public function setDateAlerte(\DateTimeImmutable $dateAlerte): static
    {
        $this->dateAlerte = $dateAlerte;

        return $this;
    }

    public function getBon(): ?BonLivraison
    {
        return $this->bon;
    }

    public function setBon(?BonLivraison $bon): static
    {
        $this->bon = $bon;

        return $this;
    }
}

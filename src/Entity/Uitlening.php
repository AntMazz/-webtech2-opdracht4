<?php

namespace App\Entity;

use App\Repository\UitleningRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UitleningRepository::class)]
class Uitlening
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $uitgeleend_op = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $teruggebracht_op = null;

    #[ORM\ManyToOne(inversedBy: 'uitlenings')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Klant $klant = null;

    #[ORM\ManyToOne(inversedBy: 'uitlenings')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Boek $boek = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUitgeleendOp(): ?\DateTimeInterface
    {
        return $this->uitgeleend_op;
    }

    public function setUitgeleendOp(\DateTimeInterface $uitgeleend_op): static
    {
        $this->uitgeleend_op = $uitgeleend_op;

        return $this;
    }

    public function getTeruggebrachtOp(): ?\DateTimeInterface
    {
        return $this->teruggebracht_op;
    }

    public function setTeruggebrachtOp(\DateTimeInterface $teruggebracht_op): static
    {
        $this->teruggebracht_op = $teruggebracht_op;

        return $this;
    }

    public function getKlant(): ?Klant
    {
        return $this->klant;
    }

    public function setKlant(?Klant $klant): static
    {
        $this->klant = $klant;

        return $this;
    }

    public function getBoek(): ?Boek
    {
        return $this->boek;
    }

    public function setBoek(?Boek $boek): static
    {
        $this->boek = $boek;

        return $this;
    }
}

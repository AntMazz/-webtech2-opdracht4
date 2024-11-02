<?php

namespace App\Entity;

use App\Repository\KlantRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: KlantRepository::class)]
class Klant
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $naam = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    /**
     * @var Collection<int, Uitlening>
     */
    #[ORM\OneToMany(targetEntity: Uitlening::class, mappedBy: 'klant')]
    private Collection $uitlenings;

    public function __construct()
    {
        $this->uitlenings = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNaam(): ?string
    {
        return $this->naam;
    }

    public function setNaam(string $naam): static
    {
        $this->naam = $naam;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return Collection<int, Uitlening>
     */
    public function getUitlenings(): Collection
    {
        return $this->uitlenings;
    }

    public function addUitlening(Uitlening $uitlening): static
    {
        if (!$this->uitlenings->contains($uitlening)) {
            $this->uitlenings->add($uitlening);
            $uitlening->setKlant($this);
        }

        return $this;
    }

    public function removeUitlening(Uitlening $uitlening): static
    {
        if ($this->uitlenings->removeElement($uitlening)) {
            // set the owning side to null (unless already changed)
            if ($uitlening->getKlant() === $this) {
                $uitlening->setKlant(null);
            }
        }

        return $this;
    }
}

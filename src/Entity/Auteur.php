<?php

namespace App\Entity;

use App\Repository\AuteurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AuteurRepository::class)]
class Auteur
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $naam = null;

    /**
     * @var Collection<int, Boek>
     */
    #[ORM\OneToMany(targetEntity: Boek::class, mappedBy: 'auteur')]
    private Collection $boeken;

    public function __construct()
    {
        $this->boeken = new ArrayCollection();
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

    /**
     * @return Collection<int, Boek>
     */
    public function getBoeken(): Collection
    {
        return $this->boeken;
    }

    public function addBoeken(Boek $boeken): static
    {
        if (!$this->boeken->contains($boeken)) {
            $this->boeken->add($boeken);
            $boeken->setAuteur($this);
        }

        return $this;
    }

    public function removeBoeken(Boek $boeken): static
    {
        if ($this->boeken->removeElement($boeken)) {
            // set the owning side to null (unless already changed)
            if ($boeken->getAuteur() === $this) {
                $boeken->setAuteur(null);
            }
        }

        return $this;
    }
}

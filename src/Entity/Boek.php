<?php

namespace App\Entity;

use App\Repository\BoekRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BoekRepository::class)]
class Boek
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $titel = null;

    #[ORM\ManyToOne(targetEntity: Auteur::class, inversedBy: 'boeken', fetch: 'EAGER')]
    #[ORM\JoinColumn(nullable: true, onDelete: 'SET NULL')]
    private ?Auteur $auteur = null;

    /**
     * @var Collection<int, Uitlening>
     */
    #[ORM\OneToMany(targetEntity: Uitlening::class, mappedBy: 'boek')]
    private Collection $uitlenings;

    public function __construct()
    {
        $this->uitlenings = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitel(): ?string
    {
        return $this->titel;
    }

    public function setTitel(string $titel): static
    {
        $this->titel = $titel;
        return $this;
    }

    public function getAuteur(): ?Auteur
    {
        return $this->auteur;
    }

    public function setAuteur(?Auteur $auteur): static
    {
        $this->auteur = $auteur;
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
            $uitlening->setBoek($this);
        }
        return $this;
    }

    public function removeUitlening(Uitlening $uitlening): static
    {
        if ($this->uitlenings->removeElement($uitlening)) {
            if ($uitlening->getBoek() === $this) {
                $uitlening->setBoek(null);
            }
        }
        return $this;
    }
}

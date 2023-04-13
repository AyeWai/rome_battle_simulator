<?php

namespace App\Entity;

use App\Repository\CohortRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CohortRepository::class)]
class Cohort
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $number = null;

    #[ORM\OneToMany(mappedBy: 'cohort', targetEntity: Centuria::class)]
    private Collection $centuria;

    #[ORM\ManyToOne(inversedBy: 'cohort')]
    private ?Legio $legio = null;

    public function __construct()
    {
        $this->centuria = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumber(): ?int
    {
        return $this->number;
    }

    public function setNumber(int $number): self
    {
        $this->number = $number;

        return $this;
    }

    /**
     * @return Collection<int, Centuria>
     */
    public function getCenturia(): Collection
    {
        return $this->centuria;
    }

    public function addCenturium(Centuria $centurium): self
    {
        if (!$this->centuria->contains($centurium)) {
            $this->centuria->add($centurium);
            $centurium->setCohort($this);
        }

        return $this;
    }

    public function removeCenturium(Centuria $centurium): self
    {
        if ($this->centuria->removeElement($centurium)) {
            // set the owning side to null (unless already changed)
            if ($centurium->getCohort() === $this) {
                $centurium->setCohort(null);
            }
        }

        return $this;
    }

    public function getLegio(): ?Legio
    {
        return $this->legio;
    }

    public function setLegio(?Legio $legio): self
    {
        $this->legio = $legio;

        return $this;
    }
}

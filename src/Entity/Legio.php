<?php

namespace App\Entity;

use App\Repository\LegioRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LegioRepository::class)]
class Legio
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\OneToMany(mappedBy: 'legio', targetEntity: Cohort::class)]
    private Collection $cohort;

    public function __construct()
    {
        $this->cohort = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, Cohort>
     */
    public function getCohort(): Collection
    {
        return $this->cohort;
    }

    public function addCohort(Cohort $cohort): self
    {
        if (!$this->cohort->contains($cohort)) {
            $this->cohort->add($cohort);
            $cohort->setLegio($this);
        }

        return $this;
    }

    public function removeCohort(Cohort $cohort): self
    {
        if ($this->cohort->removeElement($cohort)) {
            // set the owning side to null (unless already changed)
            if ($cohort->getLegio() === $this) {
                $cohort->setLegio(null);
            }
        }

        return $this;
    }
}

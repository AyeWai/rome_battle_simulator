<?php

namespace App\Entity;

use App\Repository\CenturionTypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CenturionTypeRepository::class)]
class CenturionType
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $label = null;

    #[ORM\Column]
    private ?int $meleecoeff = null;

    #[ORM\Column]
    private ?int $rangecoeff = null;

    #[ORM\Column]
    private ?int $defensecoeff = null;

    #[ORM\OneToMany(mappedBy: 'CenturionType', targetEntity: Centurion::class)]
    private Collection $centurions;

    public function __construct()
    {
        $this->centurions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(string $label): self
    {
        $this->label = $label;

        return $this;
    }

    public function getMeleecoeff(): ?int
    {
        return $this->meleecoeff;
    }

    public function setMeleecoeff(int $meleecoeff): self
    {
        $this->meleecoeff = $meleecoeff;

        return $this;
    }

    public function getRangecoeff(): ?int
    {
        return $this->rangecoeff;
    }

    public function setRangecoeff(int $rangecoeff): self
    {
        $this->rangecoeff = $rangecoeff;

        return $this;
    }

    public function getDefensecoeff(): ?int
    {
        return $this->defensecoeff;
    }

    public function setDefensecoeff(int $defensecoeff): self
    {
        $this->defensecoeff = $defensecoeff;

        return $this;
    }

    /**
     * @return Collection<int, Centurion>
     */
    public function getCenturions(): Collection
    {
        return $this->centurions;
    }

    public function addCenturion(Centurion $centurion): self
    {
        if (!$this->centurions->contains($centurion)) {
            $this->centurions->add($centurion);
            $centurion->setCenturionType($this);
        }

        return $this;
    }

    public function removeCenturion(Centurion $centurion): self
    {
        if ($this->centurions->removeElement($centurion)) {
            // set the owning side to null (unless already changed)
            if ($centurion->getCenturionType() === $this) {
                $centurion->setCenturionType(null);
            }
        }

        return $this;
    }

    public function __toString() {
        return $this->label;
    }
}

<?php

namespace App\Entity;

use App\Repository\CenturiaTypeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CenturiaTypeRepository::class)]
class CenturiaType
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $label = null;

    #[ORM\Column]
    private ?int $melee = null;

    #[ORM\Column]
    private ?int $range = null;

    #[ORM\Column]
    private ?int $defense = null;

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

    public function getMelee(): ?int
    {
        return $this->melee;
    }

    public function setMelee(int $melee): self
    {
        $this->melee = $melee;

        return $this;
    }

    public function getRange(): ?int
    {
        return $this->range;
    }

    public function setRange(int $range): self
    {
        $this->range = $range;

        return $this;
    }

    public function getDefense(): ?int
    {
        return $this->defense;
    }

    public function setDefense(int $defense): self
    {
        $this->defense = $defense;

        return $this;
    }

    public function __toString() {
        return $this->label;
    }
}

<?php

namespace App\Entity;

use App\Repository\CenturionRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CenturionRepository::class)]
class Centurion
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?int $age = null;

    #[ORM\Column]
    private ?int $time_served = null;

    #[ORM\OneToOne(mappedBy: 'centurion', cascade: ['persist', 'remove'])]
    private ?Centuria $centuria = null;

    #[ORM\ManyToOne(inversedBy: 'centurions')]
    #[ORM\JoinColumn(nullable: true)]
    private ?CenturionType $CenturionType = null;

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

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(int $age): self
    {
        $this->age = $age;

        return $this;
    }

    public function getTimeServed(): ?int
    {
        return $this->time_served;
    }

    public function setTimeServed(int $time_served): self
    {
        $this->time_served = $time_served;

        return $this;
    }

    public function getCenturia(): ?Centuria
    {
        return $this->centuria;
    }

    public function setCenturia(?Centuria $centuria): self
    {
        // unset the owning side of the relation if necessary
        if ($centuria === null && $this->centuria !== null) {
            $this->centuria->setCenturion(null);
        }

        // set the owning side of the relation if necessary
        if ($centuria !== null && $centuria->getCenturion() !== $this) {
            $centuria->setCenturion($this);
        }

        $this->centuria = $centuria;

        return $this;
    }

    public function getCenturionType(): ?CenturionType
    {
        return $this->CenturionType;
    }

    public function setCenturionType(?CenturionType $CenturionType): self
    {
        $this->CenturionType = $CenturionType;

        return $this;
    }

    public function __toString() {
        return $this->name;
    }
}

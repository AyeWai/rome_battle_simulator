<?php

namespace App\Entity;

use App\Repository\CenturiaRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CenturiaRepository::class)]
class Centuria
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToOne(inversedBy: 'centuria', cascade: ['persist', 'remove'])]
    private ?Centurion $centurion = null;

    #[ORM\ManyToOne(inversedBy: 'centuria')]
    private ?Cohort $cohort = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?CenturiaType $centuriatype = null;

    #[ORM\Column]
    private ?int $health = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCenturion(): ?Centurion
    {
        return $this->centurion;
    }

    public function setCenturion(?Centurion $centurion): self
    {
        $this->centurion = $centurion;

        return $this;
    }

    public function getCohort(): ?Cohort
    {
        return $this->cohort;
    }

    public function setCohort(?Cohort $cohort): self
    {
        $this->cohort = $cohort;

        return $this;
    }

    public function getCenturiaType(): ?CenturiaType
    {
        return $this->centuriatype;
    }

    public function setCenturiaType(?CenturiaType $centuriatype): self
    {
        $this->centuriatype = $centuriatype;

        return $this;
    }

    public function getHealth(): ?int
    {
        return $this->health;
    }

    public function setHealth(int $health): self
    {
        $this->health = $health;

        return $this;
    }
}

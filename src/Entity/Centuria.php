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

    #[ORM\Column(length: 255)]
    private string $name = 'Legio I';

    private ?int $melee = null ;
    private ?int $range = null;
    private ?int $defense = null;

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

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function CenturiaStatsCalculator(Centuria $centuria): array
    {
        
        $stats = []; 
        $coeffarray =[];
        #Build centuria stats array
        $this->melee = $centuria->getCenturiaType()->getMelee();
        $this->range = $centuria->getCenturiaType()->getRange();
        $this->defense = $centuria->getCenturiaType()->getDefense();
        $centurion = $centuria->getCenturion();
        array_push($stats, $this->melee,  $this->range, $this->defense);
        #Build centurion stats array
        $coeff = $centurion->getCenturionType();
        $meleecoeff = $coeff->getMeleecoeff();
        $rangecoeff = $coeff->getRangecoeff();
        $defensecoeff = $coeff->getDefensecoeff();
        array_push($coeffarray, $meleecoeff,  $rangecoeff, $defensecoeff);
        #Multiplying the integers between the two arrays
        $total = array_map(function($x, $y) { return $x * $y; },$stats, $coeffarray);
        #$this->logger->info(implode("|",$total));
        return $total;
    }
}

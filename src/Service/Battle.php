<?php
namespace App\Service;

use App\Entity\Centuria;
use App\Entity\Centurion;
use Psr\Log\LoggerInterface;

class Battle
{
    private ?int $melee = null ;
    private ?int $range = null;
    private ?int $defense = null;

    private $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
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
        $this->logger->info(strval($total));
        return $total;
    }

    public function CenturiaFighting( Centuria $centuria1, Centuria $centuria2)
    {
        $x = $this->CenturiaStatsCalculator($centuria1);
        $this->logger->info(implode("|",$x));
        $y = $this->CenturiaStatsCalculator($centuria1);
        $this->logger->info(implode("|",$y));

        #Round1
        if ($x[1] > 0  OR $y[1] > 0 ){
            $x[1] > $y[1]? $centuria1->setHealth($centuria1->getHealth()-2) : $centuria2->setHealth($centuria1->getHealth()-2);
        }
        #Round2
        if ($x[1] > 0  OR $y[1] > 0 ){
            $x[1] > $y[1]? $centuria1->setHealth($centuria1->getHealth()-2) : $centuria2->setHealth($centuria1->getHealth()-2);
        }
        #Round3
        if ($x[1] > 0  OR $y[1] > 0 ){
            $x[1] > $y[1]? $centuria1->setHealth($centuria1->getHealth()-2) : $centuria2->setHealth($centuria1->getHealth()-2);
        }
    }
}

/*
    $total = 0;
    foreach{$array1 AS $k=>$v){
    $total += $v*$array2[$k];
    }
    echo $total;
*/
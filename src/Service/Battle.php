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
        #$this->logger->info(implode("|",$total));
        return $total;
    }

    public function CenturiaFighting( Centuria $centuria1, Centuria $centuria2):void
    {
        $x = $this->CenturiaStatsCalculator($centuria1);
        $this->logger->info(implode("|",$x));
        $y = $this->CenturiaStatsCalculator($centuria2);
        $this->logger->info(implode("|",$y));

        #Round1
        if ($x[1] > 0  OR $y[1] > 0 ){
            $x[1] < $y[1]? $centuria1->setHealth(($centuria1->getHealth())-$y[1]) : $centuria2->setHealth(($centuria2->getHealth())-2);
            #$x[1] > $y[1]? $centuria1->setHealth(2) : $centuria2->setHealth(2);
        }
        #Round2
        if ($x[1] > 0  OR $y[1] > 0 ){
            $x[1] < $y[1]? $centuria1->setHealth(($centuria1->getHealth())-$y[1]) : $centuria2->setHealth(($centuria2->getHealth())-2);
        }
        #Round3
        if ($x[0] > 0  OR $y[0] > 0 ){
            $x[0] < $y[0]? $centuria1->setHealth(($centuria1->getHealth())-$y[0]) : $centuria2->setHealth(($centuria2->getHealth())-2);
        }
        #Result
        $centuria1->getHealth() > $centuria2->getHealth() ? $this->logger->info('Centuria 1 won !') : $this->logger->info('Centuria 2 won !');
        $this->logger->info('Centuria 1 Health'. $centuria1->getHealth());
        $this->logger->info('Centuria 2 Health'. $centuria2->getHealth()); 
    }
}

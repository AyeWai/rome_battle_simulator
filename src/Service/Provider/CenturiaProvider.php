<?php
namespace App\Service\Provider;

use App\Repository\CenturiaRepository;

class CenturiaProvider
{
    private CenturiaRepository $centuriarepo;  

    public function __construct(CenturiaRepository $centuriarepo) {
        $this->centuriarepo = $centuriarepo;
    }
    public function getCenturias(): array
    {
        return $this->centuriarepo->findAll();      
    }
}
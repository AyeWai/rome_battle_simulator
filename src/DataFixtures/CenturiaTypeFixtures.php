<?php

namespace App\DataFixtures;

use App\Entity\CenturiaType;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CenturiaTypeFixtures extends Fixture 
{
    public const LEGIO_TYPE = 'legionari-type';
    public const TRIARI_TYPE = 'triari-type';
    public const HASTATI_TYPE = 'hastati-type';
    public const VELITES_TYPE = 'velites-type';
    public const PRAE_TYPE = 'praetoriae-type';

    public function load(ObjectManager $manager): void
    {        
        $centuriontype1 = new CenturiaType();
        $centuriontype1->setLabel('Legionari');
        $centuriontype1->setMelee(4);
        $centuriontype1->setRange(1);
        $centuriontype1->setDefense(4);
        $manager->persist($centuriontype1);
        $this->addReference(self::LEGIO_TYPE, $centuriontype1);

        $centuriontype2 = new CenturiaType();
        $centuriontype2->setLabel('Triarii');
        $centuriontype2->setMelee(3);
        $centuriontype2->setRange(1);
        $centuriontype2->setDefense(3);
        $this->addReference(self::TRIARI_TYPE, $centuriontype1);
    
        $manager->persist($centuriontype2);

        $centuriontype3 = new CenturiaType();
        $centuriontype3->setLabel('Hastati');
        $centuriontype3->setMelee(2);
        $centuriontype3->setRange(1);
        $centuriontype3->setDefense(2);
        $manager->persist($centuriontype3);
        $this->addReference(self::HASTATI_TYPE, $centuriontype1);

        $centuriontype4 = new CenturiaType();
        $centuriontype4->setLabel('Velites');
        $centuriontype4->setMelee(1);
        $centuriontype4->setRange(4);
        $centuriontype4->setDefense(1);
        $manager->persist($centuriontype4);
        $this->addReference(self::VELITES_TYPE, $centuriontype1);

        $centuriontype5 = new CenturiaType();
        $centuriontype5->setLabel('Praetoriae');
        $centuriontype5->setMelee(6);
        $centuriontype5->setRange(3);
        $centuriontype5->setDefense(6);
        $manager->persist($centuriontype5);
        $this->addReference(self::PRAE_TYPE, $centuriontype1);

        $manager->flush();
    }
}

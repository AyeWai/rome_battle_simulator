<?php

namespace App\DataFixtures;

use App\Entity\CenturionType;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CenturionTypeFixtures extends Fixture
{

    public const HERO_TYPE = 'hero-type';
    public const TACTICIAN_TYPE = 'tactician-type';
    public const VETERAN_TYPE = 'veteran-type';

    public function load(ObjectManager $manager): void
    {
        $centuriontype1= new CenturionType();
        $centuriontype1->setLabel('Hero');
        $centuriontype1->setMeleecoeff(3);
        $centuriontype1->setRangecoeff(1);
        $centuriontype1->setDefensecoeff(2);
        $manager->persist($centuriontype1);
        $this->addReference(self::HERO_TYPE, $centuriontype1);

        $centuriontype2= new CenturionType();
        $centuriontype2->setLabel('Tactician');
        $centuriontype2->setMeleecoeff(1);
        $centuriontype2->setRangecoeff(4);
        $centuriontype2->setDefensecoeff(1);
        $manager->persist($centuriontype2);
        $this->addReference(self::TACTICIAN_TYPE, $centuriontype2);

        $centuriontype3= new CenturionType();
        $centuriontype3->setLabel('Colonizer');
        $centuriontype3->setMeleecoeff(2);
        $centuriontype3->setRangecoeff(1);
        $centuriontype3->setDefensecoeff(3);
        $manager->persist($centuriontype3);
        $this->addReference(self::VETERAN_TYPE, $centuriontype3);

        $manager->flush();
    }
}

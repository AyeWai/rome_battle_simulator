<?php

namespace App\DataFixtures;

use App\DataFixtures\CenturionTypeFixtures;
use App\Entity\Centurion;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class CenturionFixtures extends Fixture implements DependentFixtureInterface
{
    public const TITUS_PULLO = 'titus-pullo';
    public const LUCIUS_VORENUS = 'lucius-vorenus';
    public const SEMPRONIUS_DENSUS = 'sempronius-densus';

    public function load(ObjectManager $manager): void
    {

        $centurion1 = new Centurion();
        $centurion1->setName('Titus Pullo');
        $centurion1->setAge(25);
        $centurion1->setTimeServed(3);
        $centurion1->setCenturionType($this->getReference(CenturionTypeFixtures::HERO_TYPE));
        $manager->persist($centurion1);
        $this->addReference(self::TITUS_PULLO, $centurion1);

        $centurion2 = new Centurion();
        $centurion2->setName('Lucius Vorenus');
        $centurion2->setAge(30);
        $centurion2->setTimeServed(5);
        $manager->persist($centurion2);
        $centurion2->setCenturionType($this->getReference(CenturionTypeFixtures::VETERAN_TYPE));
        $this->addReference(self::LUCIUS_VORENUS, $centurion2);


        $centurion3 = new Centurion();
        $centurion3->setName('Sempronius Densus');
        $centurion3->setAge(40);
        $centurion3->setTimeServed(10);
        $manager->persist($centurion3);
        $centurion3->setCenturionType($this->getReference(CenturionTypeFixtures::TACTICIAN_TYPE));
        $this->addReference(self::SEMPRONIUS_DENSUS, $centurion3);

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            CenturionTypeFixtures::class,
        ];
    }
}

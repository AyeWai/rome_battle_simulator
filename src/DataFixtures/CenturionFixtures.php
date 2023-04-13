<?php

namespace App\DataFixtures;

use App\Entity\Centurion;
use App\Entity\CenturionType;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class CenturionFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        $centurion1 = new Centurion();
        $centurion1->setName('Titus Pullo');
        $centurion1->setAge(25);
        $centurion1->setTimeServed(3);
        $centurion1->setCenturionType($this->getReference(CenturionTypeFixtures::HERO_TYPE));
        $manager->persist($centurion1);

        $centurion2 = new Centurion();
        $centurion2->setName('Lucius Vorenus');
        $centurion2->setAge(30);
        $centurion2->setTimeServed(5);
        $manager->persist($centurion2);
        $centurion2->setCenturionType($this->getReference(CenturionTypeFixtures::VETERAN_TYPE));


        $centurion3 = new Centurion();
        $centurion3->setName('Sempronius Densus');
        $centurion3->setAge(40);
        $centurion3->setTimeServed(10);
        $manager->persist($centurion3);
        $centurion3->setCenturionType($this->getReference(CenturionTypeFixtures::TACTICIAN_TYPE));

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            CenturionTypeFixtures::class,
        ];
    }
}

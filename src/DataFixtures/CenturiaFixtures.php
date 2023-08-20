<?php

namespace App\DataFixtures;

use App\DataFixtures\CenturiaTypeFixtures ;
use App\DataFixtures\CenturionFixtures;
use App\Entity\Centuria;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;


class CenturiaFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        $centuria1 = new Centuria();
        $centuria1->setName('Legio I Adiutrix');
        $centuria1->setHealth(20);
        $centuria1->setCenturiaType($this->getReference(CenturiaTypeFixtures::LEGIO_TYPE));
        $centuria1->setCenturion($this->getReference(CenturionFixtures::TITUS_PULLO));
        $manager->persist($centuria1);

        $centuria2 = new Centuria();
        $centuria2->setName('Legio I Germanica');
        $centuria2->setHealth(20);
        $centuria2->setCenturiaType($this->getReference(CenturiaTypeFixtures::HASTATI_TYPE));
        $centuria2->setCenturion($this->getReference(CenturionFixtures::LUCIUS_VORENUS));
        $manager->persist($centuria2);

        $centuria3 = new Centuria();
        $centuria3->setName('Legio II Italica');
        $centuria3->setHealth(20);
        $centuria3->setCenturiaType($this->getReference(CenturiaTypeFixtures::VELITES_TYPE));
        $centuria3->setCenturion($this->getReference(CenturionFixtures::SEMPRONIUS_DENSUS));
        $manager->persist($centuria3);

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            CenturiaTypeFixtures::class,
            CenturionFixtures::class,
        ];
    }
}

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
        $centuria1->setHealth(20);
        $centuria1->setCenturiaType($this->getReference(CenturiaTypeFixtures::LEGIO_TYPE));
        $centuria1->setCenturion($this->getReference(CenturionFixtures::TITUS_PULLO));
        $manager->persist($centuria1);

        $centuria2 = new Centuria();
        $centuria2->setHealth(20);
        $centuria2->setCenturiaType($this->getReference(CenturiaTypeFixtures::HASTATI_TYPE));
        $centuria2->setCenturion($this->getReference(CenturionFixtures::LUCIUS_VORENUS));
        $manager->persist($centuria2);

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

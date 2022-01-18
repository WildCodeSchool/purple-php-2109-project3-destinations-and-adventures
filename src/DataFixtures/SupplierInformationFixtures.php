<?php

namespace App\DataFixtures;

use App\Entity\SupplierInformation;
use DateInterval;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class SupplierInformationFixtures extends Fixture
{
    public const OBJECT_QUANTITY = 50;

    public function load(ObjectManager $manager): void
    {
        $date = new DateTime();
        for ($i = 0; $i < self::OBJECT_QUANTITY; $i++) {
            $supplierInfo = new SupplierInformation();
            $supplierInfo->setDueAmount(rand(500, 1200));
            $supplierInfo->setDueDate($date->add(new DateInterval('P' . rand(5, 20) . 'D')));
            $supplierInfo->setExchangeRate(rand(10, 20) / 10);
            $supplierInfo->setDueDollarsAmount($supplierInfo->getDueAmount() * $supplierInfo->getExchangeRate());
            $supplierInfo->setSupplier($this->getReference('supplier_0'));
            $supplierInfo->setBooking($this->getReference('booking_' . $i));
            $manager->persist($supplierInfo);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        // Return here all fixtures classes which ProgramFixtures depends on
        return [
            SupplierFixtures::class,
            BookingFixtures::class,
        ];
    }
}

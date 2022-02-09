<?php

namespace App\DataFixtures;

use App\Entity\SupplierPayment;
use DateInterval;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class SupplierPaymentFixtures extends Fixture
{
    public const OBJECT_QUANTITY = 25;
    public const STATUS = [
        'paid',
        'due',
    ];

    public function load(ObjectManager $manager): void
    {
        $date = new DateTime();
        for ($i = 0; $i < self::OBJECT_QUANTITY; $i++) {
            $supplierPayment = new SupplierPayment();
            $supplierPayment->setDate(new DateTime());
            $supplierPayment->setPaidAmount(rand(2, 4) * 1000);
            $supplierPayment->setDueCommission(rand(60, 90) * 10);
            $supplierPayment->setStatus('paid');
            $supplierPayment->setDueDateCommission($date->add(new DateInterval('P' . rand(5, 15) . 'D')));
            $supplierPayment->setSupplier($this->getReference('supplier_' . $i));
            $supplierPayment->setBooking($this->getReference('booking_' . $i));
            $supplierPayment->setDueAmount(rand(500, 1200));
            $supplierPayment->setDueDate($date->add(new DateInterval('P' . rand(5, 20) . 'D')));
            $supplierPayment->setExchangeRate(rand(10, 20) / 10);
            $supplierPayment->setDueDollarsAmount(
                $supplierPayment->getDueAmount() * $supplierPayment->getExchangeRate()
            );
            $supplierPayment->setSupplier($this->getReference('supplier_0'));
            $supplierPayment->setBooking($this->getReference('booking_' . $i));
            $manager->persist($supplierPayment);
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

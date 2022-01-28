<?php

namespace App\DataFixtures;

use App\Entity\ClientPayment;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ClientPaymentFixtures extends Fixture
{

    public const OBJECT_QUANTITY = 10;
    public const STATUS = [
        'paid',
        'due',
    ];

    public function load(ObjectManager $manager): void
    {
        for ($i = 0; $i <= self::OBJECT_QUANTITY; $i++) {
            $clientPayment = new ClientPayment();
            $clientPayment->setDate(new DateTime());
            $clientPayment->setAmount(rand(1000, 2500));
            $clientPayment->setStatus('paid');
            $clientPayment->setBooking($this->getReference('booking_' . $i));
            $clientPayment->setClient($this->getReference('client_' . $i));
            $manager->persist($clientPayment);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        // Return here all fixtures classes which ProgramFixtures depends on
        return [
            AClientFixtures::class,
            BookingFixtures::class,
        ];
    }
}

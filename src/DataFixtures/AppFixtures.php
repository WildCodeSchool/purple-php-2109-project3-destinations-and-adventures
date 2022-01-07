<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Client;
use App\Entity\Booking;
use App\Entity\ClientPayment;
use DateTime;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $client = new Client();
        $client->setName('Miss Diana');

        $booking = new Booking();
        $booking->setName('Sample Booking');
        $booking->setLeadCustomer($client);
        $booking->setTravelersCount(2);
        $booking->setDestination('France');
        $booking->setConfirmationDate(new DateTime());
        $booking->setDeparture(new DateTime());
        $booking->setReturnDate(new DateTime());

        $clientPayment1 = new ClientPayment();
        $clientPayment1->setAmount(5000);
        $clientPayment1->setBooking($booking);
        $clientPayment1->setClient($client);

        $clientPayment2 = new ClientPayment();
        $clientPayment2->setAmount(1200);
        $clientPayment2->setBooking($booking);
        $clientPayment2->setClient($client);

        $manager->persist($client);
        $manager->persist($booking);
        $manager->persist($clientPayment1);
        $manager->persist($clientPayment2);
        $manager->flush();
    }
}

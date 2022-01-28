<?php

namespace App\DataFixtures;

use App\Entity\Agent;
use App\Entity\Booking;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class BookingFixtures extends Fixture
{
    public const DESTINATIONS = [
        'France', 'Belgium', 'Switzerland', 'Spain', 'Portugal',
        'United States', 'Canada', 'Mexico', 'Brazil', 'Puerto Rico',
        'Slovenia', 'Slovakia', 'Romania', 'Serbia', 'Croatia',
        'Greece', 'Vienna', 'Austrich', 'Germany', 'Poland',
        'Russia', 'Ukraine', 'Monaco', 'Moldavia', 'Bielorussia',
        'Belgrade', 'Lituania', 'Finland', 'Norway', 'Luxembourg',
        'Sweden', 'Netherlands', 'Egypt', 'Zambia', 'Kenya',
        'Estonia', 'South Africa', 'Nepal', 'Moldova', 'Guyana',
        'Italy', 'Jamaica', 'Fiji', 'Cape Verde', 'Angola',
        'Ireland', 'Nauru', 'Curacao Island', 'Myanmar', 'Peru',
    ];

    public function load(ObjectManager $manager): void
    {
        $date = new DateTime();
        foreach (self::DESTINATIONS as $key => $destination) {
            $booking = new Booking();
            $booking->setReference(rand(10000, 99999));
            $booking->setName($destination . ' Booking');
            $booking->setLeadCustomer($this->getReference('client_' . $key));
            $booking->setTravelersCount(rand(3, 10));
            $booking->setDestination('Country');
            $booking->setConfirmationDate($date->modify('-' . rand(10, 30) . ' days'));
            $booking->setDeparture($date->modify('+' . rand(10, 30) . ' days'));
            $booking->setReturnDate($date->modify('+' . rand(25, 45) . ' days'));
            $booking->setTotal(rand(2500, 25000));
            $booking->setPerPerson($booking->getTotal() / $booking->getTravelersCount());
            $booking->setAgent($this->getReference('agent_' . rand(0, 7)));
            $this->addReference('booking_' . $key, $booking);
            $manager->persist($booking);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        // Return here all fixtures classes which ProgramFixtures depends on
        return [
            AClientFixtures::class,
            Agent::class
        ];
    }
}

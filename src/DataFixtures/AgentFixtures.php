<?php

namespace App\DataFixtures;

use App\Entity\Agent;
use App\Entity\Booking;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AgentFixtures extends Fixture
{
    public const AGENT = [
        "Placement Pros",
        "Oasis Travel",
        "Advantage Agency",
        "Sleek Solutions",
        "Head Start",
        "Message Mavens",
        "Speedy Getaways",
        "Emoville Agency",
    ];

    public function load(ObjectManager $manager): void
    {

        foreach (self::AGENT as $key => $agentName) {
            $agent = new Agent();
            $agent->setName($agentName);
            $agent->setCommission(rand(10, 25));
            $agent->setCommissionUnit('%');
            $this->addReference('agent_' . $key, $agent);
            $manager->persist($agent);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        // Return here all fixtures classes which ProgramFixtures depends on
        return [
            AClientFixtures::class
        ];
    }
}

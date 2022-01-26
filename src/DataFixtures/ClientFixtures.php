<?php

namespace App\DataFixtures;

use App\Entity\Client;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ClientFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $client = new Client();
        $client->setName('John Doe');
        $manager->persist($client);
        $client = new Client();
        $client->setName('Jane Doe');
        $manager->persist($client);
        $client = new Client();
        $client->setName('Lady Dy');
        $manager->persist($client);
        $client = new Client();
        $client->setName('Robert Martin');
        $manager->persist($client);

        $manager->flush();
    }
}

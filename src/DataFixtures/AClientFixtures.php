<?php

namespace App\DataFixtures;

use App\Entity\Client;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AClientFixtures extends Fixture
{

    public const NAMES = [
        'Rodrick', 'Oakley', 'Milo', 'Aspen', 'Marie',
        'Mara', 'Kayleigh', 'Leona', 'Cataleya', 'Aven',
        'Tessa', 'Charley', 'Samiya', 'Azariah', 'Muhammad',
        'Jenny', 'Faye', 'Paityn', 'Lilyan', 'Cadence',
        'Sarai', 'Madalyn', 'Meagan', 'Sariah', 'Sophie',
        'Shania', 'Aries', 'America', 'Brayleigh', 'Brinley',
        'Zariyah', 'Gisele', 'Hazel', 'Shaan', 'Aayden',
        'Paula', 'Gwendolyn', 'Rosa', 'Ved', 'Elinor',
        'Stetson', 'Bria', 'Maiya', 'Ammon', 'Stephanie',
        'Legend', 'Elony', 'Paityn', 'Chaya', 'Giovanni',
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::NAMES as $key => $name) {
            $client = new Client();
            $client->setName($name);
            $manager->persist($client);
            $this->addReference('client_' . $key, $client);
        }

        $manager->flush();
    }
}

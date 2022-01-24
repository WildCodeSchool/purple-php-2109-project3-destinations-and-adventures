<?php

namespace App\DataFixtures;

use App\Entity\Supplier;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class SupplierFixtures extends Fixture
{
    public const COMPANIES = [
        'Motel.ly', 'Hotelzo', 'Hotelfella', 'Lodging.ly', 'Hoteliq',
        'Hichurch', 'Cabinetwork', 'Palagiom', 'Midtuur', 'Kottier',
        'Hospitallars', 'Voluptuari', 'Ambushar', 'Prentic', 'Brixhem',
        'Shapeleyer', 'Bilding', 'HotelWhale', 'Bloostone', 'Honeymoonir',
        'Palac', 'KarpetBag', 'Marakech', 'Turist', 'Kampground',
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::COMPANIES as $key => $name) {
            $supplier = new Supplier();
            $supplier->setName($name);
            $this->addReference('supplier_' . $key, $supplier);
            $manager->persist($supplier);
        }

        $manager->flush();
    }
}

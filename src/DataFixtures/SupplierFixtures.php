<?php

namespace App\DataFixtures;

use App\Entity\Supplier;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class SupplierFixtures extends AbstractFixtures implements FixtureGroupInterface
{
    public const SUPPLIER_REFERENCE = 'supplier';
    public const MAX_LOOP = 10;

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $this->loadSuppliers($manager);
    }

    /**
     * @param ObjectManager $manager
     */
    private function loadSuppliers(ObjectManager $manager)
    {
        $faker = Factory::create();

        for ($i=0; $i<=self::MAX_LOOP; $i++) {
            $supplier = new Supplier();

            $supplier->setName($faker->name);
            $supplier->setPhone($faker->phoneNumber);
            $supplier->setAddress($faker->address);
            $supplier->setNumber(uniqid());

            $manager->persist($supplier);

            if ($i % AbstractFixtures::MAX_SIZE_FLUSH === 0) {
                $manager->flush();
            }

            $this->addReference(self::SUPPLIER_REFERENCE . $i, $supplier);
        }

        $manager->flush();
    }

    public static function getGroups(): array
    {
        return [AbstractFixtures::FIXTURE_GROUP_ENABLED];
    }
}
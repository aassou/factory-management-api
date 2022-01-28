<?php

namespace App\DataFixtures;

use App\Entity\Customer;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class CustomerFixtures extends AbstractFixtures implements FixtureGroupInterface
{
    public const CUSTOMER_REFERENCE = 'customer';
    public const MAX_LOOP = 10;

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $this->loadCustomers($manager);
    }

    /**
     * @param ObjectManager $manager
     */
    private function loadCustomers(ObjectManager $manager)
    {
        $faker = Factory::create();

        for ($i=0; $i<=self::MAX_LOOP; $i++) {
            $customer = new Customer();

            $customer->setName($faker->name);
            $customer->setAddress($faker->address);
            $customer->setPhone($faker->phoneNumber);
            $customer->setNumber($faker->randomNumber().uniqid());

            $manager->persist($customer);

            if ($i % AbstractFixtures::MAX_SIZE_FLUSH === 0) {
                $manager->flush();
            }

            $this->addReference(self::CUSTOMER_REFERENCE . $i, $customer);
        }

        $manager->flush();
    }

    /**
     * @return array
     */
    public static function getGroups(): array
    {
        return [AbstractFixtures::FIXTURE_GROUP_ENABLED];
    }
}
<?php

namespace App\DataFixtures;

use App\Entity\Customer;
use DateTime;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class CustomerFixtures extends AbstractFixtures
{
    public const CUSTOMER_REFERENCE = 'customer';

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $this->loadCustomer($manager);
    }

    /**
     * @param ObjectManager $manager
     */
    private function loadCustomer(ObjectManager $manager)
    {
        $faker = Factory::create();

        for ($i=0; $i<=50; $i++) {
            $customer = new Customer();

            $customer->setName($faker->name);
            $customer->setAddress($faker->address);
            $customer->setPhone($faker->phoneNumber);
            $customer->setNumber($faker->randomNumber().uniqid());

            $manager->persist($customer);

            if ($i % AbstractFixtures::MAX_SIZE_FLUSH === 0) {
                $manager->flush();
            }

            $this->addReference(self::CUSTOMER_REFERENCE.$i, $customer);
        }

        $manager->flush();
    }
}
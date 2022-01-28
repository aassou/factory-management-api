<?php

namespace App\DataFixtures;

use App\Entity\Customer;
use App\Entity\ExternalOrder;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class ExternalOrderFixtures extends AbstractFixtures implements DependentFixtureInterface, FixtureGroupInterface
{

    public const EXTERNAL_ORDER_REFERENCE = 'external_order';
    public const MAX_LOOP = 25;

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $this->loadExternalOrders($manager);
    }

    /**
     * @param ObjectManager $manager
     */
    private function loadExternalOrders(ObjectManager $manager)
    {
        $faker = Factory::create();

        for ($i=0; $i<=self::MAX_LOOP; $i++) {
            $customerReferenceIndex =
                CustomerFixtures::CUSTOMER_REFERENCE . rand(1,CustomerFixtures::MAX_LOOP);

            /** @var Customer $customer */
            $customer = $this->getReference($customerReferenceIndex);

            $externalOrder = new ExternalOrder();

            $externalOrder->setReference($faker->word);
            $externalOrder->setDescription($faker->text);
            $externalOrder->setCustomer($customer);

            $manager->persist($externalOrder);

            if ($i % AbstractFixtures::MAX_SIZE_FLUSH === 0) {
                $manager->flush();
            }

            $this->addReference(self::EXTERNAL_ORDER_REFERENCE . $i, $externalOrder);
        }

        $manager->flush();
    }

    /**
     * @inheritDoc
     */
    public function getDependencies(): array
    {
        return [
            CustomerFixtures::class
        ];
    }

    /**
     * @return array
     */
    public static function getGroups(): array
    {
        return [AbstractFixtures::FIXTURE_GROUP_DISABLED];
    }
}
<?php

namespace App\DataFixtures;

use App\Entity\Customer;
use App\Entity\ExternalOrder;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class ExternalOrderFixtures extends AbstractFixtures implements DependentFixtureInterface
{

    public const EXTERNAL_ORDER_REFERENCE = 'external_order';

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $this->loadExternalOrder($manager);
    }

    /**
     * @param ObjectManager $manager
     */
    private function loadExternalOrder(ObjectManager $manager)
    {
        $faker = Factory::create();

        for ($i=0; $i<=20; $i++) {
            $customerReferenceIndex = CustomerFixtures::CUSTOMER_REFERENCE . $i;

            /** @var Customer $customer */
            $customer = $this->getReference($customerReferenceIndex);

            $externalOrder = new ExternalOrder();
            $externalOrder->setReference($faker->word);
            $externalOrder->setDescription($faker->text);
            $externalOrder->setCustomer($customer);

            $manager->persist($externalOrder);
            $manager->flush();

            $this->addReference(self::EXTERNAL_ORDER_REFERENCE . $i, $externalOrder);
        }
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
}
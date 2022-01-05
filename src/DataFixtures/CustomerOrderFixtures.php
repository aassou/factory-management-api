<?php

namespace App\DataFixtures;

use App\Entity\Customer;
use App\Entity\CustomerOrder;
use App\Entity\Product;
use DateTime;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Exception;

class CustomerOrderFixtures extends AbstractFixtures implements DependentFixtureInterface
{

    /**
     * @param ObjectManager $manager
     * @throws Exception
     */
    public function load(ObjectManager $manager)
    {
        $this->loadCustomerOrder($manager);
    }


    /**
     * @throws Exception
     */
    public function loadCustomerOrder(ObjectManager $manager)
    {
        $faker = Factory::create();

        for ($i=0; $i<=100; $i++) {
            $customerOrder = new CustomerOrder();

            $quantity = $i + 2;
            $unitPrice = ($i + 1) * 1.5;

            $customerOrder->setDescription($faker->text);
            $customerOrder->setQuantity($quantity);
            $customerOrder->setUnitPrice($unitPrice);
            $customerOrder->setNegotiableUnitPrice($unitPrice);
            $customerOrder->setFinalTotlaPrice($quantity * $unitPrice);
            $customerOrder->setCreated(new DateTime());
            $customerOrder->setCreatedBy("admin");

            $productReferenceIndex = ProductFixtures::PRODUCT_REFERENCE.rand(0, 999);
            $customerReferenceIndex = CustomerFixtures::CUSTOMER_REFERENCE.rand(0, 50);

            /** @var Product $product */
            $product = $this->getReference($productReferenceIndex);

            /** @var Customer $customer */
            $customer = $this->getReference($customerReferenceIndex);

            if (!$product) {
                throw new Exception(sprintf("No class found with reference: %s", $productReferenceIndex));
            }

            if (!$customer) {
                throw new Exception(sprintf("No class found with reference: %s", $customerReferenceIndex));
            }

            $customerOrder->setCustomer($customer);
            $customerOrder->addProduct($product);

            $manager->persist($customerOrder);

            if ($i % AbstractFixtures::MAX_SIZE_FLUSH === 0) {
                $manager->flush();
            }
        }

        $manager->flush();
    }

    /**
     * @return string[]
     */
    public function getDependencies(): array
    {
        return [
            CustomerFixtures::class,
            ProductFixtures::class
        ];
    }
}
<?php

namespace App\DataFixtures;

use App\Entity\InternalOrder;
use App\Entity\Supplier;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class InternalOrderFixtures extends AbstractFixtures implements DependentFixtureInterface, FixtureGroupInterface
{
    public const INTERNAL_ORDER_REFERENEC = 'internal_order';
    public const MAX_LOOP = 25;

    /**
     * @inheritDoc
     */
    public function load(ObjectManager $manager)
    {
        $this->loadInternalOrders($manager);
    }

    /**
     * @param ObjectManager $manager
     */
    private function loadInternalOrders(ObjectManager $manager)
    {
        $faker = Factory::create();

        for ($i=0; $i<=self::MAX_LOOP; $i++) {
            $supplierReferenceIndex =
                SupplierFixtures::SUPPLIER_REFERENCE . rand(1, SupplierFixtures::MAX_LOOP);

            /** @var Supplier $supplier */
            $supplier = $this->getReference($supplierReferenceIndex);

            $internalOrder = new InternalOrder();

            $internalOrder->setReference($faker->word);
            $internalOrder->setDescription($faker->text);
            $internalOrder->setSupplier($supplier);

            $manager->persist($internalOrder);

            if ($i % AbstractFixtures::MAX_SIZE_FLUSH === 0) {
                $manager->flush();
            }

            $this->addReference(self::INTERNAL_ORDER_REFERENEC . $i, $internalOrder);
        }

        $manager->flush();
    }

    /**
     * @return string[]
     */
    public function getDependencies(): array
    {
        return [
            SupplierFixtures::class
        ];
    }

    /**
     * @inheritDoc
     */
    public static function getGroups(): array
    {
        return [AbstractFixtures::FIXTURE_GROUP_ENABLED];
    }
}
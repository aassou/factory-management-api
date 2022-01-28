<?php

namespace App\DataFixtures;

use App\Entity\InternalOrder;
use App\Entity\InternalOrderLine;
use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class InternalOrderLineFixtures extends AbstractFixtures implements DependentFixtureInterface, FixtureGroupInterface
{
    public const INTERNAL_ORDER_LINE = 'internal_order_line';
    public const MAX_LOOP = 50;

    /**
     * @inheritDoc
     */
    public function load(ObjectManager $manager)
    {
        $this->loadInternalOrderLines($manager);
    }

    /**
     * @param ObjectManager $manager
     */
    private function loadInternalOrderLines(ObjectManager $manager)
    {
        $faker = Factory::create();

        for ($i=0; $i<=self::MAX_LOOP; $i++) {
            $productReferenceIndex = ProductFixtures::PRODUCT_REFERENCE . rand(1, ProductFixtures::MAX_LOOP);

            /** @var Product $product */
            $product = $this->getReference($productReferenceIndex);

            $internalOrderLineReferenceIndex =
                InternalOrderFixtures::INTERNAL_ORDER_REFERENEC . rand(1, InternalOrderFixtures::MAX_LOOP);

            /** @var InternalOrder $internalOrder */
            $internalOrder = $this->getReference($internalOrderLineReferenceIndex);

            $unitPrice = $faker->randomNumber(2);
            $quantity = $faker->randomNumber(3);

            $internalOrderLine = new InternalOrderLine();

            $internalOrderLine->setDescription($faker->text);
            $internalOrderLine->setUnitPrice($unitPrice);
            $internalOrderLine->setQuantity($quantity);
            $internalOrderLine->setNegotiableUnitPrice($unitPrice);
            $internalOrderLine->setFinalTotlaPrice($quantity * $unitPrice);
            $internalOrderLine->setInternalOrder($internalOrder);
            $internalOrderLine->setProduct($product);

            $manager->persist($internalOrderLine);

            if ($i % AbstractFixtures::MAX_SIZE_FLUSH === 0) {
                $manager->flush();
            }
        }

        $manager->flush();
    }

    /**
     * @inheritDoc
     */
    public function getDependencies(): array
    {
        return [
            InternalOrderFixtures::class,
            ProductFixtures::class
        ];
    }

    /**
     * @return array
     */
    public static function getGroups(): array
    {
        return [AbstractFixtures::FIXTURE_GROUP_ENABLED];
    }
}
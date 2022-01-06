<?php

namespace App\DataFixtures;

use App\Entity\ExternalOrder;
use App\Entity\ExternalOrderLine;
use App\Entity\Product;
use DateTime;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class ExternalOrderLineFixtures extends AbstractFixtures implements DependentFixtureInterface, FixtureGroupInterface
{
    public const EXTERNAL_ORDER_LINE = 'external_order_line';
    public const MAX_LOOP = 50;

    /**
     * @inheritDoc
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $this->loadExternalOrderLines($manager);
    }

    /**
     * @param ObjectManager $manager
     */
    private function loadExternalOrderLines(ObjectManager $manager)
    {
        $faker = Factory::create();

        for ($i=0; $i<=self::MAX_LOOP; $i++) {
            $productReferenceIndex =
                ProductFixtures::PRODUCT_REFERENCE . rand(1, ProductFixtures::MAX_LOOP);
            /** @var Product $product */
            $product = $this->getReference($productReferenceIndex);

            $externalOrderReferenceIndex =
                ExternalOrderFixtures::EXTERNAL_ORDER_REFERENCE . rand(1, ExternalOrderFixtures::MAX_LOOP);
            /** @var ExternalOrder $externalOrder */
            $externalOrder = $this->getReference($externalOrderReferenceIndex);

            $unitPrice = $faker->randomNumber(2);
            $quantity = $faker->randomNumber(3);

            $externalOrderLine = new ExternalOrderLine();
            $externalOrderLine->setDescription($faker->text);
            $externalOrderLine->setUnitPrice($unitPrice);
            $externalOrderLine->setQuantity($quantity);
            $externalOrderLine->setNegotiableUnitPrice($unitPrice);
            $externalOrderLine->setFinalTotlaPrice($quantity * $unitPrice);
            $externalOrderLine->setExternalOrder($externalOrder);
            $externalOrderLine->setProduct($product);

            $manager->persist($externalOrderLine);

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
            ExternalOrderFixtures::class,
            ProductFixtures::class
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
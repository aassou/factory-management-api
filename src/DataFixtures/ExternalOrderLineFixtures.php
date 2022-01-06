<?php

namespace App\DataFixtures;

use App\Entity\ExternalOrder;
use App\Entity\ExternalOrderLine;
use App\Entity\Product;
use DateTime;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class ExternalOrderLineFixtures extends AbstractFixtures implements DependentFixtureInterface
{
    public const EXTERNAL_ORDER_LINE = 'external_order_line';

    /**
     * @inheritDoc
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $this->loadExternalOrderLine($manager);
    }

    /**
     * @param ObjectManager $manager
     */
    private function loadExternalOrderLine(ObjectManager $manager)
    {
        $faker = Factory::create();

        for ($i=0; $i<=20; $i++) {
            $productReferenceIndex = ProductFixtures::PRODUCT_REFERENCE . $i;
            /** @var Product $product */
            $product = $this->getReference($productReferenceIndex);

            $externalOrderReferenceIndex = ExternalOrderFixtures::EXTERNAL_ORDER_REFERENCE . $i;
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
            $externalOrderLine->setCreated(new DateTime());
            $externalOrderLine->setCreatedBy('admin');
            $externalOrderLine->setExternalOrder($externalOrder);
            $externalOrderLine->setProduct($product);

            $manager->persist($externalOrderLine);
            $manager->flush();
        }
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
}
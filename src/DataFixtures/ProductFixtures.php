<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Exception;
use Faker\Factory;

/**
 * @class ProductFixtures
 * @author Abdelilah Aassou <aassou.abdelilah@gmail.com>
 */
class ProductFixtures extends AbstractFixtures implements DependentFixtureInterface, FixtureGroupInterface
{

    public const PRODUCT_REFERENCE = 'product';
    public const MAX_LOOP = 10;

    /**
     * @param ObjectManager $manager
     * @throws Exception
     */
    public function load(ObjectManager $manager)
    {
        $this->loadProducts($manager);
    }

    /**
     * @param ObjectManager $manager
     * @throws Exception
     */
    private function loadProducts(ObjectManager $manager) {
        $faker = Factory::create();

        for ($i = 0; $i <= self::MAX_LOOP; $i++) {
            $product = new Product();

            $product->setReference($faker->ean8);
            $product->setLength($faker->randomFloat(2, 1, 1000));
            $product->setWidth($faker->randomFloat(2, 1, 10));
            $product->setHeight($faker->randomFloat(2, 2, 20));
            $product->setWeight($faker->randomFloat(2, 1, 50));
            $product->setPurchasePrice($faker->randomFloat(2, 1, 100));
            $product->setSalePrice($faker->randomFloat(2, 1, 100));
            $product->setImage(AbstractFixtures::LOREM_IMAGE_URL);

            $categoryReferenceIndex =
                CategoryFixtures::CATEGORY_REFERENCE.rand(1, CategoryFixtures::MAX_LOOP);

            /** @var Category $category */
            $category = $this->getReference($categoryReferenceIndex);

            if (!$category) {
                throw new Exception(sprintf("No class found with reference: %s", $categoryReferenceIndex));
            }

            $product->setCategory($category);

            $manager->persist($product);

            if ($i % AbstractFixtures::MAX_SIZE_FLUSH === 0) {
                $manager->flush();
            }

            $this->addReference(self::PRODUCT_REFERENCE.$i, $product);
        }

        $manager->flush();
    }

    /**
     * @return string[]
     */
    public function getDependencies(): array
    {
        return [
            CategoryFixtures::class
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
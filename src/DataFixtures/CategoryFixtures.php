<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

/**
 * @class CategoryFixtures
 * @author Abdelilah Aassou <aassou.abdelilah@gmail.com>
 */
class CategoryFixtures extends AbstractFixtures implements FixtureGroupInterface
{

    public const CATEGORY_REFERENCE = 'category';
    public const MAX_LOOP = 10;

    /**
     * @inheritDoc
     */
    public function load(ObjectManager $manager)
    {
        $this->loadCategory($manager);
    }

    /**
     * @param ObjectManager $manager
     */
    private function loadCategory(ObjectManager $manager) {
        $faker = Factory::create();

        for ($i=0; $i<=self::MAX_LOOP; $i++) {
            $category = new Category();

            $category->setName($faker->ean13);
            $category->setImage(AbstractFixtures::LOREM_IMAGE_URL);

            $manager->persist($category);

            if ($i % AbstractFixtures::MAX_SIZE_FLUSH === 0) {
                $manager->flush();
            }

            $this->addReference(self::CATEGORY_REFERENCE.$i, $category);
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
<?php

namespace App\DataFixtures;

use App\Entity\Category;
use DateTime;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

/**
 * @class CategoryFixtures
 * @author Abdelilah Aassou <aassou.abdelilah@gmail.com>
 */
class CategoryFixtures extends AbstractFixtures
{

    public const CATEGORY_REFERENCE = 'category';

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

        for ($i=0; $i<100; $i++) {
            $category = new Category();

            $category->setName($faker->ean13);
            $category->setImage(AbstractFixtures::LOREM_IMAGE_URL);
            $category->setCreated(new DateTime());
            $category->setCreatedBy("aassou");

            $manager->persist($category);

            if ($i % AbstractFixtures::MAX_SIZE_FLUSH === 0) {
                $manager->flush();
            }

            $this->addReference(self::CATEGORY_REFERENCE.$i, $category);
        }

        $manager->flush();
    }
}
<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

/**
 * @class AppFixture
 * @author Abdelilah Aassou <aassou.abdelilah@gmail.com>
 */
abstract class AbstractFixtures extends Fixture
{
    public const LOREM_IMAGE_URL = 'https://loremflickr.com/320/240/product';
    public const MAX_SIZE_FLUSH = 100;

    /**
     * @param ObjectManager $manager
     */
    abstract public function load(ObjectManager $manager);
}

<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\User;
use DateTime;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

/**
 * @class CategoryFixtures
 * @author Abdelilah Aassou <aassou.abdelilah@gmail.com>
 */
class UserFixtures extends AbstractFixtures
{

    public const USER_REFERENCE = 'user';

    /**
     * @var UserPasswordHasherInterface
     */
    private UserPasswordHasherInterface $encoder;

    /**
     * @param UserPasswordHasherInterface $encoder
     */
    public function __construct(UserPasswordHasherInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    /**
     * @inheritDoc
     */
    public function load(ObjectManager $manager)
    {
        $this->loadUser($manager);
    }

    /**
     * @param ObjectManager $manager
     */
    private function loadUser(ObjectManager $manager) {
        $user = new User();

        $user->setUsername('aassou');
        $user->setPassword($this->encoder->hashPassword($user, '076757080'));
        $user->setProfil('admin');
        $user->setStatus(1);

        $manager->persist($user);
        $manager->flush();
    }
}
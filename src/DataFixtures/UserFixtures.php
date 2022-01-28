<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

/**
 * @class CategoryFixtures
 * @author Abdelilah Aassou <aassou.abdelilah@gmail.com>
 */
class UserFixtures extends AbstractFixtures implements FixtureGroupInterface
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

    /**
     * @return array
     */
    public static function getGroups(): array
    {
        return [AbstractFixtures::FIXTURE_GROUP_ENABLED];
    }
}
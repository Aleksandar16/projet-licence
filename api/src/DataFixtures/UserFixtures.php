<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\User;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{

    private UserPasswordHasherInterface $hasher;

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }

    public function load(ObjectManager $manager): void
    {
        // create 20 products! Bam!
        for ($i = 0; $i < 3; $i++) {
            $user = new User();
            $user->setUsername('user'.$i);
            $user->setRoles(['ROLE_USER']);
            $password = $this->hasher->hashPassword($user, 'xxx');
            $user->setPassword($password);
            $manager->persist($user);
        }

        $manager->flush();
    }
}

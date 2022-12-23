<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
		// création d'un utilisateur ayant le rôle ROLE_USER
		$user = new User();
		$user->setEmail('user@user.com');
		$user->setPassword('$2y$13$foxM4gGEjV3dH9/yiGAUoOmjCJdaWuOHwlvyAkXH7MFMCQCqGe/NC');
		$user->setRoles(['ROLE_USER']);
        $manager->persist($user);

		// création d'un utilisateur ayant le rôle ROLE_ADMIN
		$admin = new User();
		$admin->setEmail('admin@admin.com');
		$admin->setPassword('$2y$13$.W2nUBdMY2XjYGg/NKut3usogsBfHJOdxacIwuHAGfw4FVTIAq4.m');
		$admin->setRoles(['ROLE_ADMIN']);
        $manager->persist($admin);

        $manager->flush();
    }
}

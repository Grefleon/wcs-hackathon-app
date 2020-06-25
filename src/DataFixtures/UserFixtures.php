<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setUsername('Billy');
        $user->setPassword($this->passwordEncoder->encodePassword($user,'password'));
        $user->setEmail('billy45000@gmail.com');
        $user->setAvatar();
        $user->setExperience();
        $user->setLevel();
        $user->setMoodTest(true);

        $manager->persist($user);

        $manager->flush();
    }
}

<?php

namespace App\DataFixtures;

use App\Entity\ExperienceList;
use App\Entity\Goal;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Security;

class UserFixtures extends Fixture implements DependentFixtureInterface
{
    private $passwordEncoder;

    public function getDependencies()
    {
        return [GoalSectionFixtures::class];
    }

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

        $goal = new Goal();
        $goal->setName('Voir ma famille dans la semaine');
        $goal->setSection($this->getReference('section_1'));
        $manager->persist($goal);
        $user->addGoal($goal);

        $goal = new Goal();
        $goal->setName('Faire une nouvelle recette');
        $goal->setSection($this->getReference('section_2'));
        $manager->persist($goal);
        $user->addGoal($goal);

        $goal = new Goal();
        $goal->setName('Aller au restaurant');
        $goal->setSection($this->getReference('section_2'));
        $manager->persist($goal);

        $entry = new ExperienceList();
        $entry->setReason('Inscription sur Smile');
        $entry->setAmount(200);
        $user->setExperience($user->getExperience() + 200);
        $manager->persist($entry);
        $user->addExperienceList($entry);

        $entry = new ExperienceList();
        $entry->setReason('Ajout d\'un avatar à mon profile');
        $entry->setAmount(200);
        $user->setExperience($user->getExperience() + 200);
        $manager->persist($entry);
        $user->addExperienceList($entry);

        $manager->persist($user);

        $manager->flush();
    }
}

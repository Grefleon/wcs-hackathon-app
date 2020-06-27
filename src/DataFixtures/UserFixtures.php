<?php

namespace App\DataFixtures;

use App\Entity\ExperienceList;
use App\Entity\Goal;
use App\Entity\GoalSection;
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


        //GoalFixtures//

        $goal = new Goal();
        $goal->setName('Voir ma famille dans la semaine');
        $goal->setSection($this->getReference('section_1'));
        $manager->persist($goal);
        $user->addGoal($goal);

        $goal = new Goal();
        $goal->setName('Se coucher à une heure prédéfinie');
        $goal->setSection($this->getReference('section_1'));
        $manager->persist($goal);
        $user->addGoal($goal);

        $goal = new Goal();
        $goal->setName('Faire le ménage');
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

        $goal = new Goal();
        $goal->setName('Faire un gâteau');
        $goal->setSection($this->getReference('section_2'));
        $manager->persist($goal);

        $goal = new Goal();
        $goal->setName('Sortir en ville');
        $goal->setSection($this->getReference('section_3'));
        $manager->persist($goal);
        $user->addGoal($goal);

        $goal = new Goal();
        $goal->setName('Voir des amis');
        $goal->setSection($this->getReference('section_3'));
        $manager->persist($goal);

        $goal = new Goal();
        $goal->setName('Faire une nouvelle rencontre');
        $goal->setSection($this->getReference('section_3'));
        $manager->persist($goal);

        $goal = new Goal();
        $goal->setName('Faire une séance de sport');
        $goal->setSection($this->getReference('section_4'));
        $manager->persist($goal);
        $user->addGoal($goal);

        $goal = new Goal();
        $goal->setName('Aller courir');
        $goal->setSection($this->getReference('section_4'));
        $manager->persist($goal);

        $goal = new Goal();
        $goal->setName('S\'inscrire à une activité sportive');
        $goal->setSection($this->getReference('section_4'));
        $manager->persist($goal);

        $goal = new Goal();
        $goal->setName('Acheter un album');
        $goal->setSection($this->getReference('section_5'));
        $manager->persist($goal);
        $user->addGoal($goal);

        $goal = new Goal();
        $goal->setName('Voir un concert');
        $goal->setSection($this->getReference('section_5'));
        $manager->persist($goal);

        $goal = new Goal();
        $goal->setName('Créer sa playlist');
        $goal->setSection($this->getReference('section_5'));
        $manager->persist($goal);

        //endGoal//

        $user->addInterest($this->getReference('section_5'));
        $user->addInterest($this->getReference('section_3'));
        $user->addInterest($this->getReference('section_1'));

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

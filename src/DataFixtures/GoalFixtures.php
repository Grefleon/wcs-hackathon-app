<?php

namespace App\DataFixtures;

use App\Entity\Goal;
use App\Entity\GoalSection;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class GoalFixtures extends Fixture implements DependentFixtureInterface
{
    public function getDependencies()
    {
        return [GoalSectionFixtures::class];
    }

    public function load(ObjectManager $manager)
    {
        $goal = new Goal();
        $goal->setGoal('Voir ma famille dans la semaine');
        $goal->setSection($this->getReference('section_1'));
        $manager->persist($goal);
        $goal = new Goal();
        $goal->setGoal('Faire une nouvelle recette');
        $goal->setSection($this->getReference('section_2'));
        $manager->persist($goal);
        $manager->flush();
    }
}


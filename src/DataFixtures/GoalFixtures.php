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
        $goal->setGoal('Dire pardon à Kaaris.');
        $goal->setSection($this->getReference('section_1'));
        $manager->persist($goal);
        $manager->flush();
    }
}


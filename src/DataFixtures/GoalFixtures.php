<?php

namespace App\DataFixtures;

use App\Entity\Goal;
use App\Entity\GoalSection;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class GoalFixtures extends Fixture
{

    public function load(ObjectManager $manager)
    {
    }
}


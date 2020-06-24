<?php

namespace App\DataFixtures;

use App\Entity\Goal;
use App\Entity\GoalSection;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class GoalSectionFixtures extends Fixture
{

    const SECTIONS = [
        'Paix',
        'Cuisine',
    ];

    public function load(ObjectManager $manager)
    {
        $key=1;
        foreach (self::SECTIONS as $sectionName){
            $section = new goalSection();
            $section->setName($sectionName);
            $this->addReference('section_' . $key, $section);
            $key++;
            $manager->persist($section);
            $manager->flush();
        }

    }
}


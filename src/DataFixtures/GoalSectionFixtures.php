<?php

namespace App\DataFixtures;

use App\Entity\Goal;
use App\Entity\GoalSection;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class GoalSectionFixtures extends Fixture
{

    const SECTIONS = [
        'Quotidien' => 'fas fa-home',
        'Cuisine'=> 'fas fa-carrot',
        'Social' => 'fas fa-users',
        'Sport' => 'fas fa-basketball-ball',
        'Musique' => 'fas fa-music',
        'Jeux Video' => 'fas fa-gamepad',
        'Developpement Web' => 'fas fa-laptop-code',
        'Science' => 'fas fa-microscope',
        'Autre' => 'far fa-grin-alt',
    ];

    public function load(ObjectManager $manager)
    {
        $key=1;
        foreach (self::SECTIONS as $sectionName => $sectionIcon){
            $section = new goalSection();
            $section->setName($sectionName);
            $section->setIcon($sectionIcon);
            $this->addReference('section_' . $key, $section);
            $key++;
            $manager->persist($section);
            $manager->flush();
        }

    }
}


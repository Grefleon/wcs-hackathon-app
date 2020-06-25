<?php

namespace App\DataFixtures;

use App\Entity\Psychologist;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class PsychologistFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');
        for($i=0; $i<4;$i++){
            $psy = new Psychologist();
            $psy->setName($faker->name);
            $psy->setPhone($faker->phoneNumber);
            $psy->setAddress($faker->address);
            $psy->setAvatar($faker->imageUrl(150,150,'business'));
            $psy->setCity('Orléans');
            $manager->persist($psy);
        }

        $manager->flush();
    }
}

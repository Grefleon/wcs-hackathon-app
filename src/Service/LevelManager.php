<?php


namespace App\Service;


use App\Entity\User;
use Doctrine\Persistence\ObjectManager;

class LevelManager
{
    public function check(User $user, ObjectManager $manager)
    {
        if ($user->getExperience() >= 1000){
            $user->setLevel($user->getLevel() + 1);
            $user->setExperience(0);
            $manager->persist($user);
            $manager->flush();
        }
    }
}
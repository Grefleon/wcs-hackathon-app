<?php


namespace App\Service;


use App\Entity\User;
use Doctrine\Persistence\ObjectManager;

class LevelManager
{
    private $manager;

    public function __construct(ObjectManager $manager)
    {
        $this->manager = $manager;
    }
    public function check(User $user)
    {
        if ($user->getExperience() >= 1000){
            $user->setLevel($user->getLevel() + 1);
            $user->setExperience(0);
            $manager = $this->manager;
            $manager->persist($user);
            $manager->flush();
        }
    }
}
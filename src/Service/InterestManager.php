<?php


namespace App\Service;


use App\Entity\User;

class InterestManager
{
    public function parseInterests(array $interests, User $user, bool $toggler = true): array
    {
        $result = [];

        foreach ($interests as $interest) {
            if ($interest->getUsers()->contains($user) === $toggler) {
                $result[] = $interest;
            }
        }

        return $result;
    }
}
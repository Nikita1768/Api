<?php

namespace App\Repository;

use App\DTO\UserData;
use App\Models\User;
use App\Services\UserService;

class UserRepository
{

    public function createUser(UserData $userData): User
    {
        return User::query()
            ->create($userData->toArray());
    }

    public function getByEmail(string $email): User
    {
        return User::query()
            ->where('email', $email)
            ->firstOrFail();
    }

    public function decrementPublication(): int
    {
        $user = auth()->user();
        $activePlan = $user->activePlan();
        $publications = $activePlan->pivot->publications;
        $user->plans()->sync([$activePlan->id => ['publications' => --$publications]]);
        return $publications;
    }
}

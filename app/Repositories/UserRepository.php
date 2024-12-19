<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UserRepository
{
    public function findByEmail(string $email): Model
    {
        $user = User::query()
            ->where('email', $email)
            ->first();

        if (!$user) {
            throw new ModelNotFoundException("User with email {$email} not found.");
        }

        return $user;
    }
}

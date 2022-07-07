<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function register(array $input): User
    {
        $input['password'] = Hash::make($input['password']);

        return User::create($input);
    }
}

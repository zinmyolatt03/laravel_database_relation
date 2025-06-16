<?php

namespace App\Repositories;

use App\Models\RefreshToken;
use App\Models\User;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserRepository{
    
    public function createUser($user_data)
    {
        return User::create($user_data);
    }
}
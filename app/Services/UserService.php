<?php

namespace App\Services;

use App\Http\Resources\UserResource;
use App\Models\RefreshToken;
use App\Models\User;
use Illuminate\Support\Str;
use App\Repositories\UserRepository;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserService{

    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function registerUser($user_data)
    {
        // creating random refresh token
        $refresh_token = Str::random(64);
        $user = $this->userRepository->createUser($user_data);
        $token = JWTAuth::fromUser($user);
        RefreshToken::create([
            'user_id' => $user->id,
            'token' => hash("sha256", $refresh_token),
        ]);

        return [
                'user' => new UserResource($user),
                'token' => $token,
                'refresh_token' => $refresh_token,
        ];
    }    
}
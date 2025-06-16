<?php

namespace App\Http\Controllers\Api;

use App\Api\HttpResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\UserRegisterRequest;
use App\Models\RefreshToken;
use App\Models\User;
use App\Services\UserService as ServicesUserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;
use UserService;

class AuthController extends Controller
{

    use HttpResponse;

    protected $userService;

    public function __construct(ServicesUserService $userService)
    {
        $this->userService = $userService;    
    }

    public function register(UserRegisterRequest $request)
    {
        $data = $this->userService->registerUser($request->validated());
        return $this->success('success', 201, 'user registered successfully', ['user' => $data['user'], 'token' => $data['token']])
        ->cookie('refresh_token', $data['refresh_token'], 60 * 24 * 7, null, null, true, true, false, "Strict");
    }
}

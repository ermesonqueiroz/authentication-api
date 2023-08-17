<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Resources\UserResource;
use App\Services\LoginService;
use Illuminate\Http\Request;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;

class AuthController extends Controller
{
    public function user(Request $userRequest): UserResource
    {
        return new UserResource($userRequest->user());
    }

    public function login(LoginRequest $loginRequest, LoginService $loginService): Application|ResponseFactory|Response
    {
        $data = $loginRequest->validated();
        $token = $loginService->run($data);
        return response($token);
    }

    public function logout(Request $logoutRequest): void
    {
        $logoutRequest->user()->currentAccessToken()->delete();
    }
}

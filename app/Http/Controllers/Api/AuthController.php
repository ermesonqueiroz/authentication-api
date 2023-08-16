<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\IncorrectLoginCredentials;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Resources\LoginResource;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(LoginRequest $request): JsonResponse
    {
        $data = $request->validated();

        if (Auth::attempt($data)) {
            $token = $request->user()->createToken($request['email']);
            $resource = new LoginResource((object) ['token' => $token->plainTextToken]);
            return $resource->response();
        }

        throw new IncorrectLoginCredentials();
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
    }
}

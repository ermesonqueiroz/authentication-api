<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use App\Exceptions\IncorrectLoginCredentials;

class LoginService {
    public function run(array $data): string
    {
        if (!Auth::attempt($data)) {
            throw new IncorrectLoginCredentials();
        }

        return Auth::user()->createToken($data['email'])->plainTextToken;
    }
}

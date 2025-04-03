<?php

namespace App\Services;

use Tymon\JWTAuth\Facades\JWTAuth;

class UserService
{
    public function login(array $credentials)
    {
        if (!$token = JWTAuth::attempt($credentials)) {
            return false;
        }
        return $token;
    }
}

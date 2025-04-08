<?php

namespace App\Services;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use App\Models\User;

class UserService
{
    public function login(array $credentials)
    {
        if (!$token = JWTAuth::attempt($credentials)) {
            return false;
        }
        return $token;
    }

    private $key;
    private $algorithm;
    
    public function __construct()
    {
        $this->key = env('JWT_SECRET', 'your-secret-key');
        $this->algorithm = 'HS256';
    }
    
    public function generateToken(User $user)
    {
        $issuedAt = time();
        $expirationTime = $issuedAt + 60 * 60 * 24; // 24 hours
        
        $payload = [
            'iat' => $issuedAt,             // Issued at
            'exp' => $expirationTime,       // Expiration
            'nbf' => $issuedAt,             // Not before
            'sub' => $user->id,             // Subject (user ID)
            'user' => [
                'id' => $user->id,
                'email' => $user->email,
                'name' => $user->name
            ]
        ];
        
        return JWT::encode($payload, $this->key, $this->algorithm);
    }
    
    public function validateToken($token)
    {
            $decoded = JWT::decode($token, new Key($this->key, $this->algorithm));
            return $decoded;
    }
    
    public function getUserFromToken($token)
    {
        $decoded = $this->validateToken($token);
        
        if (!$decoded) {
            return null;
        }
        
        return User::find($decoded->sub);
    }
}

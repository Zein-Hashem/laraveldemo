<?php

namespace App\Services;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use App\Models\User;
use App\DTO\LoginDTO;
use App\DTO\RegisterDTO;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function register(RegisterDto $registerDto)
    {
        $user = new User();
        $user->name=$registerDto->name;
        $user->email=$registerDto->email;
        $user->password=Hash::make($registerDto->password);
        $user->save();
        return $user;
    }

    public function login(LoginDTO $logindto)
    {
        $credentials = [
            'email' => $logindto->email,
            'password' => $logindto->password
        ];       
        $user = User::where('email', $credentials['email'])->first();
        
        if (!$user || !Hash::check($credentials['password'], $user->password)) {
            return response()->json([
                'error' => 'The provided credentials are incorrect.'
            ], 401);
        } 
        return $user;
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

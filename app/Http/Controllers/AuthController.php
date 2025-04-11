<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Exceptions\Handler;
use App\Exceptions\InvalidOrderException;
use App\Services\UserService;
use App\DTO\LoginDTO;
use App\DTO\RegisterDTO;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{    
    protected $jwtAuth;
    
    public function __construct(UserService $jwtAuth)
    {
        $this->jwtAuth = $jwtAuth;
    }
    public function login()
    {
        return view("auth.login");
    }
    public function loginPost(LoginRequest $request, UserService $userService)
    {

            $loginDto = LoginDTO::fromRequest($request);
            $user = $userService->login($loginDto);

            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid credentials.',
                ], 401);
            }

            $token = $this->jwtAuth->generateToken($user);

            return response()->json([
                'token' => $token,
                'user' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                ],
            ], 200);
    }
    public function me(Request $request)
    {
        return response()->json($request->user());
    }

    public function register()
    {
        return view("auth.register");
    }

    public function registerPost(RegisterRequest $request, UserService $userService)
    {
        
            $registerDto = RegisterDTO::fromRequest($request);
            $user = $userService->register($registerDto);

            if (!$user || !$user->save()) {
                return response()->json(['error' => 'User not validated'], 404);
            }

            return response()->json([
                'message' => 'User registered successfully',
            ], 201);
        
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Services\UserService;
use App\DTO\LoginDTO;
use App\DTO\RegisterDTO;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;

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
            return redirect(route('login'))->with('error', 'Invalid credentials');
        }
        
        $token = $this->jwtAuth->generateToken($user);
        
        return response()->json([
            'token' => $token,
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
            ]
        ]);
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
        $user=$userService->register($registerDto);
        if($user && $user->save()){
            return redirect(route('login'))->with("success","user created successfully");
        }
        return redirect(route('register'))->with('error','failed to create user');
    }

}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use Hash;
use Illuminate\Http\Request;
use App\Services\UserService;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function login()
    {
        return view("auth.login");
    }
    public function loginPost(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        $userService = app(UserService::class);
        $token = $userService->login($credentials);

        if (!$token) {
            return redirect(route('login'))->with("error", "Invalid credentials");
        }

        return response()->json(['token' => $token]);
    }

    public function getUser(Request $request)
    {
        $user = JWTAuth::user();
        return response()->json($user);
    }

    public function register()
    {
        return view("auth.register");
    }

    public function registerPost(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'email'=>'required',
            'password'=>'required',
        ]);
        $user = new User();
        $user->name=$request->name;
        $user->email=$request->email;
        $user->password=Hash::make($request->password);
        if($user->save()){
            return redirect(route('login'))->with("succes","user created successfully");
        }
        return redirect(route('register'))->with('error','failed to create user');
    }

}

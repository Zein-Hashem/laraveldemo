<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Services\UserService;

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
    public function loginPost(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        
        $user = User::where('email', $credentials['email'])->first();
        
        if (!$user || !Hash::check($credentials['password'], $user->password)) {
            return response()->json([
                'error' => 'The provided credentials are incorrect.'
            ], 401);
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

<?php

namespace App\Http\Controllers;

abstract class Controller
{
   /* public function loginPost(Request $request)
    {
        $credentials = $request->only('email', 'password');
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'Unauthorized'], 401);
            }
                return response()->json(['token' => $token]);
        
    }*/
}

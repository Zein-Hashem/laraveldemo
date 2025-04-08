<?php

namespace App\Http\Middleware;

use Closure;
use App\Services\JWTAuth;
use Illuminate\Http\Request;

class JWTAuthenticate
{
    protected $jwtAuth;
    
    public function __construct(JWTAuth $jwtAuth)
    {
        $this->jwtAuth = $jwtAuth;
    }
    
    public function handle(Request $request, Closure $next)
    {
        $token = $request->bearerToken();
        
        if (!$token) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        
        $user = $this->jwtAuth->getUserFromToken($token);
        
        if (!$user) {
            return response()->json(['error' => 'Invalid token'], 401);
        }
        $request->setUserResolver(function () use ($user) {
            return $user;
        });
        
        return $next($request);
    }
}
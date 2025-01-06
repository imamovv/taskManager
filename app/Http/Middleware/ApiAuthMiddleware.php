<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiAuthMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // Логика аутентификации
        if ($request->header('Authorization') !== 'Bearer your_token_here') {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        return $next($request);
    }
}
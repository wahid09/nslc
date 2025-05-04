<?php
// app/Http/Middleware/CheckApiKey.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use League\Flysystem\Config;

class CheckApiKey
{
    public function handle(Request $request, Closure $next)
    {
       // dd("Here");
        $apiKey = $request->header('X-API-KEY');
        //$validApiKey = \Config::get('API_KEY');
        $validApiKey = '85075e62-1d28-4bf6-b86f-cb28d7df45e8';
        if ($apiKey !== $validApiKey) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        return $next($request);
    }
}

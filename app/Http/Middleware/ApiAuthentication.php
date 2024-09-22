<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ApiAuthentication
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if the Authorization header exists
        if (!$request->hasHeader('Authorization')) {
            return response()->json(['message' => 'Unauthorized!', 'status' => 'fail'], 401);
        }

        // Extract the token from the Authorization header
        $apiKey = $request->bearerToken();

        // Validate the token using the default guard
        if (!Auth::guard('api')->check()) {
            return response()->json(['message' => 'Unauthorized!', 'status' => 'fail'], 401);
        }

        return $next($request);
    }
}


?>
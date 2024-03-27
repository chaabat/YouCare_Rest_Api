<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next, ...$roles)
    {

        if (! $request->user() || ! in_array($request->user()->role, $roles)) {
            return response()->json(['error' => 'Tu n est pas les droite pour faire cela'], 401);
        }

        return $next($request);
    }




}

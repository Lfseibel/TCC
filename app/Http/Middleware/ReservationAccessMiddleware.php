<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ReservationAccessMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $allowedUserTypes = ['Direcao', 'Comum', 'Admin'];
        if (auth()->check() && in_array(auth()->user()->type, $allowedUserTypes)) {
            return $next($request);
        }
        
        return redirect()->back();
    }
}

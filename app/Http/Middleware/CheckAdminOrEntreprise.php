<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAdminOrEntreprise
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check() && (auth()->user()->is('admins') || auth()->user()->is('entreprises'))) {
            return $next($request);
        }
        return redirect('/'); // Redirige l'utilisateur vers la page d'accueil ou une autre page en cas de non autorisation.
    }
    
}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class EntrepriseAccess
{
    public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::user()->isEntreprise()) {
            return $next($request);
        }

        return redirect()->route('login'); // Redirigez l'utilisateur vers la page de connexion ou une autre page appropriée.
    }
}

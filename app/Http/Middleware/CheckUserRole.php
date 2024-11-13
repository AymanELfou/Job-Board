<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckUserRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    /* public function handle(Request $request, Closure $next, string $role)
    {
        // Vérifie si l'utilisateur est authentifié
        if (!Auth::check()) {
            return redirect('login'); // Redirige vers la page de connexion si non authentifié
        }

        // Vérifie le rôle de l'utilisateur
        $user = Auth::user();
        if ($user->role !== $role) {
            return redirect('home'); // Redirige vers une page d'accueil si le rôle ne correspond pas
        }

        return $next($request);
    } */
    public function handle(Request $request, Closure $next, string $role)
    {
        // Vérifie si l'utilisateur est authentifié
        if (!Auth::check()) {
            return redirect('login'); // Redirige vers la page de connexion si non authentifié
        }
    
        // Vérifie le rôle de l'utilisateur
        $user = Auth::user();
        if ($user->role !== $role) {
            // Renvoie une réponse 403 Forbidden si le rôle ne correspond pas
            abort(403, 'Accès interdit.'); // Message d'erreur 403
        }
    
        return $next($request);
    }
    
}

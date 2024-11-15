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
  

    public function handle(Request $request, Closure $next, string $role)
    {
        // If the user does not have the required role, abort with 403
        if (!Auth::check()) {
            return redirect('login'); // Redirige vers la page de connexion si non authentifié
        }
    
        // Vérifie le rôle de l'utilisateur
        $user = Auth::user();

       

        // If the user does not have the required role, abort with 403
        if ($user->role !== $role) {
            abort(403, 'Accès interdit.'); // Message d'erreur 403
        }
    
        // Allow request to continue
        return $next($request);
    }
    
}

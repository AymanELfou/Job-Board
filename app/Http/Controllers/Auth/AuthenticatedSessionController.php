<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
{
    $request->authenticate();
    $request->session()->regenerate();

    // Role-based redirection
    $user = Auth::user();
    if ($user->role === 'admin') {
        return redirect()->route('admin.dashboard');
    } elseif ($user->role === 'employer') {
        return redirect()->route('employer.dashboard');
    } elseif ($user->role === 'Job Seeker') {
        return redirect()->route('jobseeker.dashboard');
    }

    return redirect('/'); // Fallback redirect if role not matched
}


    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }


    // In App\Http\Controllers\Auth\AuthenticatedSessionController
    /* protected function authenticated(Request $request, $user)
    {
    // Check user role and redirect accordingly
    if ($user->role === 'admin') {
        return redirect()->route('admin.dashboard');
    } elseif ($user->role === 'employer') {
        return redirect()->route('employer.dashboard');
    } elseif ($user->role === 'Job Seeker') {
        return redirect()->route('jobseeker.dashboard');
    }

    // Default redirect if role is not matched
    return redirect()->route('home');
    }    */



    
}

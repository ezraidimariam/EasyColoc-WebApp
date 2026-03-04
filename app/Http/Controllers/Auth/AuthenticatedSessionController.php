<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\Invitation;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
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

        // Gérer le token d'invitation après connexion
        if ($request->has('invitation_token')) {
            $token = $request->invitation_token;
            $invitation = Invitation::where('token', $token)
                ->where('status', 'pending')
                ->first();

            if ($invitation && $invitation->email === Auth::user()->email) {
                // Rediriger vers la page d'acceptation
                return redirect()->route('invitations.show', $token)
                    ->with('info', 'Connecté! Vous pouvez maintenant accepter l\'invitation.');
            }
        }

        return redirect()->intended(route('dashboard', absolute: false));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        // Nettoyer le token d'invitation à la déconnexion
        Session::forget('invitation_token');

        return redirect('/');
    }
}

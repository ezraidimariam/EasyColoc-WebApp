<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Invitation;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        // Gérer le token d'invitation après inscription
        if ($request->has('invitation_token')) {
            $token = $request->invitation_token;
            $invitation = Invitation::where('token', $token)
                ->where('status', 'pending')
                ->first();

            if ($invitation && $invitation->email === $user->email) {
                // Accepter automatiquement l'invitation
                $colocation = $invitation->colocation;
                
                // Vérifier si l'utilisateur n'est pas déjà membre
                if (!$colocation->members()->where('user_id', $user->id)->exists()) {
                    $colocation->members()->attach($user->id, ['joined_at' => now()]);
                }
                
                $invitation->accept();
                
                // Nettoyer le token de session
                Session::forget('invitation_token');
                
                return redirect()->route('colocations.show', $colocation)
                    ->with('success', 'Compte créé et vous avez rejoint la colocation avec succès!');
            }
        }

        return redirect(route('dashboard', absolute: false));
    }
}

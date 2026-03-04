<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invitation;
use App\Models\Colocation;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class InvitationController extends Controller
{
    public function __construct()
    {
        // Pas de middleware auth - on gère les 3 cas manuellement
    }

    public function show($token)
    {
        $invitation = Invitation::where('token', $token)
            ->where('status', 'pending')
            ->with('colocation', 'inviter')
            ->firstOrFail();

        // Cas 1: Utilisateur non connecté
        if (!Auth::check()) {
            // Stocker le token en session pour après inscription/connexion
            Session::put('invitation_token', $token);
            
            // Vérifier si l'email existe déjà
            $user = User::where('email', $invitation->email)->first();
            
            if ($user) {
                // L'utilisateur existe mais n'est pas connecté
                return redirect()->route('login')
                    ->with('info', 'Veuillez vous connecter pour rejoindre la colocation.');
            } else {
                // L'utilisateur n'existe pas - rediriger vers register
                return redirect()->route('register')
                    ->with('invitation_token', $token);
            }
        }

        // Cas 2: Utilisateur connecté mais email différent
        if (Auth::user()->email !== $invitation->email) {
            return view('invitations.error', [
                'message' => 'Cette invitation n\'est pas pour votre adresse email.'
            ]);
        }

        // Cas 3: Utilisateur connecté et déjà dans une colocation
        if (Auth::user()->activeColocation()) {
            return view('invitations.error', [
                'message' => 'Vous avez déjà une colocation active. Vous ne pouvez pas en rejoindre une nouvelle.'
            ]);
        }

        return view('invitations.show', compact('invitation'));
    }

    public function accept($token)
    {
        // Vérifier l'invitation
        $invitation = Invitation::where('token', $token)
            ->where('status', 'pending')
            ->firstOrFail();

        // Si utilisateur non connecté, le rediriger vers login avec token
        if (!Auth::check()) {
            Session::put('invitation_token', $token);
            return redirect()->route('login')
                ->with('info', 'Veuillez vous connecter pour accepter l\'invitation.');
        }

        // Vérifier si l'email correspond
        if (Auth::user()->email !== $invitation->email) {
            abort(403, 'Cette invitation n\'est pas pour votre adresse email.');
        }

        // Vérifier si déjà dans une colocation
        if (Auth::user()->activeColocation()) {
            return redirect()->route('dashboard')
                ->with('error', 'Vous avez déjà une colocation active.');
        }

        // Accepter l'invitation
        $colocation = $invitation->colocation;
        $user = Auth::user();

        // Vérifier si l'utilisateur n'est pas déjà membre
        if (!$colocation->members()->where('user_id', $user->id)->exists()) {
            $colocation->members()->attach($user->id, ['joined_at' => now()]);
        }
        
        $invitation->accept();

        // Nettoyer le token de session
        Session::forget('invitation_token');

        return redirect()->route('colocations.show', $colocation)
            ->with('success', 'Vous avez rejoint la colocation avec succès!');
    }

    public function reject($token)
    {
        if (!Auth::check()) {
            Session::put('invitation_token', $token);
            return redirect()->route('login')
                ->with('info', 'Veuillez vous connecter pour refuser l\'invitation.');
        }

        $invitation = Invitation::where('token', $token)
            ->where('status', 'pending')
            ->firstOrFail();

        if (Auth::user()->email !== $invitation->email) {
            abort(403, 'Cette invitation n\'est pas pour votre adresse email.');
        }

        $invitation->reject();
        Session::forget('invitation_token');

        return redirect()->route('dashboard')
            ->with('info', 'Vous avez refusé l\'invitation.');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invitation;
use App\Models\Colocation;
use Illuminate\Support\Facades\Auth;

class InvitationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show($token)
    {
        $invitation = Invitation::where('token', $token)
            ->where('status', 'pending')
            ->with('colocation', 'inviter')
            ->firstOrFail();

        if (Auth::user()->email !== $invitation->email) {
            abort(403, 'Cette invitation n\'est pas pour votre adresse email.');
        }

        if (Auth::user()->activeColocation()) {
            return view('invitations.error', [
                'message' => 'Vous avez déjà une colocation active. Vous ne pouvez pas en rejoindre une nouvelle.'
            ]);
        }

        return view('invitations.show', compact('invitation'));
    }

    public function accept($token)
    {
        $invitation = Invitation::where('token', $token)
            ->where('status', 'pending')
            ->firstOrFail();

        if (Auth::user()->email !== $invitation->email) {
            abort(403, 'Cette invitation n\'est pas pour votre adresse email.');
        }

        if (Auth::user()->activeColocation()) {
            return redirect()->route('dashboard')
                ->with('error', 'Vous avez déjà une colocation active.');
        }

        $colocation = $invitation->colocation;
        $user = Auth::user();

        $colocation->members()->attach($user->id, ['joined_at' => now()]);
        $invitation->accept();

        return redirect()->route('colocations.show', $colocation)
            ->with('success', 'Vous avez rejoint la colocation avec succès!');
    }

    public function reject($token)
    {
        $invitation = Invitation::where('token', $token)
            ->where('status', 'pending')
            ->firstOrFail();

        if (Auth::user()->email !== $invitation->email) {
            abort(403, 'Cette invitation n\'est pas pour votre adresse email.');
        }

        $invitation->reject();

        return redirect()->route('dashboard')
            ->with('info', 'Vous avez refusé l\'invitation.');
    }
}

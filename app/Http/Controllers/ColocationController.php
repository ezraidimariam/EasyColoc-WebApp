<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Colocation;
use App\Models\Invitation;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ColocationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();
        $activeColocation = $user->activeColocation();
        
        if ($activeColocation) {
            return redirect()->route('colocations.show', $activeColocation);
        }
        
        return view('colocations.index', [
            'ownedColocations' => $user->ownedColocations,
            'colocations' => $user->colocations,
        ]);
    }

    public function create()
    {
        if (Auth::user()->activeColocation()) {
            return redirect()->route('colocations.index')
                ->with('error', 'Vous avez déjà une colocation active.');
        }
        
        return view('colocations.create');
    }

    public function store(Request $request)
    {
        if (Auth::user()->activeColocation()) {
            return redirect()->route('colocations.index')
                ->with('error', 'Vous avez déjà une colocation active.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $colocation = Colocation::create([
            'name' => $request->name,
            'owner_id' => Auth::id(),
        ]);

        $colocation->members()->attach(Auth::id(), ['joined_at' => now()]);

        return redirect()->route('colocations.show', $colocation)
            ->with('success', 'Colocation créée avec succès!');
    }

    public function show(Colocation $colocation)
    {
        $this->authorize('view', $colocation);
        
        $balances = $colocation->calculateBalances();
        $settlements = $colocation->getSettlements();
        $expenses = $colocation->expenses()->orderBy('date', 'desc')->get();
        $invitations = $colocation->invitations()->where('status', 'pending')->get();
        
        return view('colocations.show', compact('colocation', 'balances', 'settlements', 'expenses', 'invitations'));
    }

    public function invite(Request $request, Colocation $colocation)
    {
        $this->authorize('manage', $colocation);
        
        $request->validate([
            'email' => 'required|email',
        ]);

        $invitation = Invitation::create([
            'email' => $request->email,
            'colocation_id' => $colocation->id,
            'invited_by' => Auth::id(),
        ]);

        return redirect()->route('colocations.show', $colocation)
            ->with('success', 'Invitation envoyée!');
    }

    public function leave(Colocation $colocation)
    {
        $user = Auth::user();
        
        if ($colocation->owner_id === $user->id) {
            return redirect()->route('colocations.show', $colocation)
                ->with('error', 'Le propriétaire ne peut pas quitter la colocation.');
        }

        $balances = $colocation->calculateBalances();
        $userBalance = $balances->get($user->id);
        
        if ($userBalance && $userBalance['balance'] < 0) {
            $user->updateReputation(-1);
        } else {
            $user->updateReputation(1);
        }

        $colocation->members()->updateExistingPivot($user->id, ['left_at' => now()]);

        return redirect()->route('colocations.index')
            ->with('success', 'Vous avez quitté la colocation.');
    }

    public function cancel(Colocation $colocation)
    {
        // Debug: Check if user is authenticated
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Vous devez être connecté.');
        }
        
        // Debug: Check authorization
        $this->authorize('manage', $colocation);
        
        // Debug: Log the cancellation
        \Log::info('User ' . Auth::user()->id . ' is cancelling colocation ' . $colocation->id);
        
        $balances = $colocation->calculateBalances();
        
        foreach ($balances as $balance) {
            if ($balance['balance'] < 0) {
                $balance['user']->updateReputation(-1);
            }
        }

        $colocation->update(['status' => 'cancelled']);

        return redirect()->route('colocations.index')
            ->with('success', 'Colocation annulée.');
    }

    public function removeMember(Colocation $colocation, User $member)
    {
        $this->authorize('manage', $colocation);
        
        if ($colocation->owner_id === $member->id) {
            return redirect()->route('colocations.show', $colocation)
                ->with('error', 'Vous ne pouvez pas retirer le propriétaire.');
        }

        $balances = $colocation->calculateBalances();
        $memberBalance = $balances->get($member->id);
        
        if ($memberBalance && $memberBalance['balance'] < 0) {
            $colocation->owner->updateReputation(-1);
        }

        $colocation->members()->updateExistingPivot($member->id, ['left_at' => now()]);

        return redirect()->route('colocations.show', $colocation)
            ->with('success', 'Membre retiré.');
    }
}

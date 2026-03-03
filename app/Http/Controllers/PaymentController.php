<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\Colocation;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request, Colocation $colocation)
    {
        $this->authorize('view', $colocation);
        
        $request->validate([
            'from_user_id' => 'required|exists:users,id',
            'to_user_id' => 'required|exists:users,id',
            'amount' => 'required|numeric|min:0.01',
            'description' => 'nullable|string|max:255',
        ]);

        // Verify both users are members of the colocation
        $memberIds = $colocation->activeMembers->pluck('id')->toArray();
        
        if (!in_array($request->from_user_id, $memberIds) || !in_array($request->to_user_id, $memberIds)) {
            return back()->with('error', 'Les deux utilisateurs doivent être des membres actifs de la colocation.');
        }

        // Create payment record
        Payment::create([
            'from_user_id' => $request->from_user_id,
            'to_user_id' => $request->to_user_id,
            'amount' => $request->amount,
            'colocation_id' => $colocation->id,
            'description' => $request->description,
        ]);

        return redirect()->route('colocations.show', $colocation)
            ->with('success', 'Paiement enregistré avec succès!');
    }
}

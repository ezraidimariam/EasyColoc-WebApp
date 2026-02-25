<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Expense;
use App\Models\Colocation;
use Illuminate\Support\Facades\Auth;

class ExpenseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create(Colocation $colocation)
    {
        $this->authorize('view', $colocation);
        
        return view('expenses.create', [
            'colocation' => $colocation,
            'categories' => Expense::getCategories(),
            'members' => $colocation->activeMembers,
        ]);
    }

    public function store(Request $request, Colocation $colocation)
    {
        $this->authorize('view', $colocation);
        
        $request->validate([
            'title' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0.01',
            'date' => 'required|date',
            'category' => 'required|string',
            'payer_id' => 'required|exists:users,id',
        ]);

        $memberIds = $colocation->activeMembers->pluck('id')->toArray();
        
        if (!in_array($request->payer_id, $memberIds)) {
            return back()->with('error', 'Le payeur doit être un membre actif de la colocation.');
        }

        Expense::create([
            'title' => $request->title,
            'amount' => $request->amount,
            'date' => $request->date,
            'category' => $request->category,
            'payer_id' => $request->payer_id,
            'colocation_id' => $colocation->id,
        ]);

        return redirect()->route('colocations.show', $colocation)
            ->with('success', 'Dépense ajoutée avec succès!');
    }

    public function edit(Colocation $colocation, Expense $expense)
    {
        $this->authorize('view', $colocation);
        
        if ($expense->colocation_id !== $colocation->id) {
            abort(404);
        }

        return view('expenses.edit', [
            'colocation' => $colocation,
            'expense' => $expense,
            'categories' => Expense::getCategories(),
            'members' => $colocation->activeMembers,
        ]);
    }

    public function update(Request $request, Colocation $colocation, Expense $expense)
    {
        $this->authorize('view', $colocation);
        
        if ($expense->colocation_id !== $colocation->id) {
            abort(404);
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0.01',
            'date' => 'required|date',
            'category' => 'required|string',
            'payer_id' => 'required|exists:users,id',
        ]);

        $memberIds = $colocation->activeMembers->pluck('id')->toArray();
        
        if (!in_array($request->payer_id, $memberIds)) {
            return back()->with('error', 'Le payeur doit être un membre actif de la colocation.');
        }

        $expense->update([
            'title' => $request->title,
            'amount' => $request->amount,
            'date' => $request->date,
            'category' => $request->category,
            'payer_id' => $request->payer_id,
        ]);

        return redirect()->route('colocations.show', $colocation)
            ->with('success', 'Dépense modifiée avec succès!');
    }

    public function destroy(Colocation $colocation, Expense $expense)
    {
        $this->authorize('view', $colocation);
        
        if ($expense->colocation_id !== $colocation->id) {
            abort(404);
        }

        $expense->delete();

        return redirect()->route('colocations.show', $colocation)
            ->with('success', 'Dépense supprimée avec succès!');
    }
}

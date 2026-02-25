<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Colocation extends Model
{
    protected $fillable = ['name', 'owner_id', 'status'];

    protected $casts = [
        'status' => 'string',
    ];

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function members()
    {
        return $this->belongsToMany(User::class)
            ->withPivot('joined_at', 'left_at')
            ->withTimestamps();
    }

    public function activeMembers()
    {
        return $this->members()->whereNull('colocation_user.left_at');
    }

    public function expenses()
    {
        return $this->hasMany(Expense::class);
    }

    public function invitations()
    {
        return $this->hasMany(Invitation::class);
    }

    public function calculateBalances()
    {
        $members = $this->activeMembers;
        $expenses = $this->expenses;
        
        $balances = [];
        
        foreach ($members as $member) {
            $balances[$member->id] = [
                'user' => $member,
                'paid' => 0,
                'share' => 0,
                'balance' => 0
            ];
        }
        
        $totalExpenses = $expenses->sum('amount');
        $memberCount = $members->count();
        
        if ($memberCount > 0) {
            $sharePerPerson = $totalExpenses / $memberCount;
            
            foreach ($expenses as $expense) {
                $balances[$expense->payer_id]['paid'] += $expense->amount;
            }
            
            foreach ($members as $member) {
                $balances[$member->id]['share'] = $sharePerPerson;
                $balances[$member->id]['balance'] = $balances[$member->id]['paid'] - $sharePerPerson;
            }
        }
        
        return collect($balances);
    }

    public function getSettlements()
    {
        $balances = $this->calculateBalances();
        $debtors = $balances->filter(fn($b) => $b['balance'] < 0);
        $creditors = $balances->filter(fn($b) => $b['balance'] > 0);
        
        $settlements = [];
        
        foreach ($debtors as $debtor) {
            foreach ($creditors as $creditor) {
                if ($debtor['balance'] < 0 && $creditor['balance'] > 0) {
                    $amount = min(abs($debtor['balance']), $creditor['balance']);
                    if ($amount > 0.01) {
                        $settlements[] = [
                            'from' => $debtor['user'],
                            'to' => $creditor['user'],
                            'amount' => round($amount, 2)
                        ];
                        
                        $debtor['balance'] += $amount;
                        $creditor['balance'] -= $amount;
                    }
                }
            }
        }
        
        return collect($settlements);
    }
}

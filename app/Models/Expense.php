<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    protected $fillable = ['title', 'amount', 'date', 'category', 'payer_id', 'colocation_id'];

    protected $casts = [
        'amount' => 'decimal:2',
        'date' => 'date',
    ];

    public function payer()
    {
        return $this->belongsTo(User::class, 'payer_id');
    }

    public function colocation()
    {
        return $this->belongsTo(Colocation::class);
    }

    public static function getCategories()
    {
        return [
            'Nourriture',
            'Loyer',
            'Factures',
            'Transport',
            'Ameublement',
            'Loisirs',
            'Autre'
        ];
    }
}

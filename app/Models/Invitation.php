<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Invitation extends Model
{
    protected $fillable = ['token', 'email', 'status', 'colocation_id', 'invited_by'];

    protected $casts = [
        'status' => 'string',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($invitation) {
            $invitation->token = Str::random(32);
        });
    }

    public function colocation()
    {
        return $this->belongsTo(Colocation::class);
    }

}
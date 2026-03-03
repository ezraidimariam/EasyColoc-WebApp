<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'reputation',
        'is_admin',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function ownedColocations()
    {
        return $this->hasMany(Colocation::class, 'owner_id');
    }

    public function colocations()
    {
        return $this->belongsToMany(Colocation::class)
            ->withPivot('joined_at', 'left_at')
            ->withTimestamps();
    }

    public function activeColocation()
    {
        return $this->colocations()
            ->whereNull('colocation_user.left_at')
            ->where('status', 'active')
            ->first();
    }

    public function expenses()
    {
        return $this->hasMany(Expense::class, 'payer_id');
    }

    public function invitations()
    {
        return $this->hasMany(Invitation::class, 'invited_by');
    }

    protected static function boot()
    {
        parent::boot();

        static::created(function ($user) {
            // Promote first user to admin
            if ($user->id === 1) {
                $user->is_admin = true;
                $user->save();
            }
        });
    }

    public function updateReputation($change)
    {
        $this->reputation += $change;
        $this->save();
    }

    public function isAdmin()
    {
        return $this->is_admin ?? false;
    }
}

<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'users';

    protected $fillable = [
        'name',
        'email',
        'username',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /* ==========================
     |  RELATIONS
     |==========================*/

    // User (PJ) ↔ IKU (many to many)
    public function ikus(): BelongsToMany
    {
        return $this->belongsToMany(Iku::class, 'iku_user');
    }

    // User ↔ Laporan (upload milik user)
    public function laporan(): HasMany
    {
        return $this->hasMany(Laporan::class);
    }

    /* ==========================
     |  ROLE HELPERS
     |==========================*/

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isPJ(): bool
    {
        return $this->role === 'pj';
    }
}

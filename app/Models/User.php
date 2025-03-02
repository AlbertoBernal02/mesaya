<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'active',
        'email_verified_at',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime', // Asegura que email_verified_at sea un timestamp
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($user) {
            if ($user->role === 'admin') {
                $user->email_verified_at = now();
            }
        });
    }

    // Relación con product
    public function product()
    {
        return $this->hasOne(Product::class, 'user_id');
    }
}

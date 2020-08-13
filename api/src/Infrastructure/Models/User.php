<?php

namespace Borto\Infrastructure\DB\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $table = "users";

    protected $fillable = [
        'name', 'email', 'password', 'active'
    ];

    protected $hidden = [
        'password'
    ];

    protected $casts = [
        'active' => 'boolean',
    ];
}

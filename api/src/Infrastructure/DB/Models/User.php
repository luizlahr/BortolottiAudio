<?php

namespace Borto\Infrastructure\DB\Models;

use Borto\Domain\Authentication\Entities\UserEntity;
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

    public function toEntity(): UserEntity
    {
        return new UserEntity(
            $this->id,
            $this->name,
            $this->email,
            $this->password,
            $this->active
        );
    }
}

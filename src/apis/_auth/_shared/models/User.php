<?php

namespace App\apis\_auth\_shared\models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'user';

    protected $fillable = ['name', 'email', 'password', 'role', 'active', 'blocked', 'activation_code'];

    protected $hidden = ['password', 'activation_code'];

    protected $attributes = [
        'role' => 'user',
        'active' => false,
        'blocked' => false,
    ];

    protected $casts = [
        'active' => 'boolean',
        'blocked' => 'boolean',
    ];
}

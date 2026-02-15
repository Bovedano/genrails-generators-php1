<?php

namespace App\apis\_auth\models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'user';

    protected $fillable = ['name', 'email', 'password', 'role'];

    protected $hidden = ['password'];

    protected $attributes = [
        'role' => 'user',
    ];
}

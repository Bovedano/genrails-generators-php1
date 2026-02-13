<?php

namespace App\apis\blog\models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $table = 'blog';

    protected $fillable = ['title', 'description', 'user_id'];
}

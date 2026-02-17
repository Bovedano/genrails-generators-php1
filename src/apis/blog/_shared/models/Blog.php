<?php

namespace App\apis\blog\_shared\models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $table = 'blog';

    protected $fillable = ['title', 'description', 'user_id'];
}

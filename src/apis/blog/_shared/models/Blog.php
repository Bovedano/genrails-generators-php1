<?php

namespace App\apis\blog\_shared\models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasUuids;

    protected $table = 'blog';

    protected $fillable = ['title', 'description', 'user_id'];
}

<?php

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Schema\Blueprint;

Capsule::schema()->create('blog', function (Blueprint $table) {
    $table->id();
    $table->string('title');
    $table->text('description');
    $table->unsignedBigInteger('user_id');
    $table->timestamps();
});
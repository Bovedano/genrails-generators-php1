<?php

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Schema\Blueprint;

Capsule::schema()->create('blog', function (Blueprint $table) {
    $table->uuid('id')->primary();
    $table->string('title');
    $table->text('description');
    $table->uuid('user_id');
    $table->timestamps();
});
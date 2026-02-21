<?php

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Schema\Blueprint;

Capsule::schema()->create('user', function (Blueprint $table) {
    $table->id();
    $table->string('name');
    $table->string('email')->unique();
    $table->string('password');
    $table->enum('role', ['user', 'admin'])->default('user');
    $table->boolean('active')->default(false);
    $table->boolean('blocked')->default(false);
    $table->string('activation_code', 6)->nullable();
    $table->timestamps();
});
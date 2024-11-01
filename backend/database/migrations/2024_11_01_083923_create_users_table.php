<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name'); 
            $table->string('email')->unique();
            $table->enum('gender', ['Male', 'Female', 'Other']);
            $table->string('password'); 
            $table->string('phone')->nullable(); // Opcional
            $table->date('birth_date')->nullable(); // Opcional
            $table->string('country'); 
            $table->string('cnpj')->unique()->nullable();
            $table->enum('role', ['candidate', 'recruiter'])->default('candidate'); // Obrigatório com valor padrão candidato
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
}
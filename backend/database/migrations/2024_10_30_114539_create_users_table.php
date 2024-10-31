<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\CountryEnum;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name')->nullable(); // Para Candidato
            $table->string('last_name')->nullable(); // Para Candidato
            $table->string('email')->unique();
            $table->enum('gender', ['Male', 'Female', 'Other'])->nullable(); // Para Candidato
            $table->string('password');
            $table->string('cpf', 14)->unique()->nullable(); // Para Candidato
            $table->string('phone', 20)->nullable(); // Para Candidato
            $table->date('birth_date')->nullable(); // Para Candidato
            $table->string('country')->nullable(); // Para Candidato
            $table->string('company_name')->nullable(); // Para Recrutador
            $table->string('cnpj', 18)->unique()->nullable(); // Para Recrutador
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
}
<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplicationsTable extends Migration
{
    public function up()
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('job_id')->constrained()->onDelete('cascade'); // Associa a candidatura à vaga
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Associa a candidatura ao candidato
            $table->text('resume')->nullable(); // Campo para o currículo
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('applications');
    }
}
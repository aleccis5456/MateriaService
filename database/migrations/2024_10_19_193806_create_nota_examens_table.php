<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('nota_examens', function (Blueprint $table) {
            $table->id();
            $table->foreignId('examen_id')->constrained('tareas');
            $table->unsignedBigInteger('alumno_id');
            $table->integer('nota');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nota_examens');
    }
};

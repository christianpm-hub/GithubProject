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
        Schema::create('profesor', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 100);
            $table->string('apellidos', 100);
            $table->enum('especialidad', ['Informática', 'Matemáticas', 'Administración', 'Laboratorio', 'otro'])->nullable();
            $table->date('falta')->nullable();
            $table->decimal('salario', 10, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profesor');
    }
};

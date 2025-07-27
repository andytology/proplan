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
       Schema::create('subtareas', function (Blueprint $table) {
    $table->id('id_subtarea');
    $table->foreignId('id_tarea')->constrained('tareas')->onDelete('cascade');
    $table->string('titulo');
    $table->string('estado')->default('Pendiente');
    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subtareas');
    }
};

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
        Schema::create('asignaciones', function (Blueprint $table) {
    $table->foreignId('id_usuario')->constrained('usuarios')->onDelete('cascade');
    $table->foreignId('id_proyecto')->constrained('proyectos')->onDelete('cascade');
    $table->string('rol_en_proyecto');
    $table->primary(['id_usuario', 'id_proyecto']);
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asignaciones');
    }
};

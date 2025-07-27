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
        Schema::create('presupuestos', function (Blueprint $table) {
    $table->id('id_presupuesto');
    $table->foreignId('id_tarea')->constrained('tareas')->onDelete('cascade');
    $table->decimal('monto_estimado', 12, 2);
    $table->decimal('costo_ejecutado', 12, 2)->default(0);
    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('presupuestos');
    }
};

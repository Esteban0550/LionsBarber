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
        Schema::create('citas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre'); // Nombre completo del cliente
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null'); // Usuario que agendó (opcional)
            $table->foreignId('barbero_id')->nullable()->constrained('users')->onDelete('set null'); // Barbero asignado
            $table->date('fecha');
            $table->time('hora');
            $table->enum('servicio', ['corte', 'barba', 'combo'])->default('corte');
            $table->enum('estado', ['pendiente', 'confirmada', 'cancelada', 'completada'])->default('pendiente');
            $table->text('notas')->nullable(); // Notas adicionales
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('citas');
    }
};

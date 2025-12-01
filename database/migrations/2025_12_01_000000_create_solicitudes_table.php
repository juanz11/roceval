<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('solicitudes', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_completo');
            $table->string('empresa')->nullable();
            $table->string('telefono');
            $table->string('correo');
            $table->string('pais_origen')->nullable();
            $table->string('ciudad_origen')->nullable();
            $table->string('pais_destino')->nullable();
            $table->string('ciudad_destino')->nullable();
            $table->date('fecha_recogida');
            $table->string('tipo_carga')->nullable();
            $table->string('tipo_servicio')->nullable();
            $table->integer('cantidad_bultos')->nullable();
            $table->decimal('peso_bruto', 10, 2)->nullable();
            $table->text('dimensiones')->nullable();
            $table->string('servicios_aduaneros')->nullable();
            $table->string('estado')->default('pendiente');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('solicitudes');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('choferes', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('cedula')->unique();

            $table->string('placa_chuto')->nullable();
            $table->string('marca_chuto')->nullable();
            $table->unsignedSmallInteger('ano_chuto')->nullable();
            $table->string('color_chuto')->nullable();

            $table->string('placa_batea')->nullable();
            $table->unsignedSmallInteger('ano_batea')->nullable();
            $table->string('marca_batea')->nullable();
            $table->string('color_batea')->nullable();

            $table->string('numero_contenedor')->nullable();
            $table->string('marca_contenedor')->nullable();
            $table->string('color_contenedor')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('choferes');
    }
};

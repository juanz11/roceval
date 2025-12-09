<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('cotizaciones', function (Blueprint $table) {
            $table->id();
            $table->foreignId('solicitud_id')->constrained('solicitudes')->onDelete('cascade');
            $table->decimal('precio_total', 15, 2);
            $table->string('moneda', 10)->default('USD');
            $table->string('tiempo_transito')->nullable();
            $table->string('validez_oferta')->nullable();
            $table->boolean('incluye_aduanas')->default(true);
            $table->boolean('incluye_seguro')->default(false);
            $table->text('observaciones')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cotizaciones');
    }
};

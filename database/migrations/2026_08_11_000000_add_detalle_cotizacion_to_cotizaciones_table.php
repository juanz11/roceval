<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('cotizaciones', function (Blueprint $table) {
            $table->string('tipo_documentacion', 50)->default('simple');
            $table->boolean('doble_papeleria')->default(false);
            $table->decimal('gastos_logisticos', 15, 2)->default(0.00);
            $table->decimal('cruce_frontera', 15, 2)->default(0.00);
            $table->decimal('transbordo', 15, 2)->default(0.00);
        });
    }

    public function down(): void
    {
        Schema::table('cotizaciones', function (Blueprint $table) {
            $table->dropColumn(['tipo_documentacion', 'doble_papeleria', 'gastos_logisticos', 'cruce_frontera', 'transbordo']);
        });
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('solicitudes', function (Blueprint $table) {
            $table->date('fecha_inicial')->nullable()->after('fecha_recogida');
            $table->date('fecha_final')->nullable()->after('fecha_inicial');
        });
    }

    public function down(): void
    {
        Schema::table('solicitudes', function (Blueprint $table) {
            $table->dropColumn(['fecha_inicial', 'fecha_final']);
        });
    }
};

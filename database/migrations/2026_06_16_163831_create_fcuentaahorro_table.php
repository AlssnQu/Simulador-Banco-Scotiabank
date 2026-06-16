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
        Schema::create('fcuentaahorro', function (Blueprint $table) {
            $table->id('pkcuentaahorro');
            $table->integer('periododia'); // Para las métricas de tiempo de power bi
            $table->integer('pkcliente');
            $table->integer('pkproductoahorro');
            $table->string('codcuentaahorro', 20);
            $table->decimal('tasainterescuenta', 10, 6)->default(0.00);
            $table->decimal('montosaldodisponible_ac', 14, 4)->default(0.0000);
            $table->char('activo', 1)->default('S');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fcuentaahorro');
    }
};
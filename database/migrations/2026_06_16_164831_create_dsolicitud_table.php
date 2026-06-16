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
        Schema::create('dsolicitud', function (Blueprint $table) {
            $table->id('pksolicitud');
            $table->string('codsolicitud', 20)->unique();
            $table->integer('pkcliente');
            $table->integer('pkproducto'); // Tipo de préstamo
            
            // Estados: 'PE' (Pendiente), 'AP' (Aprobado), 'RE' (Rechazado)
            $table->char('codsolicitudestado', 2)->default('PE'); 
            
            $table->decimal('montosolicitudcredito', 14, 4);
            $table->integer('nrocuotasolicitud');
            $table->integer('plazosolicitudcredito'); // Días o meses
            $table->date('fechasolicitudcredito');
            
            $table->decimal('montoaprobadocredito', 14, 4)->nullable();
            $table->decimal('tasainterescompensatoria', 10, 6)->nullable(); // para la tasa
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dsolicitud');
    }
};

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
    Schema::table('users', function (Blueprint $table) {
        // campos después del ID
        $table->string('document_type')->default('DNI')->after('id');
        $table->string('document_number')->unique()->nullable()->after('document_type');
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
    Schema::table('users', function (Blueprint $table) {
        // eliminar los campos si hay rollback
        $table->dropColumn(['document_type', 'document_number']);
    });
    }
};

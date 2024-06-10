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
    Schema::create('inventarios', function (Blueprint $table) {
        $table->id('inventario_id'); // Primary key
        $table->integer('stock');
        $table->dateTime('fecha_movimiento');
        $table->string('tipo_movimiento');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventarios');
    }
};

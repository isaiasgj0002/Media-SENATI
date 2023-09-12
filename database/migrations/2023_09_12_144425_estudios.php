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
        Schema::create('estudios', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('escuela');
            $table->string('ciudad');
            $table->string('pais');
            $table->datetime('fecha_inicio');
            $table->datetime('fecha_fin');
            $table->integer('id_usuario');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('estudios');
    }
};

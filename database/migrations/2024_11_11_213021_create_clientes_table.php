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
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('identificacion')->unique();
            $table->string('telefono');
            $table->string('telefono2')->nullable();
            $table->string('email');
            $table->string('direccion')->nullable();

            $table->unsignedBigInteger('empresa_id');
            $table->foreign('empresa_id')->references('id')->on('empresas')->onDelete('cascade');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clientes');
    }
};

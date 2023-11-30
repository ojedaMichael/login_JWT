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
        Schema::create('enlaces', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idPagina');
            $table->foreign('idPagina')->references('id')->on('paginas')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger("idRol");
            $table->foreign('idRol')->references('id')->on('rols')->onDelete('cascade')->onUpdate('cascade');
            $table->string("descripcion");
            $table->date('fechaCreacion');
            $table->date('fechaModificacion');
            $table->string('usuarioCreacion');
            $table->string('usuarioModificacion');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enlaces');
    }
};

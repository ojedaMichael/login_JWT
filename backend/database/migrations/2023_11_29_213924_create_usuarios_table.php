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
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idPersona');
            $table->foreign('idPersona')->references('id')->on('personas')->onDelete('cascade')->onUpdate('cascade');
            $table->string('usuario');
            $table->string('clave');
            $table->string('habilitado');
            $table->date('fecha');
            $table->unsignedBigInteger('idRol');
            $table->foreign('idRol')->references('id')->on('rols')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('usuarios');
    }
};

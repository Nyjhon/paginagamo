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
        Schema::create('documents', function (Blueprint $table) {
                $table->id();
                $table->string('titulo');
                $table->text('contenido')->nullable(); // descripción o resumen
                $table->date('fecha');
                $table->string('archivo'); // ruta del archivo en el disco
                $table->foreignId('folders_id')->constrained('folders')->onDelete('cascade');
                $table->integer('id_user');
                $table->boolean('visible');
                $table->timestamps();
                $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};

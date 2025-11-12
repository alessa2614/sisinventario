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
        Schema::create('bienes', function (Blueprint $table) {
            $table->id();

            $table->string('codigo_patrimonial')->unique()->nullable();
            $table->string('descripcion');
            $table->unsignedBigInteger('area_id');
            $table->unsignedBigInteger('estado_id');
            $table->date('fecha_adquisicion')->nullable();
            $table->string('numero_doc');
            $table->string('tipo_documento');
            $table->string('marca')->nullable();
            $table->string('modelo')->nullable();
            $table->string('serial')->unique()->nullable();
            $table->string('medidas')->nullable();
            $table->string('color')->nullable();
            $table->unsignedBigInteger('categoria_id');
            $table->decimal('valor_inicial', 10, 2)->nullable();
            $table->decimal('depreciacion', 10, 2)->nullable();
            $table->unsignedBigInteger('director_id');
            $table->string('observaciones')->nullable();
            

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bienes');
    }
};

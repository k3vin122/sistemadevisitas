<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('registros', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('rut');
            $table->string('nombres');
            $table->string('apellidos');
            $table->unsignedBigInteger('proveedor_id');
            $table->string('motivo');
            $table->unsignedBigInteger('estado_id');
            $table->unsignedBigInteger('user_id');
            $table->boolean('is_duplicated')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registros');
    }
};

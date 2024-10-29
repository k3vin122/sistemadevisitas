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
        Schema::table('registros', function (Blueprint $table) {
            $table
                ->foreign('proveedor_id')
                ->references('id')
                ->on('proveedors')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table
                ->foreign('estado_id')
                ->references('id')
                ->on('estados')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table
                ->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('registros', function (Blueprint $table) {
            $table->dropForeign(['proveedor_id']);
            $table->dropForeign(['estado_id']);
            $table->dropForeign(['user_id']);
        });
    }
};

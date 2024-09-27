<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('cargos', function (Blueprint $table) {
        $table->unsignedBigInteger('empleado_id')->nullable(); // Si el empleado es opcional
        $table->foreign('empleado_id')->references('id')->on('empleados')->onDelete('set null');
    });
}
    /**
     * Reverse the migrations.
     */
    public function down()
{
    Schema::table('cargos', function (Blueprint $table) {
        $table->dropForeign(['empleado_id']);
        $table->dropColumn('empleado_id');
    });
}
};

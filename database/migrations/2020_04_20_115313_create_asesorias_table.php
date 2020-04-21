<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAsesoriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asesorias', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('boleta_id');
            $table->foreign('boleta_id')
                ->references('id')->on('boletas')
                ->onDelete('cascade');

            $table->unsignedBigInteger('asesor_id')->nullable();
            $table->foreign('asesor_id')
                ->references('id')->on('asesors')
                ->onDelete('set null');

            $table->unsignedBigInteger('curso_id')->nullable();
            $table->foreign('curso_id')
                ->references('id')->on('cursos')
                ->onDelete('set null');

            $table->dateTime('fecha');
            $table->dateTime('h_inicio');
            $table->dateTime('h_final');
            $table->integer('duracion');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('asesorias');
    }
}

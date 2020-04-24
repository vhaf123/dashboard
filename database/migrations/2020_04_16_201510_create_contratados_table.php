<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContratadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contratados', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('boleta_id');
            $table->foreign('boleta_id')
                ->references('id')->on('boletas')
                ->onDelete('cascade');

            $table->unsignedBigInteger('curso_id');
            $table->foreign('curso_id')
                ->references('id')->on('cursos')
                ->onDelete('cascade');

            $table->unsignedBigInteger('nivel_id');
            $table->foreign('nivel_id')
                ->references('id')->on('niveles')
                ->onDelete('cascade');

            $table->string('dias', 100);

            $table->dateTime('h_inicio');
            $table->dateTime('h_final');

            $table->boolean('generado')->default(false);

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
        Schema::dropIfExists('contratados');
    }
}

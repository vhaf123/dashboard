<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBoletasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('boletas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->enum('estado', ['GENERADO', 'IMPRESO', 'ANULADO'])->default('GENERADO');
            $table->unsignedBigInteger('cliente_id');
            $table->unsignedBigInteger('categoria_id')->nullable();
            $table->integer('numero_alumnos')->unsigned()->default(1);
            $table->string('alumno', 100)->nullable();
            $table->unsignedBigInteger('institucion_id')->nullable();
            $table->unsignedBigInteger('paquete_id')->nullable();
            $table->integer('horas')->nullable();
            $table->integer('sesiones')->unsigned();
            $table->integer('anticipo')->unsigned()->nullable();
            $table->dateTime('inicio')->nullable();
            $table->dateTime('culminacion')->nullable();
            $table->unsignedInteger('costo')->default(0);
            $table->unsignedInteger('saldo')->default(0);
            $table->unsignedBigInteger('admin_id')->nullable();
            $table->timestamps();

            /* Llaves foraneas */
            $table->foreign('cliente_id')
                ->references('id')->on('clientes')
                ->onDelete('cascade');

            $table->foreign('categoria_id')
                ->references('id')->on('categorias')
                ->onDelete('set null');

            $table->foreign('institucion_id')
                ->references('id')->on('instituciones')
                ->onDelete('set null');
                
            $table->foreign('paquete_id')
                ->references('id')->on('paquetes')
                ->onDelete('set null');
                
            $table->foreign('admin_id')
                ->references('id')->on('admins')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('boletas');
    }
}

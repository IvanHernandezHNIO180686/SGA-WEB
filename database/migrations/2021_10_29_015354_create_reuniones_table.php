<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReunionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reuniones', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
            $table->collation = 'utf8_unicode_ci';
            $table->id();
            $table->string('NombreReunion',45);
            $table->unsignedBigInteger('auditoria_id');
            $table->date('FechaReunion');
            $table->time('HoraInicio')->nullable();
            $table->time('HoraTermino')->nullable();
            $table->text('Observaciones')->nullable();
            $table->unsignedBigInteger('tipo_sesione_id');
            $table->unsignedBigInteger('estatu_id');

            $table->foreign('auditoria_id')
            ->references('id')
            ->on('auditorias')
            ->onDelete('cascade');

            $table->foreign('tipo_sesione_id')
            ->references('id')
            ->on('tipo_sesiones')
            ->onDelete('cascade');

            $table->foreign('estatu_id')
            ->references('id')
            ->on('estatus')
            ->onDelete('cascade');

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
        Schema::dropIfExists('reuniones');
    }
}

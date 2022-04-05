<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArchivosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('archivos', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
            $table->collation = 'utf8_unicode_ci';
            $table->id();
            $table->uuid('uuid')->nullable();
            $table->text('Folio');
            $table->text('NombreRequerimiento');
            $table->text('Ruta')->nullable();
            $table->text('Descripcion')->nullable();
            $table->unsignedBigInteger('acuerdo_id');


            $table->foreign('acuerdo_id')->references('id')->on('acuerdos')->onDelete('cascade');


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
        Schema::dropIfExists('archivos');
    }
}

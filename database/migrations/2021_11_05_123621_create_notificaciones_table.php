<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notificaciones', function (Blueprint $table) {
        $table->engine = 'InnoDB';
        $table->charset = 'utf8';
        $table->collation = 'utf8_unicode_ci';
        $table->id();
        $table->string('NombreNotificacion');
        $table->string('Accion');
        $table->string('id_usuario');
        $table->string('Estado');
        $table->unsignedBigInteger('tipo_notificacione_id');

        $table->foreign('tipo_notificacione_id')
        ->references('id')
        ->on('tipo_notificaciones')
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
        Schema::dropIfExists('notificaciones');
    }
}

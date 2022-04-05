<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAcuerdosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('acuerdos', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
            $table->collation = 'utf8_unicode_ci';
            $table->id();
            $table->text('NumeroAcuerdo');
            $table->text('Auditoria');
            $table->text('Responsable');
            $table->text('Comite');
            $table->date('FechaCumplimiento');
            $table->text('Observaciones')->nullable();
            $table->unsignedBigInteger('reunione_id');

            $table->foreign('reunione_id')
                ->references('id')
                ->on('reuniones')
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
        Schema::dropIfExists('acuerdos');
    }
}

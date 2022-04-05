<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comites', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
            $table->collation = 'utf8_unicode_ci';
            $table->id();
            $table->string('SiglasComite',45);
            $table->string('NombreComite',45);
            $table->integer('SesionesOrdinarias')->nullable();
            $table->integer('SesionesExtraordinarias')->nullable();
            $table->unsignedBigInteger('auditoria_id')->unique();

            $table->foreign('auditoria_id')
            ->references('id')
            ->on('auditorias')
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
        Schema::dropIfExists('comites');
    }
}

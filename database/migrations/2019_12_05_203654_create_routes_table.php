<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoutesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('routes', function (Blueprint $table) {
            $table->bigIncrements('id_route');
            $table->integer('id_sector');
            $table->string('color_route',50);
            $table->string('difficulty_route',3)->nullable();
            $table->string('url_photo',150)->nullable();
            $table->integer('score_route')->default(1000);
            $table->integer('nb_user_done')->default(0);
            $table->foreign('id_sector')->references('id_sector')->on('sectors');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('routes');
    }
}

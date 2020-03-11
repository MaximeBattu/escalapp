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
            $table->integer('id_color');
            $table->integer('id_color_secondary')->nullable();
            $table->string('difficulty_route',3)->nullable();
            $table->string('url_photo',150)->nullable();
            $table->integer('score_route')->nullable()->default(1000);
            $table->integer('nb_user_done')->default(0);
            $table->string('labels')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });

        Schema::table('routes', function(Blueprint $table) {
            $table->foreign('id_sector')->references('id_sector')->on('sectors');
            $table->foreign('id_color')->references('id_color')->on('colors_routes');
            $table->foreign('id_color_secondary')->references('id_color')->on('colors_routes');
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

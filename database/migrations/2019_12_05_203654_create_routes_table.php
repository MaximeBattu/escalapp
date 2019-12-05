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
            $table->integer('id_room');
            $table->string('color_route',50);
            $table->text('difficulty_route',3);
            $table->text('type_route',1);
            $table->string('url_photo',150);
            $table->integer('score_route')->default(1000);
            $table->foreign('id_room')->references('id_room')->on('rooms');
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
        Schema::dropIfExists('routes');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFinishedRoutesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('finished_routes', function (Blueprint $table) {
            $table->integer('id_route');
            $table->integer('id_user');
            $table->integer('id_room');
            $table->integer('score_contest')->default(0);
            $table->string('method',100)->default('A vue');
            $table->string('rate_desc',200)->nullable();
            $table->primary(['id_route','id_user']);
            $table->timestamps();
        });

        Schema::table('finished_toutes', function(Blueprint $table) {
           $table->foreign('id_route')->references('id_route')->on('routes');
           $table->foreign('id_user')->references('id')->on('users');
           $table->foreign('id_room')->references('id_room')->on('rooms');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('finished_routes');
    }
}

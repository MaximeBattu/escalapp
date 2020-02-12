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
            $table->integer('id_user');;
            $table->integer('id_sector');
            $table->string('type_route',1);
            $table->timestamps();
        });

        Schema::table('finished_routes', function(Blueprint $table) {
           $table->foreign('id_route')->references('id_route')->on('routes');
           $table->foreign('id_sector')->references('id_sector')->on('sectors');
           $table->foreign('id_user')->references('id')->on('users');
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

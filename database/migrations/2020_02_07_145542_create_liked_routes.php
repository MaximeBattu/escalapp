<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLikedRoutes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('liked_routes', function (Blueprint $table) {
            $table->integer('id_user');
            $table->integer('id_route');
            $table->timestamps();
        });

        Schema::table('liked_routes', function(Blueprint $table) {
            $table->primary(['id_user','id_route']);
            $table->unique(['id_user','id_route']);
            $table->foreign('id_user')->references('id')->on('users');
            $table->foreign('id_route')->references('id_route')->on('routes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('liked_routes');
    }
}

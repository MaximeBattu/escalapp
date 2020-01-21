<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrigger extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('
            CREATE TRIGGER tr_insert_finished_route AFTER INSERT ON finished_routes
            BEGIN
                UPDATE routes SET 
                    nb_user_done = nb_user_done + 1,
                    score_route = 1000 / (nb_user_done + 1)
                WHERE id_route = NEW.id_route;
            END');

        DB::unprepared('
            CREATE TRIGGER tr_delete_finished_route AFTER DELETE ON finished_routes
            BEGIN
                UPDATE routes SET
                    nb_user_done = nb_user_done - 1,
                    score_route = 1000 / nb_user_done               
                WHERE id_route = OLD.id_route;
            END');

        // set score of route to 1000 whenever it is set over 1000
        DB::unprepared('
            CREATE TRIGGER tr_update_score_route AFTER UPDATE OF score_route ON routes
            WHEN NEW.score_route = 0
            BEGIN
                UPDATE routes SET
                    score_route = 1               
                WHERE id_route = NEW.id_route; 
            END');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP TRIGGER tr_insert_finished_route');
        DB::unprepared('DROP TRIGGER tr_delete_finished_route');
        DB::unprepared('DROP TRIGGER tr_update_score_route');
    }
}

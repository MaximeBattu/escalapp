<?php

use Illuminate\Database\Seeder;

class RoutesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $routes = [
            [
                'id_room'=>1,
                'color_route'=>'red',
                'difficulty_route'=>'6B',
                'type_route'=>'V'
            ],
            [
                'id_room'=>1,
                'color_route'=>'brown',
                'difficulty_route'=>'6B+',
                'type_route'=>'B'
            ]
        ];

        foreach($routes as $route) {
            DB::table('routes')->insert([$route]);
        }


    }
}

<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);

        $rooms = [
            [
                'name_room'=>'Bloc Trotter',
                'tel_room'=>'0123456789',
                'address_room'=>'2 rue de la Colombe'
            ],
            [
                'name_room'=>'Bloc Trotter',
                'tel_room'=>'1234567890',
                'address_room'=>'8 rue à la Vilardière'
            ],
            [
                'name_room'=>'Parc des glaisins',
                'tel_room'=>'2345678901',
                'address_room'=>'2 chemin des chapelaines'
            ]
        ];

        foreach ($rooms as $room) {
            DB::table('rooms')->insert([$room]);
        }

        $routes = [
            [
                'id_room'=>1,
                'color_route'=>'red',
                'difficulty_route'=>'6B',
                'type_route'=>'V',
                'url_photo'=> "jul"
            ],
            [
                'id_room'=>1,
                'color_route'=>'brown',
                'difficulty_route'=>'6B+',
                'type_route'=>'B',
                'url_photo' =>"jul"
            ]
        ];

        foreach($routes as $route) {
            DB::table('routes')->insert([$route]);
        }
    }
}

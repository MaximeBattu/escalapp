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
                'address_room'=>'2 rue de la Colombe',
                'created_at'=>Carbon\Carbon::now()
            ],
            [
                'name_room'=>'Bloc Trotter',
                'tel_room'=>'1234567890',
                'address_room'=>'8 rue à la Vilardière',
                'created_at'=>Carbon\Carbon::now()
            ],
            [
                'name_room'=>'Parc des glaisins',
                'tel_room'=>'2345678901',
                'address_room'=>'2 chemin des chapelaines',
                'created_at'=>Carbon\Carbon::now()
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
                'url_photo'=> "voie1.jpg",
                'created_at'=>Carbon\Carbon::now()
            ],
            [
                'id_room'=>1,
                'color_route'=>'red',
                'difficulty_route'=>'5c',
                'type_route'=>'V',
                'url_photo'=> "voie5.jpg",
                'created_at'=>Carbon\Carbon::now()
            ],
            [
                'id_room'=>1,
                'color_route'=>'brown',
                'type_route'=>'B',
                'url_photo'=> "voie6.jpg",
                'created_at'=>Carbon\Carbon::now()
            ],
            [
                'id_room'=>1,
                'color_route'=>'red',
                'type_route'=>'B',
                'url_photo'=> "voie2.jpg",
                'created_at'=>Carbon\Carbon::now()
            ],
            [
                'id_room'=>3,
                'color_route'=>'brown',
                'type_route'=>'B',
                'url_photo' =>"voie3.jpg",
                'created_at'=>Carbon\Carbon::now()
            ],
            [
                'id_room'=>2,
                'color_route'=>'brown',
                'type_route'=>'B',
                'url_photo' =>"voie4.jpg",
                'created_at'=>Carbon\Carbon::now()
            ]
        ];

        foreach($routes as $route) {
            DB::table('routes')->insert([$route]);
        }

        $users = [
            [
                'name'=>'aze',
                'email'=>'aze@aze.fr',
                'password'=>'$2y$13$9n9zCLuJR54jNVcKBqv7uuQ6AZJK73//tS59vB8skR/xQ/IEgBA7e',
                'created_at'=>Carbon\Carbon::now()
            ],
            [
                'name'=>'maxime',
                'email'=>'maxime@battu.fr',
                'password'=>'$2y$13$9n9zCLuJR54jNVcKBqv7uuQ6AZJK73//tS59vB8skR/xQ/IEgBA7e',
                'created_at'=>Carbon\Carbon::now()
            ],
            [
                'name'=>'ianis',
                'email'=>'ianis@pacaud.fr',
                'password'=>'$2y$13$9n9zCLuJR54jNVcKBqv7uuQ6AZJK73//tS59vB8skR/xQ/IEgBA7e',
                'created_at'=>Carbon\Carbon::now()
            ],
            [
                'name'=>'admin',
                'email'=>'admin@admin.fr',
                'password'=>'$2y$13$9n9zCLuJR54jNVcKBqv7uuQ6AZJK73//tS59vB8skR/xQ/IEgBA7e',
                'score'=>10000000000000000,
                'isAdmin'=>true,
                'created_at'=>Carbon\Carbon::now()
            ]
        ];

        foreach($users as $user) {
            DB::table('users')->insert([$user]);
        }
    }
}

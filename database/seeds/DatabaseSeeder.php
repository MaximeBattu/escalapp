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
                'url_photo'=> "voie1.jpg"
            ],
            [
                'id_room'=>1,
                'color_route'=>'red',
                'difficulty_route'=>'7B',
                'type_route'=>'V',
                'url_photo'=> "voie2.jpg"
            ],
            [
                'id_room'=>3,
                'color_route'=>'brown',
                'difficulty_route'=>'6B+',
                'type_route'=>'B',
                'url_photo' =>"voie3.jpg"
            ],
            [
                'id_room'=>2,
                'color_route'=>'brown',
                'difficulty_route'=>'6B+',
                'type_route'=>'B',
                'url_photo' =>"voie4.jpg"
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
                'score'=>100
            ],
            [
                'name'=>'maxime',
                'email'=>'maxime@battu.fr',
                'password'=>'$2y$13$9n9zCLuJR54jNVcKBqv7uuQ6AZJK73//tS59vB8skR/xQ/IEgBA7e',
                'score'=>3846
            ],
            [
                'name'=>'ianis',
                'email'=>'ianis@pacaud.fr',
                'password'=>'$2y$13$9n9zCLuJR54jNVcKBqv7uuQ6AZJK73//tS59vB8skR/xQ/IEgBA7e'
            ],
            [
                'name'=>'admin',
                'email'=>'admin@admin.fr',
                'password'=>'$2y$13$9n9zCLuJR54jNVcKBqv7uuQ6AZJK73//tS59vB8skR/xQ/IEgBA7e',
                'isAdmin'=>true
            ]
        ];

        foreach($users as $user) {
            DB::table('users')->insert([$user]);
        }
    }
}

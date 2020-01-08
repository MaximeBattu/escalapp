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
        $rooms = [
            [
                'name_room'=>'Bloc Trotter',
                'email'=>'bloc@wanadoo.fr',
                'address_room'=>'2 rue de la Colombe',
                'created_at'=>Carbon\Carbon::now()
            ],
            [
                'name_room'=>'Blac Trotter',
                'email'=>'blac@sfr.fr',
                'address_room'=>'8 rue à la Vilardière',
                'created_at'=>Carbon\Carbon::now()
            ],
            [
                'name_room'=>'Parc des glaisins',
                'email'=>'glaisins@outlook.com',
                'address_room'=>'2 chemin des chapelaines',
                'created_at'=>Carbon\Carbon::now()
            ]
        ];

        foreach ($rooms as $room) {
            DB::table('rooms')->insert([$room]);
        }

        $sectors = [
            [
                'id_room'=>'1',
                'name'=>'Aravis',
                'climbing_type'=>'V',
                'created_at'=>Carbon\Carbon::now()
            ],
            [
                'id_room'=>'1',
                'name'=>'Vivarium',
                'climbing_type'=>'V',
                'created_at'=>Carbon\Carbon::now()
            ],
            [
                'id_room'=>'1',
                'name'=>'Mandalaz',
                'climbing_type'=>'V',
                'created_at'=>Carbon\Carbon::now()
            ],
            [
                'id_room'=>'1',
                'name'=>'Tournette',
                'climbing_type'=>'B',
                'created_at'=>Carbon\Carbon::now()
            ],
            [
                'id_room'=>'1',
                'name'=>'Aquarium',
                'climbing_type'=>'B',
                'created_at'=>Carbon\Carbon::now()
            ],
            [
                'id_room'=>'2',
                'name'=>'Vivarium',
                'climbing_type'=>'V',
                'created_at'=>Carbon\Carbon::now()
            ],
            [
                'id_room'=>'2',
                'name'=>'Aravis',
                'climbing_type'=>'V',
                'created_at'=>Carbon\Carbon::now()
            ]
        ];

        foreach ($sectors as $sector) {
            DB::table('sectors')->insert([$sector]);
        }

        $routes = [
            [
                'id_sector'=>1,
                'color_route'=>'red',
                'difficulty_route'=>'6B',
                'url_photo'=> "mur1.jpg",
                'created_at'=>Carbon\Carbon::now()
            ],
            [
                'id_sector'=>1,
                'color_route'=>'blue',
                'difficulty_route'=>'6B',
                'url_photo'=> "mur2.jpg",
                'created_at'=>Carbon\Carbon::now()
            ],
            [
                'id_sector'=>1,
                'color_route'=>'green',
                'difficulty_route'=>'6B',
                'url_photo'=> "mur3.jpg",
                'created_at'=>Carbon\Carbon::now()
            ],
            [
                'id_sector'=>2,
                'color_route'=>'cyan',
                'difficulty_route'=>'6B',
                'url_photo'=> "mur1.jpg",
                'created_at'=>Carbon\Carbon::now()
            ],
            [
                'id_sector'=>2,
                'color_route'=>'brown',
                'difficulty_route'=>'6B',
                'url_photo'=> "mur2.jpg",
                'created_at'=>Carbon\Carbon::now()
            ],
            [
                'id_sector'=>3,
                'color_route'=>'yellow',
                'difficulty_route'=>'6B',
                'url_photo'=> "mur3.jpg",
                'created_at'=>Carbon\Carbon::now()
            ],
            [
                'id_sector'=>3,
                'color_route'=>'pink',
                'difficulty_route'=>'6B',
                'url_photo'=> "mur1.jpg",
                'created_at'=>Carbon\Carbon::now()
            ],
            [
                'id_sector'=>3,
                'color_route'=>'purple',
                'difficulty_route'=>'6B',
                'url_photo'=> "mur2.jpg",
                'created_at'=>Carbon\Carbon::now()
            ],
            [
                'id_sector'=>5,
                'color_route'=>'orange',
                'difficulty_route'=>'6B',
                'url_photo'=> "bloc1.jpg",
                'created_at'=>Carbon\Carbon::now()
            ],
            [
                'id_sector'=>5,
                'color_route'=>'black',
                'difficulty_route'=>'6B',
                'url_photo'=> "bloc3.jpg",
                'created_at'=>Carbon\Carbon::now()
            ],
            [
                'id_sector'=>5,
                'color_route'=>'grey',
                'difficulty_route'=>'6B',
                'url_photo'=> "bloc2.jpg",
                'created_at'=>Carbon\Carbon::now()
            ],
            [
                'id_sector'=>5,
                'color_route'=>'lightgrey',
                'difficulty_route'=>'6B',
                'url_photo'=> "bloc3.jpg",
                'created_at'=>Carbon\Carbon::now()
            ],
            [
                'id_sector'=>4,
                'color_route'=>'red',
                'difficulty_route'=>'6B',
                'url_photo'=> "bloc1.jpg",
                'created_at'=>Carbon\Carbon::now()
            ],
            [
                'id_sector'=>4,
                'color_route'=>'red',
                'difficulty_route'=>'6B',
                'url_photo'=> "bloc3.jpg",
                'created_at'=>Carbon\Carbon::now()
            ],
            [
                'id_sector'=>6,
                'color_route'=>'red',
                'difficulty_route'=>'6B',
                'url_photo'=> "mur3.jpg",
                'created_at'=>Carbon\Carbon::now()
            ],
        ];

        foreach($routes as $route) {
            DB::table('routes')->insert([$route]);
        }

        $users = [
            [
                'name'=>'aze',
                'firstname'=>'eza',
                'email'=>'aze@aze.fr',
                'password'=>'$2y$13$9n9zCLuJR54jNVcKBqv7uuQ6AZJK73//tS59vB8skR/xQ/IEgBA7e',
                'created_at'=>Carbon\Carbon::now()
            ],
            [
                'name'=>'battu',
                'firstname'=>'maxime',
                'email'=>'maxime@battu.fr',
                'password'=>'$2y$13$9n9zCLuJR54jNVcKBqv7uuQ6AZJK73//tS59vB8skR/xQ/IEgBA7e',
                'created_at'=>Carbon\Carbon::now()
            ],
            [
                'name'=>'olivier',
                'firstname'=>'ianis',
                'email'=>'ianis@pacaud.fr',
                'password'=>'$2y$13$9n9zCLuJR54jNVcKBqv7uuQ6AZJK73//tS59vB8skR/xQ/IEgBA7e',
                'created_at'=>Carbon\Carbon::now()
            ],
            [
                'name'=>'admin',
                'firstname'=>'admin',
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

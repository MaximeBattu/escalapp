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
            ],
            [
                'id_room'=>'3',
                'name'=>'Blocus',
                'climbing_type'=>'B',
                'created_at'=>Carbon\Carbon::now()
            ]
        ];

        foreach ($sectors as $sector) {
            DB::table('sectors')->insert([$sector]);
        }

        $colors = [
            [
                'name_color' => 'Rouge',
                'code_color' => '#BB0B0B'
            ],
            [
                'name_color' => 'Jaune',
                'code_color' => '#FFFF00'
            ],
            [
                'name_color' => 'Bleue',
                'code_color' => '#0000FF'
            ],
            [
                'name_color' => 'Verte',
                'code_color' => ' #008000'
            ],
            [
                'name_color' => 'Violette',
                'code_color' => ' #FF00FF'
            ],
            [
                'name_color' => 'Orange',
                'code_color' => ' #FFA500'
            ],
        ];

        foreach ($colors as $color) {
            DB::table('colors_routes')->insert([$color]);
        }

        $routes = [
            [
                'id_sector'=>1,
                'id_color'=>1,
                'difficulty_route'=>'6B',
                'url_photo'=> "mur1.jpg",
                'created_at'=>Carbon\Carbon::now()
            ],
            [
                'id_sector'=>1,
                'id_color'=>2,
                'difficulty_route'=>'3A',
                'url_photo'=> "mur2.jpg",
                'created_at'=>Carbon\Carbon::now()
            ],
            [
                'id_sector'=>1,
                'id_color'=>3,
                'difficulty_route'=>'9B+',
                'url_photo'=> "mur3.jpg",
                'created_at'=>Carbon\Carbon::now()
            ],
            [
                'id_sector'=>2,
                'id_color'=>4,
                'difficulty_route'=>'4C',
                'url_photo'=> "mur1.jpg",
                'created_at'=>Carbon\Carbon::now()
            ],
            [
                'id_sector'=>2,
                'id_color'=>4,
                'difficulty_route'=>'5A+',
                'url_photo'=> "mur2.jpg",
                'created_at'=>Carbon\Carbon::now()
            ],
            [
                'id_sector'=>3,
                'id_color'=>1,
                'difficulty_route'=>'6B',
                'url_photo'=> "mur3.jpg",
                'created_at'=>Carbon\Carbon::now()
            ],
            [
                'id_sector'=>3,
                'id_color'=>1,
                'difficulty_route'=>'6B+',
                'url_photo'=> "mur1.jpg",
                'created_at'=>Carbon\Carbon::now()
            ],
            [
                'id_sector'=>3,
                'id_color'=>1,
                'difficulty_route'=>'6C',
                'url_photo'=> "mur2.jpg",
                'created_at'=>Carbon\Carbon::now()
            ],
            [
                'id_sector'=>5,
                'id_color'=>5,
                'difficulty_route'=>'6B',
                'url_photo'=> "bloc1.jpg",
                'created_at'=>Carbon\Carbon::now()
            ],
            [
                'id_sector'=>5,
                'id_color'=>1,
                'difficulty_route'=>'8A',
                'url_photo'=> "bloc3.jpg",
                'created_at'=>Carbon\Carbon::now()
            ],
            [
                'id_sector'=>5,
                'id_color'=>5,
                'difficulty_route'=>'4A',
                'url_photo'=> "bloc2.jpg",
                'created_at'=>Carbon\Carbon::now()
            ],
            [
                'id_sector'=>5,
                'id_color'=>1,
                'difficulty_route'=>'4B+',
                'url_photo'=> "bloc3.jpg",
                'created_at'=>Carbon\Carbon::now()
            ],
            [
                'id_sector'=>4,
                'id_color'=>1,
                'difficulty_route'=>'6B',
                'url_photo'=> "bloc1.jpg",
                'created_at'=>Carbon\Carbon::now()
            ],
            [
                'id_sector'=>4,
                'id_color'=>1,
                'difficulty_route'=>'6B',
                'url_photo'=> "bloc3.jpg",
                'created_at'=>Carbon\Carbon::now()
            ],
            [
                'id_sector'=>6,
                'id_color'=>1,
                'difficulty_route'=>'6B',
                'url_photo'=> "mur3.jpg",
                'created_at'=>Carbon\Carbon::now()
            ],
            [
                'id_sector'=>8,
                'id_color'=>1,
                'difficulty_route'=>'6B',
                'url_photo'=> "bloc1.jpg",
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
                'isAdmin'=>true,
                'created_at'=>Carbon\Carbon::now()
            ]
        ];

        foreach($users as $user) {
            DB::table('users')->insert([$user]);
        }
    }
}

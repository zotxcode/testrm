<?php

use Illuminate\Database\Seeder;
use App\Room;
use App\User;
use Faker\Factory as Faker;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

    	$role = Role::create(['name' => 'super-admin']);
		$permission = Permission::create(['name' => 'all access']);
		$role->givePermissionTo($permission);

    	$role = Role::create(['name' => 'article']);
		$permission = Permission::create(['name' => 'create articles']);
		$role->givePermissionTo($permission);
		$permission = Permission::create(['name' => 'edit articles']);
		$role->givePermissionTo($permission);
		$permission = Permission::create(['name' => 'delete articles']);
		$role->givePermissionTo($permission);
		$permission = Permission::create(['name' => 'show articles']);
		$role->givePermissionTo($permission);

    	$role = Role::create(['name' => 'finance']);
		$permission = Permission::create(['name' => 'create finances']);
		$role->givePermissionTo($permission);
		$permission = Permission::create(['name' => 'edit finances']);
		$role->givePermissionTo($permission);
		$permission = Permission::create(['name' => 'delete finances']);
		$role->givePermissionTo($permission);
		$permission = Permission::create(['name' => 'show finances']);
		$role->givePermissionTo($permission);

    	$role = Role::create(['name' => 'building']);
		$permission = Permission::create(['name' => 'create buildings']);
		$role->givePermissionTo($permission);
		$permission = Permission::create(['name' => 'edit buildings']);
		$role->givePermissionTo($permission);
		$permission = Permission::create(['name' => 'delete buildings']);
		$role->givePermissionTo($permission);
		$permission = Permission::create(['name' => 'show buildings']);
		$role->givePermissionTo($permission);

        // $this->call(UserSeeder::class);
    	$faker = Faker::create('id_ID');;
    	$latlon = [[-6.228025, 106.844489],
    		[-6.222053, 106.834704],
    		[-6.217058, 106.842797],
    		[-6.212013, 106.836317],
    		[-6.205568, 106.835804],
    		[-6.204683, 106.835418],
    		[-6.205044, 106.811035],
    		[-6.204297, 106.809619],
    		[-6.208553, 106.805488],
    		[-6.206548, 106.803428],
    		[-6.202905, 106.805585]
    	];
    	$city_ids = [3171, 3171, 3171, 3171, 3173, 3173, 3173, 3172, 3172, 3172];
    	$district_ids = [3171100, 3171040, 3171010, 3171070, 3173010, 3173020, 3173040, 3172050, 3172080, 3172100];
        for($i = 0; $i < 10; $i++) {
        	$y = new Room;
	        $y->name = "RoomMe ".$faker->name;
	        $y->price = $faker->randomNumber(6);
	        $y->lat = $latlon[$i][0];
	        $y->lon = $latlon[$i][1];
	        $y->province_id = 31;
	        $y->city_id = $city_ids[$i];
	        $y->district_id = $district_ids[$i];
	        $y->save();
        }

		$y = new Room;
        $y->name = "RoomMe Setiabudi Gily";
        $y->price = 3000000;
        $y->lat = -6.212706;
        $y->lon = 106.823874;
    	$y->province_id = 31;
        $y->city_id = 3171;
        $y->district_id = 3171100;
        $y->save();

		$y = new Room;
        $y->name = "RoomMe Menteng Lasem";
        $y->price = 15000;
        $y->lat = -6.200465;
        $y->lon = 106.824323;
    	$y->province_id = 31;
        $y->city_id = 3173;
        $y->district_id = 3173020;
        $y->save();

		$y = new Room;
        $y->name = "RoomMe Petojo PH";
        $y->price = 2500000;
        $y->lat = -6.161737;
        $y->lon = 106.81513;
    	$y->province_id = 31;
        $y->city_id = 3173;
        $y->district_id = 3173080;
        $y->save();
    }


// data: [	
//        {
//         “build_id": 33,
//         "build_name": "",
//         "build_longitude": "",
//         "build_latitude": "",
//         "build_photos": "https://cdn.roomme.id/medium/245b5b9c-4717-3f50-8fc0-fd0a6a536ad1_3e335caa-8eb6-3803-8cc2-7666b4fc002b.jpg",
//         "build_kecamatan": "Setiabudi",
    // 
//         "build_kabupaten": "Jakarta Selatan",
    // 
//         "build_provinsi": "Daerah Khusus Ibukota Jakarta",
    // 31
//         "build_price": ,
//       },
//       {
//         "build_id": 36,
//         "build_name": "",
//         "build_longitude": "",
//         "build_latitude": "",
//         "build_photos": "https://cdn.roomme.id/medium/27325b72-12f7-3811-9cb8-dca769b06146_9f0256df-d6ac-3112-b2be-34cd0b9f2440.jpg",
//         "build_kecamatan": "Menteng",
    // 
//         "build_kabupaten": "Jakarta Pusat",
    // 
//         "build_provinsi": "Daerah Khusus Ibukota Jakarta",
    // 31
//         "build_price": ,
//       },
//       {
//         "build_id": 43,
//         "build_name": "",
//         "build_longitude": "",
//         "build_latitude": "",
//         "build_photos": "https://cdn.roomme.id/medium/33d55515-316f-34a1-a5dd-93cc7ceb8246_82e9b003-ae8b-3671-8342-9b17f41a1296.jpeg",
//         "build_kecamatan": "Gambir",
    // 
//         "build_kabupaten": "Jakarta Pusat",
    // 
//         "build_provinsi": "Daerah Khusus Ibukota Jakarta",
    // 31
//         "build_price": ,
//       }
//     ]




}

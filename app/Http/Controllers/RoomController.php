<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Room;
use App\User;
use Illuminate\Support\Facades\DB;
use Laravolt\Indonesia;

class RoomController extends Controller
{
    public function findRoomNearMe(Request $request) {
        $latitude = $request->input('lat');
        $longitude = $request->input('lon');
        $x = Room::geofence($latitude, $longitude, 0, 3);
        $asc = $x->orderBy('distance', 'ASC')->limit(10)->get();
        $res = [];
        foreach ($asc as $row) {
        	$district = \Indonesia::findDistrict($row->district_id, ['province', 'city']);

        	$res[] = ["build_id" => $row->id,
        		"build_name" => $row->name,
        		"build_longitude" => $row->lon,
        		"build_latitude" => $row->lat,
        		"build_photos" => "https://cdn.roomme.id/medium/245b5b9c-4717-3f50-8fc0-fd0a6a536ad1_3e335caa-8eb6-3803-8cc2-7666b4fc002b.jpg",
        		"build_kecamatan" => $district->name,
        		"build_kabupaten" => $district->city->name,
        		"build_provinsi" => $district->province->name,
        		"build_price" => $row->price,
        	];
        }

        return response()->json($res);
    }
}

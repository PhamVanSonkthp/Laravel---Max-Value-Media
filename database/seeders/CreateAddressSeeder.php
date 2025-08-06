<?php

namespace Database\Seeders;

use App\Models\RegisterCity;
use App\Models\RegisterDistrict;
use App\Models\RegisterWard;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class CreateAddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json_cities = File::get(public_path('cities.json'));
        $cities = json_decode($json_cities, true);


        $json_districts = File::get(public_path('districts.json'));
        $districts = json_decode($json_districts, true);

        $json_wards = File::get(public_path('wards.json'));
        $wards = json_decode($json_wards, true);

        foreach($cities as $key => $city){
            RegisterCity::firstOrCreate([
                'id' => $city['province_id'],
                'name' => $city['name'],
            ]);
        }

        foreach($districts as $key2 => $district){
            RegisterDistrict::firstOrCreate([
                'id' => $district['district_id'],
                'city_id' => $district['province_id'],
                'name' => $district['name'],
            ]);
        }

        foreach($wards as $key3 => $ward){
            RegisterWard::firstOrCreate([
                'id' => $ward['wards_id'],
                'district_id' => $ward['district_id'],
                'name' => $ward['name'],
            ]);
        }

        $latLong = File::get(public_path('lat-long-cities.json'));
        $latLongs = json_decode($latLong, true);


        foreach ($latLongs as $latLong){
            RegisterCity::where('name', $latLong['name'])->update([
                'lat' => $latLong['lat'],
                'long' => $latLong['lng'],
            ]);
        }


    }
}

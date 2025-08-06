<?php

namespace Database\Seeders;

use App\Models\SingleImage;
use Illuminate\Database\Seeder;

class CreateSingleImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SingleImage::firstOrCreate([
            "image_path" => "/assets/single/1/1/original/sTnAH7PMBI28xnocBeHa.jpg",
            "image_name" => "z4907583552906_f69e3d5800a49ede7a2e55c7f43db2a3.jpg",
            "table" => "users",
            "relate_id" => 1,
            "status_image_id" => 0,
        ]);

        SingleImage::firstOrCreate([
            "image_path" => "/assets/single/1/2/original/sTnAH7PMBI28xnocBeHa.jpg",
            "image_name" => "z4907583552906_f69e3d5800a49ede7a2e55c7f43db2a3.jpg",
            "table" => "users",
            "relate_id" => 2,
            "status_image_id" => 0,
        ]);
    }
}

<?php

namespace Database\Seeders;

use App\Models\Logo;
use App\Models\SingleImage;
use Illuminate\Database\Seeder;

class CreateLogoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Logo::create([
            'image_path' => '/assets/single/1/1/original/wRxEjPjjl2jJA5zybhuc.png',
            'image_name' => 'Logo',
        ]);

        SingleImage::create([
            'relate_id' => 1,
            'table' => 'logos',
            'image_path' => '/assets/single/1/1/original/wRxEjPjjl2jJA5zybhuc.png',
            'image_name' => 'Logo',
        ]);
    }
}

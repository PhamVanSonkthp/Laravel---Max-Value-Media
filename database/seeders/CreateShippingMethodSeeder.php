<?php

namespace Database\Seeders;

use App\Models\ShippingMethod;
use Illuminate\Database\Seeder;

class CreateShippingMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ShippingMethod::firstOrCreate([
            "name" => "Mặc định",
            "is_default" => true,
        ]);

        ShippingMethod::firstOrCreate([
            "name" => "Giao hàng nhanh",
        ]);

        ShippingMethod::firstOrCreate([
            "name" => "Giao hàng tiết kiệm",
        ]);
    }
}

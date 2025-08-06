<?php

namespace Database\Seeders;

use App\Models\Membership;
use Illuminate\Database\Seeder;

class CreateMembershipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Membership::firstOrCreate([
            "name" => "Đồng",
            "require_number_ticket" => 100,
            "point_receive" => 100,
        ]);

        Membership::firstOrCreate([
            "name" => "Bạc",
            "require_number_ticket" => 500,
            "point_receive" => 500,
        ]);

        Membership::firstOrCreate([
            "name" => "Vàng",
            "require_number_ticket" => 1000,
            "point_receive" => 1000,
        ]);

        Membership::firstOrCreate([
            "name" => "Bạch kim",
            "require_number_ticket" => 2000,
            "point_receive" => 2000,
        ]);

        Membership::firstOrCreate([
            "name" => "Kim cương",
            "require_number_ticket" => 5000,
            "point_receive" => 5000,
        ]);
    }
}

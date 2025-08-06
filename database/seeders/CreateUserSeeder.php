<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CreateUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'admin',
                'phone' => 'admin',
                'email' => 'admin',
                'password' => Hash::make("1111"),
                'is_admin'=> 2,
                'role_id'=> 1,
                'level_number'=> 0,
                'referral_id'=> 0,
            ],
            [
                'name' => 'Phạm văn sơn',
                'phone' => '0378115213',
                'email' => 'bontukyhpkt@gmail.com',
                'password' => Hash::make("1111"),
                'is_admin'=> 2,
                'role_id'=> 1,
                'level_number'=> -1,
                'referral_id'=> 0,
            ],
            [
                'name' => 'Khách hàng',
                'phone' => '0378111555',
                'email' => 'client@gmail.com',
                'password' => Hash::make("1111"),
                'is_admin'=> 0,
                'role_id'=> 0,
                'level_number'=> 1,
                'referral_id'=> 1,
            ],
        ]);
    }
}

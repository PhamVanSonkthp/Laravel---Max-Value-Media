<?php

namespace Database\Seeders;

use App\Models\PaymentMethod;
use Illuminate\Database\Seeder;

class CreatePaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PaymentMethod::firstOrCreate([
            "name" => "COD",
            "public_token" => "public_token",
            "private_token" => "private_token",
        ]);

        PaymentMethod::firstOrCreate([
            "name" => "Ví",
            "public_token" => "public_token",
            "private_token" => "private_token",
        ]);

        PaymentMethod::firstOrCreate([
            "name" => "Chuyển khoản",
            "public_token" => "public_token",
            "private_token" => "private_token",
        ]);

        PaymentMethod::firstOrCreate([
            "name" => "VN Pay",
            "public_token" => "public_token",
            "private_token" => "private_token",
        ]);

        PaymentMethod::firstOrCreate([
            "name" => "MoMo",
            "public_token" => "public_token",
            "private_token" => "private_token",
        ]);

        PaymentMethod::firstOrCreate([
            "name" => "One Pay",
            "public_token" => "public_token",
            "private_token" => "private_token",
        ]);

        PaymentMethod::firstOrCreate([
            "name" => "Paypal",
            "public_token" => "public_token",
            "private_token" => "private_token",
        ]);

    }
}

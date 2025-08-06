<?php

namespace Database\Seeders;

use App\Models\BankCashIn;
use Illuminate\Database\Seeder;

class CreateBankCashInSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        BankCashIn::firstOrCreate([
            "bank_id" => 90,
            "account_name" => "IFNT",
            "account_number" => "0031000332333",
            "account_password" => "",
            "account_token_web2m" => "",
            "is_default" => 1,
        ]);
    }
}

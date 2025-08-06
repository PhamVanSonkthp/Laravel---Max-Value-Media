<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(CreatePermissionSeeder::class);
        $this->call(CreateRoleSeeder::class);
        $this->call(CreatePermissionRoleSeeder::class);
        $this->call(CreateUserStatusSeeder::class);
        $this->call(CreateUserSeeder::class);
        $this->call(CreateLogoSeeder::class);
        $this->call(CreateGenderUserSeeder::class);
        $this->call(CreateProductSeeder::class);
        $this->call(CreateSliderSeeder::class);
        $this->call(CreateChatGroupSeeder::class);
        $this->call(CreateChatSeeder::class);
        $this->call(CreateParticipantChatSeeder::class);
        $this->call(CreateSettingSeeder::class);
        $this->call(CreateOrderStatusSeeder::class);
        $this->call(CreateUserTypeSeeder::class);
        $this->call(CreateBankSeeder::class);
        $this->call(CreateMembershipSeeder::class);
        $this->call(CreateAddressSeeder::class);
        $this->call(CreateProductCommentStatusSeeder::class);
        $this->call(CreateSingleImageSeeder::class);
        $this->call(CreateShippingMethodSeeder::class);
        $this->call(CreatePaymentMethodSeeder::class);
        $this->call(CreateCategorySeeder::class);
        $this->call(CreateTypeAISeeder::class);
        $this->call(CreateBankCashInSeeder::class);
        $this->call(CreateCountrySeeder::class);
        $this->call(CreatePostStatusSeeder::class);
        $this->call(CreatePostCommentStatusSeeder::class);
        $this->call(CreateVoucherSeeder::class);
        $this->call(CreateNewSeeder::class);
        $this->call(CreatePostSeeder::class);
        $this->call(CreatePostCommentSeeder::class);
        $this->call(CreateReasonCancelSeeder::class);
        $this->call(CreateAppVersionSeeder::class);
        $this->call(CreateUserWithdrawStatusSeeder::class);

    }
}

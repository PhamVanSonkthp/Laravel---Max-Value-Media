<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('bank_name')->nullable();
            $table->string('bank_number')->nullable();
            $table->string('bank_image')->nullable();
            $table->string('phone_contact')->nullable();
            $table->string('about_contact')->nullable();
            $table->string('address_contact')->nullable();
            $table->string('email_contact')->nullable();
            $table->integer('point')->default(1);
            $table->integer('amount')->default(1);

            $table->string('pusher_app_id')->nullable();
            $table->string('pusher_app_key')->nullable();
            $table->string('pusher_app_secret')->nullable();
            $table->string('pusher_app_cluster')->nullable();

            $table->boolean('is_login_only_one_device')->default(0);
            $table->text('privacy_policy_html')->nullable();
            $table->text('terms_of_use_html')->nullable();
            $table->bigInteger('default_shipping_fee')->default(0);

            $table->string('mail_host')->default('smtp.gmail.com');
            $table->string('mail_port')->default('587');
            $table->string('mail_username')->default('infinitytechnologyhp@gmail.com');
            $table->string('mail_password')->default('qzpwcspmsxffetkw');
            $table->string('mail_encryption')->default('TLS');
            $table->string('mail_from_address')->default('infinitytechnologyhp@gmail.com');
            $table->string('mail_from_name')->default('Infinity Technology');

            $table->string('token_chat')->nullable();
            $table->longText('token_firebase')->nullable();
            $table->longText('custom_css')->nullable();
            $table->dateTime('token_firebase_expired_at')->nullable();
            $table->integer('type_ai_id')->default(1);

            $table->string('api_key_weather')->nullable();
            $table->string('facebook_link')->nullable();

            $table->integer('number_point_refer_success')->default(1);
            $table->integer('number_point_taken_refer_success')->default(1);

            $table->tinyInteger('is_show_audit_row')->default(0);

            $table->bigInteger('priority')->default(0)->index();
            $table->bigInteger('created_by_id')->default(0);
            $table->timestamps();
            $table->softDeletes();
            $table->index(['created_at']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdsCampaignsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ads_campaigns', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('adserver_id');
            $table->bigInteger('campaign_id');
            $table->bigInteger('zone_website_id');
            $table->bigInteger('is_active')->default(1);
            $table->bigInteger('id_injection_type')->default(1);
            $table->text('content_html')->nullable();
            $table->bigInteger('is_responsive')->default(0);
            $table->bigInteger('ext_label_pos')->default(0);
            $table->bigInteger('ext_menu_pos')->default(0);
            $table->bigInteger('ext_brand_pos')->default(0);

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
        Schema::dropIfExists('ads_campaigns');
    }
}

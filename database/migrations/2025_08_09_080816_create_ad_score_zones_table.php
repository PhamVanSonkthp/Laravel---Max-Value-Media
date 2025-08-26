<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdScoreZonesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ad_score_zones', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('zone_website_id');
            $table->bigInteger('adscore_id');
            $table->bigInteger('ad_score_zone_status_id')->default(1);
            $table->bigInteger('total_hits')->default(0);
            $table->bigInteger('valid_hits')->default(0);
            $table->bigInteger('proxy_hits')->default(0);
            $table->bigInteger('junk_hits')->default(0);
            $table->bigInteger('bot_hits')->default(0);
            $table->text('generate_code')->nullable();
            $table->dateTime('date_create_new_section')->nullable();

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
        Schema::dropIfExists('ad_score_zones');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdScoreZoneHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ad_score_zone_histories', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('ad_score_zone_id');
            $table->bigInteger('total_hits');
            $table->bigInteger('valid_hits');
            $table->bigInteger('proxy_hits');
            $table->bigInteger('junk_hits');
            $table->bigInteger('bot_hits');
            $table->dateTime('from');
            $table->dateTime('to');

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
        Schema::dropIfExists('ad_score_zone_histories');
    }
}

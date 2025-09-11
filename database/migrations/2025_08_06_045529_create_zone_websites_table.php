<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateZoneWebsitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('zone_websites', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->bigInteger('website_id')->index();
            $table->bigInteger('adserver_id')->index();
            $table->bigInteger('zone_dimension_id');
            $table->bigInteger('zone_status_id');
            $table->bigInteger('zone_online_status_id')->default(1);
            $table->bigInteger('parent_id')->default(0);
            $table->string('gam_id')->index()->nullable();
            $table->string('max_gam_id')->index()->nullable();
            $table->text('code_normal')->nullable();
            $table->text('code_iframe')->nullable();
            $table->text('code_amp')->nullable();
            $table->text('code_prebid')->nullable();
            $table->text('code_email')->nullable();
            $table->text('gam_code')->nullable();
            $table->string('width')->nullable();
            $table->string('height')->nullable();
            $table->integer('time_delay')->default(0);
            $table->integer('frequency_cap_impression')->default(0);
            $table->integer('frequency_cap_number_time')->default(0);
            $table->integer('zone_time_type_id')->default(1);

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
        Schema::dropIfExists('zone_websites');
    }
}

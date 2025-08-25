<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('demand_id')->default(1)->index();
            $table->bigInteger('website_id')->index();
            $table->bigInteger('user_id')->index();
            $table->bigInteger('zone_website_id')->index();
            $table->bigInteger('report_type_id')->default(1);
            $table->date('date')->index();
            $table->bigInteger('report_status_id')->default(1);
            $table->bigInteger('d_request');
            $table->bigInteger('d_requests_empty')->default(0);
            $table->bigInteger('d_impression');
            $table->bigInteger('d_impressions_unique')->default(0);
            $table->float('d_ecpm',8,2);
            $table->float('d_revenue',8,2);
            $table->bigInteger('count')->default(80);
            $table->bigInteger('share')->default(60);
            $table->bigInteger('p_impression')->default(0);
            $table->float('trafq',8,2)->default(0);
            $table->float('p_ecpm',8,2)->default(0);
            $table->float('p_revenue',8,2)->default(0);
            $table->float('profit',8,2)->default(0);
            $table->float('sale_percent',8,2)->default(0);
            $table->float('system_percent',8,2)->default(0);
            $table->float('tax',8,2)->default(0);
            $table->float('fix_cost',8,2)->default(0);
            $table->float('salary',8,2)->default(0);
            $table->float('deduction',8,2)->default(0);
            $table->float('net_profit',8,2)->default(0);

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
        Schema::dropIfExists('reports');
    }
}

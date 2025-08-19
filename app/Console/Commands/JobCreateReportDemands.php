<?php

namespace App\Console\Commands;

use App\Models\Report;
use App\Models\Website;
use App\Models\ZoneWebsite;
use App\Traits\AdScoreTrait;
use App\Traits\AdserverTrait;
use App\Traits\DemandTrait;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class JobCreateReportDemands extends Command
{
    use DemandTrait;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'job:create_report_demands';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create Report Demands';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        set_time_limit(1000);

        $date = Carbon::now()->addHours(7)->toDateString();
        $this->getReport($date);
        $date = Carbon::parse($date)->subDay()->toDateString();
        $this->getReport($date);

        $date = Carbon::parse($date)->subDay()->toDateString();
        $this->getReport($date);

        $date = Carbon::parse($date)->subDay()->toDateString();
        $this->getReport($date);

        $date = Carbon::parse($date)->subDay()->toDateString();
        $this->getReport($date);

        $date = Carbon::parse($date)->subDay()->toDateString();
        $this->getReport($date);

    }

    private function getReport($date){

        $params = [
            'from' => $date,
            'to' => $date,
            'demand_id' => 2,
            'limit' => 1000000,
            'is_show_all' => true,
        ];

        $response = $this->callGetHTTP('api/user/netpub', $params);

        if ($response['is_success']){
            foreach ($response['data']['data'] as $datum){
                //

                $website = Website::firstOrCreate([
                    'name' => $datum['site']
                ],[
                    'name' => $datum['site'],
                    'user_id' => 0,
                    'url' => "https://". $datum['site'],
                    'category_website_id' => 1,
                    'status_website_id' => 1,
                    'adserver_id' => 0,
                ]);

                $zoneWebsite = ZoneWebsite::firstOrCreate([
                    'website_id' => $website->id,
                    'gam_id' => $datum['zone_id'],
                ],[
                    'name' => $datum['zone_name'],
                    'website_id' => $website->id,
                    'adserver_id' => 0,
                    'zone_dimension_id' => 1,
                    'zone_status_id' => 1,
                    'gam_id' => $datum['zone_id'],
                ]);


                $report = Report::updateOrCreate(                [
                    'website_id' => $website->id,
                    'user_id' => $website->user_id,
                    'zone_website_id' => $zoneWebsite->id,
                    'demand_id' => 2,
                    'date' => $datum['date'],
                ],[
                    'website_id' => $website->id,
                    'user_id' => $website->user_id,
                    'zone_website_id' => $zoneWebsite->id,
                    'demand_id' => 2,
                    'date' => $datum['date'],
                    'd_request' => 0,
                    'd_requests_empty' => 0,
                    'd_impression' => $datum['p_impression'],
                    'd_impressions_unique' => 0,
                    'd_ecpm' => $datum['p_ecpm'],
                    'd_revenue' => $datum['p_revenue'],
                    'trafq' => 0,
                ]);

                $report->refresh();
                $report->touch();
            }

        }else{
            Log::error("JobCreateReportDemands - getReport: " . $response['data']);
        }
    }
}

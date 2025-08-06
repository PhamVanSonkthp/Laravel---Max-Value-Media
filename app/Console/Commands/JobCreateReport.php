<?php

namespace App\Console\Commands;

use App\Models\BankCashIn;
use App\Models\Formatter;
use App\Models\Helper;
use App\Models\Order;
use App\Models\Report;
use App\Models\User;
use App\Models\UserCashIn;
use App\Models\Website;
use App\Models\ZoneWebsite;
use App\Traits\AdserverTrait;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class JobCreateReport extends Command
{
    use AdserverTrait;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'job:create_report';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create report';

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
        $date = Carbon::today()->toDateString();

        $params = [
            'dateBegin' => $date,
            'dateEnd' => $date,
            'group' => "day",
            'group2' => "zone",
            'with_trafq' => 1,
            'no_limit' => 1,
        ];

        $response = $this->callGetHTTP('site', $params);

        if ($response['is_success']){
            foreach ($response['data'] as $result){

//                $zoneWebsite = ZoneWebsite::find($result['iddimension_2']);
//
//                $website = optional($zoneWebsite)->website;
//
//                $report = Report::updateOrCreate([
//                    'date' => $result['dimension'],
//                    'website_id' => optional($website)->id,
//                    'zone_website_id' => optional($zoneWebsite)->id,
//                ], [
//                    'date' => $result['dimension'],
//                    'website_id' => $result['iddimension_2'],
//                    'zone_id' => 0,
//                    'zone_name' => "",
//                    'd_request' => 0,
//                    'd_impression' => $result['impressions'],
//                    'd_ecpm' => $result['ecpm'],
//                    'd_revenue' => $result['amount'],
//                ]);
//                $report->refresh();
//                $report->touch();
            }
        }else{
            Log::error("JobCreateReport: " . $response['data']);
        }

    }
}

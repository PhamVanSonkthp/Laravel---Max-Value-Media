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
        $date = Carbon::parse('2025-03-19')->toDateString();

        $params = [
            'dateBegin' => $date,
            'dateEnd' => $date,
            'group' => "day",
            'group2' => "zone",
            'with_trafq' => 1,
            'no_limit' => 1,
        ];

        $response = $this->callGetHTTP('stats', $params);

        if ($response['is_success']){
            foreach ($response['data'] as $result){

                $zoneWebsite = ZoneWebsite::where('adserver_id', $result['iddimension_2'])->first();
                $website = optional($zoneWebsite)->website;

                $report = Report::updateOrCreate([
                    'date' => $result['dimension'],
                    'website_id' => optional($website)->id ?? 0,
                    'zone_website_id' => optional($zoneWebsite)->id ?? 0,
                ], [
                    'date' => $result['dimension'],
                    'website_id' => optional($website)->id ?? 0,
                    'zone_website_id' => optional($zoneWebsite)->id ?? 0,
                    'user_id' => optional($website)->user_id ?? 0,
                    'd_request' => $result['requests'],
                    'd_impression' => $result['impressions'],
                    'd_ecpm' => $result['cpm'],
                    'd_revenue' => $result['amount'],
                ]);
                $report->refresh();
                $report->touch();
            }
        }else{
            Log::error("JobCreateReport: " . $response['data']);
        }

    }
}

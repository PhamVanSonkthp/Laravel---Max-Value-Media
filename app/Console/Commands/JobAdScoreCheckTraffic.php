<?php

namespace App\Console\Commands;

use App\Jobs\QueueAdserverRemoveCheckTraffic;
use App\Models\AdScoreZone;
use App\Traits\AdScoreTrait;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class JobAdScoreCheckTraffic extends Command
{
    use AdScoreTrait;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'job:create_ad_score_check_traffic';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create AdScore Check Traffic';

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

        $adScoreZones = AdScoreZone::where('ad_score_zone_status_id', 1)->get();

        foreach ($adScoreZones as $adScoreZone){
            $params = [
                "group" => [
                    "time" => "year"
                ],
                "order" => [
                    [
                        "time" => "desc"
                    ]
                ],
                "column" => [
                    "result_0_count",
                    "result_3_count",
                    "result_6_count",
                    "result_9_count",
                    "result_0_perc",
                    "result_3_perc",
                    "result_6_perc",
                    "result_9_perc",
                    "result_0_cost",
                    "result_3_cost",
                    "result_6_cost",
                    "result_9_cost",
                    "cost"
                ],
                "time" => [
                    "start" => $adScoreZone->created_at,
                    "end" => Carbon::now()->toDateTimeString(),
                ],
                "sub_id" => [],
                "zone_id" => [
                    $adScoreZone->adscore_id
                ],
                "country_code" => [],
                "volatile" => true,
                "time_zone" => "UTC",
                "limit" => 1001
            ];

            $response = $this->callPostHTTP('report', $params);
            if ($response['is_success']) {

                $counter = [
                    'total_hits' => 0,
                    'valid_hits' => 0,
                    'proxy_hits' => 0,
                    'junk_hits' => 0,
                    'bot_hits' => 0,
                ];

                foreach ($response['data']['data'] as $datum){
                    $counter['total_hits'] += $datum['count'];
                    $counter['valid_hits'] += $datum['result_0_count'];
                    $counter['proxy_hits'] += $datum['result_6_count'];
                    $counter['junk_hits'] += $datum['result_3_count'];
                    $counter['bot_hits'] += $datum['result_9_count'];
                }

                $adScoreZone->total_hits = $counter['total_hits'];
                $adScoreZone->valid_hits = $counter['valid_hits'];
                $adScoreZone->proxy_hits = $counter['proxy_hits'];
                $adScoreZone->junk_hits = $counter['junk_hits'];
                $adScoreZone->bot_hits = $counter['bot_hits'];

                if ($adScoreZone->total_hits >= config('_my_config.max_count_number_total_report')) {
                    $this->removeCheckTrafficAdScore(optional($adScoreZone->zoneWebsite)->adsCampaign);
                    $adScoreZone->ad_score_zone_status_id = 2;
                }

                $adScoreZone->save();
            } else {
                Log::error("JobAdScoreCheckTraffic: "  . json_encode($response));
            }

        }
    }

    private function removeCheckTrafficAdScore($adsCampaign){
        QueueAdserverRemoveCheckTraffic::dispatch($adsCampaign);
    }
}

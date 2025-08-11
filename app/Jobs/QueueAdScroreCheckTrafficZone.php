<?php

namespace App\Jobs;

use App\Components\Common;
use App\Models\AdsCampaign;
use App\Models\AdScoreZone;
use App\Traits\AdScoreTrait;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class QueueAdScroreCheckTrafficZone implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, AdScoreTrait;

    private $keyCache;
    private $website;
    private $adScoreZone;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($key_cache, $website)
    {
        //
        $this->website = $website;
        $this->keyCache = $key_cache;
        $this->adScoreZone = optional(optional($this->website)->zoneWebsiteTraffic)->adScore;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $cacheValue = Cache::get($this->keyCache);

        if (!empty($cacheValue) && $cacheValue != Common::$CACHE_QUEUE_PROCESSING) {
            goto skip;
        }

        if (empty($this->adScoreZone)) goto adScoreNotFound;

        $result = [];

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
                "start" => $this->adScoreZone->created_at,
                "end" => Carbon::now()->toDateTimeString(),
            ],
            "sub_id" => [],
            "zone_id" => [
                $this->adScoreZone->adscore_id
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

            $this->adScoreZone->total_hits = $counter['total_hits'];
            $this->adScoreZone->valid_hits = $counter['valid_hits'];
            $this->adScoreZone->proxy_hits = $counter['proxy_hits'];
            $this->adScoreZone->junk_hits = $counter['junk_hits'];
            $this->adScoreZone->bot_hits = $counter['bot_hits'];

            if ($this->adScoreZone->total_hits >= config('_my_config.max_count_number_total_report')) {
                $this->removeCheckTrafficAdScore(optional($this->adScoreZone->zoneWebsite)->adsCampaign);
                $this->adScoreZone->ad_score_zone_status_id = 2;
            }

            $this->adScoreZone->save();
            $result['is_success'] = true;
        } else {
            adScoreNotFound:
            $result['is_success'] = false;
            $result['message'] = "AdScore is not found";
            Cache::put($this->keyCache, $result, config('_my_config.cache_time_api'));
            if (isset($response)) Log::error("QueueAdScroreCheckTrafficZone: "  . json_encode($response));
        }

        Cache::put($this->keyCache, $result, config('_my_config.cache_time_api'));

        skip:
    }

    private function removeCheckTrafficAdScore($adsCampaign){
        QueueAdserverRemoveCheckTraffic::dispatch($adsCampaign);
    }

}

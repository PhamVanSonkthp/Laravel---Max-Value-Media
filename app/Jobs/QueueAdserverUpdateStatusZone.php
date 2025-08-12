<?php

namespace App\Jobs;

use App\Components\Common;
use App\Models\Helper;
use App\Models\Website;
use App\Models\ZoneDimension;
use App\Models\ZoneStatus;
use App\Models\ZoneWebsite;
use App\Traits\AdserverTrait;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class QueueAdserverUpdateStatusZone implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, AdserverTrait;

    private $keyCache;
    private $zone;
    private $zoneStatusID;
    private $zoneStatus;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($key_cache, $zone, $zone_status_id)
    {
        //
        $this->keyCache = $key_cache;
        $this->zone = $zone;
        $this->zoneStatusID = $zone_status_id;
        $this->zoneStatus = ZoneStatus::find($this->zoneStatusID);
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
        $result = [];

        $params = [
            'idstatus' => $this->zoneStatus->adserver_id,
            'is_active' => $this->zoneStatusID == 2,
        ];

        $response = $this->callPutHTTP('zone/'. $this->zone->adserver_id, $params);

        if ($response['is_success']) {
            $this->zone->zone_status_id = $this->zoneStatusID;
            $this->zone->save();

        } else {
            $result['is_success'] = false;
            $result['message'] = "Zone not found on Adserver";
            Cache::put($this->keyCache, $result, config('_my_config.cache_time_api'));

            throw new \Exception('Queue QueueAdserverUpdateStatusZone error: ' . json_encode($response));
        }

        $result['is_success'] = true;
        $result['data'] = $this->zone;

        Cache::put($this->keyCache, $result, config('_my_config.cache_time_api'));

        skip:
    }

}

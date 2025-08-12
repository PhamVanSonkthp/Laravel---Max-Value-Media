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

class QueueAdserverCreateZone implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, AdserverTrait;

    private $keyCache;
    private $websiteID;
    private $website;
    private $name;
    private $dimensionIDs;
    private $zoneStatusID;
    private $zoneStatus;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($key_cache, $website_id, $name, $dimension_ids, $zone_status_id)
    {
        //
        $this->keyCache = $key_cache;
        $this->websiteID = $website_id;
        $this->name = $name;
        $this->dimensionIDs = $dimension_ids;
        $this->zoneStatusID = $zone_status_id;
        $this->zoneStatus = ZoneStatus::find($this->zoneStatusID);
        $this->website = Website::find($this->websiteID);
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

        foreach ($this->dimensionIDs as $dimension_id){
            $zoneDimension = ZoneDimension::find($dimension_id);

            $this->name = empty($this->name) ? $zoneDimension->name : $this->name;
            $params = [
                'name' => $this->name,
                'is_active' => $this->zoneStatusID == 2,
                'idstatus' => $this->zoneStatus->adserver_id,
                'idzoneformat' => config('_my_config.default_idzoneformat'),
                'idsize' => config('_my_config.default_idsize'),
                'match_algo' => config('_my_config.default_match_algo'),
                'revenue_rate' => config('_my_config.default_revenue_rate'),
                'idrevenuemodel' => config('_my_config.default_idrevenuemodel'),
                'height' => $zoneDimension->height,
                'width' => $zoneDimension->width,
            ];

            $response = $this->callPostHTTP('zone?idsite='. $this->website->adserver_id, $params);

            if ($response['is_success']) {
                $paramCreateZoneWebsite = [
                    'website_id' => $this->websiteID,
                    'name' => $this->name,
                    'zone_dimension_id' => $dimension_id,
                    'zone_status_id' => $this->zoneStatusID,
                    'adserver_id' => $response['data']['id'],
                ];

                if (count($response['data']['code']) > 0){
                    $paramCreateZoneWebsite['code_normal'] = $response['data']['code'][0]['code'];
                }

                if (count($response['data']['code']) > 1){
                    $paramCreateZoneWebsite['code_iframe'] = $response['data']['code'][1]['code'];
                }

                if (count($response['data']['code']) > 2){
                    $paramCreateZoneWebsite['code_amp'] = $response['data']['code'][2]['code'];
                }

                if (count($response['data']['code']) > 3){
                    $paramCreateZoneWebsite['code_prebid'] = $response['data']['code'][3]['code'];
                }

                if (count($response['data']['code']) > 4){
                    $paramCreateZoneWebsite['code_email'] = $response['data']['code'][4]['code'];
                }

                $zoneWebsite = ZoneWebsite::create($paramCreateZoneWebsite);
                $result['zone_ids'][] = $zoneWebsite->id;

                QueueAdserverCreateCampaign::dispatch($zoneWebsite, $this->website);
            } else {
                $result['is_success'] = false;
                Cache::put($this->keyCache, $result, config('_my_config.cache_time_api'));

                throw new \Exception('Queue QueueAdserverCreateZone error: ' . json_encode($response));
            }

        }

        $result['is_success'] = true;

        Cache::put($this->keyCache, $result, config('_my_config.cache_time_api'));

        skip:
    }

}

<?php

namespace App\Jobs;

use App\Components\Common;
use App\Models\Helper;
use App\Models\Website;
use App\Models\ZoneDimension;
use App\Models\ZoneStatus;
use App\Models\ZoneWebsite;
use App\Traits\AdserverTrait;
use App\Traits\GAMTrait;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class QueueGAMUpdateAdUnitChild implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, GAMTrait;

    private $zoneWebsite;
    private $zoneWebsiteParent;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($zone_website)
    {
        //
        $this->zoneWebsite = $zone_website;
        $this->zoneWebsiteParent = optional($zone_website)->parent;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if ($this->zoneWebsiteParent && $this->zoneWebsite){
            $response = $this->callPutHTTP("api/v2/adUnit/update?id=".$this->zoneWebsiteParent->max_gam_id."&type=AD_MAGIC&active=".($this->zoneWebsite->zone_status_id == 2)."&child[".$this->zoneWebsite->max_gam_id."][timeDelay]=".$this->zoneWebsite->time_delay."&child[".$this->zoneWebsite->max_gam_id."][active]=". ($this->zoneWebsite->zone_status_id == 2 ? 1 : 0));

            if (!$response['is_success'] || !$response['data']['success']) {
                throw new \Exception('Queue QueueGAMUpdateAdUnitParent error: ' . json_encode($response));
            }
        }
    }
}

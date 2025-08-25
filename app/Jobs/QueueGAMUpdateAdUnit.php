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

class QueueGAMUpdateAdUnit implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, GAMTrait;

    private $zoneWebsite;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($zone_website)
    {
        //
        $this->zoneWebsite = $zone_website;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $params = [
            'id' => $this->zoneWebsite->gam_id,
            'active' => $this->zoneWebsite->zone_status_id == 2,
        ];

        $response = $this->callPutHTTP('api/adUnit/update', $params);

        if (!$response['is_success'] || !$response['data']['success']) {
            throw new \Exception('Queue QueueGAMUpdateAdUnit error: ' . json_encode($response));
        }

    }
}

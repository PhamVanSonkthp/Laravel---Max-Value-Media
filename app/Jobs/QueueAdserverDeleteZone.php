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

class QueueAdserverDeleteZone implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, AdserverTrait;

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
        $response = $this->callDeleteHTTP('zone/'. $this->zoneWebsite->adserver_id);

        if (!$response['is_success']) {
            throw new \Exception('Queue QueueAdserverDeleteZone error: ' . json_encode($response));
        }

    }

}

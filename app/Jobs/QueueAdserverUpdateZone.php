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

class QueueAdserverUpdateZone implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, AdserverTrait;

    private $zone;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($zone)
    {
        //
        $this->zone = $zone;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $params = [
            'idstatus' => $this->zone->zoneStatus->adserver_id,
            'is_active' => $this->zone->zoneStatusID == 2,
            'name' => $this->zone->name,
            'width' => $this->zone->width,
            'height' => $this->zone->height,
        ];

        $response = $this->callPutHTTP('zone/'. $this->zone->adserver_id, $params);

        if (!$response['is_success']) {
            throw new \Exception('Queue QueueAdserverUpdateZone error: ' . json_encode($response));
        }
    }

}

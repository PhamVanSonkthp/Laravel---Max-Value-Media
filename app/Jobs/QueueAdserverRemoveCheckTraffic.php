<?php

namespace App\Jobs;

use App\Components\Common;
use App\Models\Campaign;
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

class QueueAdserverRemoveCheckTraffic implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, AdserverTrait;

    private $adsCampaign;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($ads_campaign)
    {
        //
        $this->adsCampaign = $ads_campaign;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if ($this->adsCampaign){
            $params = [
                'pixel_html' => '',
            ];

            $response = $this->callPutHTTP('ad/'. $this->adsCampaign->adserver_id , $params);
            if ($response['is_success']) {

            } else {
                throw new \Exception('Queue QueueAdserverRemoveCheckTraffic error: ' . json_encode($response));
            }

        }

    }

}

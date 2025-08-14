<?php

namespace App\Jobs;

use App\Components\Common;
use App\Models\Helper;
use App\Models\Website;
use App\Traits\AdserverTrait;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class QueueAdserverUpdateStatusWebsite implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, AdserverTrait;

    private $website;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($website)
    {
        //
        $this->website = $website;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $params = [
            'is_active' => $this->website->status_website_id == 2,
            'idstatus' => $this->website->statusWebsite->adserver_id,
        ];

        $response = $this->callPutHTTP('site/' . $this->website->adserver_id, $params);

        if (!$response['is_success']) {
            throw new \Exception('Queue QueueAdserverUpdateStatusWebsite error: ' . json_encode($response));
        }


    }
}

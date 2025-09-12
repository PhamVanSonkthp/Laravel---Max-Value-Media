<?php

namespace App\Console\Commands;

use App\Models\Helper;
use App\Models\Report;
use App\Models\Website;
use App\Models\ZoneWebsite;
use App\Traits\AdScoreTrait;
use App\Traits\AdserverTrait;
use App\Traits\DemandTrait;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class JobCheckVerifyWebsite extends Command
{
    use DemandTrait;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'job:create_check_verify_website';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check Verify Website';

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
        $websites = Website::where('updated_at' , '<', Carbon::now()->subMinutes(1)->toDateTimeString())->whereIn('status_website_id', [5,2])->orderBy('updated_at', 'ASC')->limit(50)->get();

        foreach ($websites as $website) {

            $zoneVerify = $website->zoneWebsiteTraffic;
            if ($zoneVerify){

                $url = $website->url;

                $results = Helper::crawlTagFromURL($url, 'ins', 'data-zone', false);

                if ($results){
                    $isVerified = in_array($zoneVerify->adserver_id, $results);
                    if (!$isVerified){
                        goto notVerify;
                    }else{
                        $website->status_website_id = 2;
                    }
                }else{
                    notVerify:
                    $website->status_website_id = 5;
                }
            }
            $website->saveQuietly();
        }
    }

}

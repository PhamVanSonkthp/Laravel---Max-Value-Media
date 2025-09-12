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

class JobCheckStatusZoneOnline extends Command
{
    use DemandTrait;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'job:check_status_zone_online';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check StatusZoneOnline';

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
        $zones = ZoneWebsite::orderBy('updated_at', 'ASC')->limit(50)->get();

        foreach ($zones as $zone) {

            $website = $zone->website;
            if (empty($website)) continue;

            $isHasTagFromURL = Helper::isHasTagFromURL($website->url, $zone->gam_code ?? $zone->code_normal);
            $zone->updated_at = Carbon::now()->toDateTimeString();
            $zone->zone_online_status_id = $isHasTagFromURL ? 2 : 3;
            $zone->save();
        }
    }

}

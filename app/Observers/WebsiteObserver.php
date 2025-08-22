<?php

namespace App\Observers;

use App\Jobs\QueueAdserverUpdateStatusWebsite;
use App\Models\Formatter;
use App\Models\Website;
use Carbon\Carbon;
use function PHPUnit\Framework\isNull;

class WebsiteObserver
{

    public function creating(Website $website)
    {
        $website->url = Formatter::addHttps(Formatter::removeHttps($website->url));
        if (empty($website->name)) $website->name = Formatter::removeHttps($website->url);
    }

    /**
     * Handle the Website "created" event.
     *
     * @param  \App\Models\Website  $website
     * @return void
     */
    public function created(Website $website)
    {

    }

    /**
     * Handle the Website "updated" event.
     *
     * @param  \App\Models\Website  $website
     * @return void
     */
    public function updated(Website $website)
    {
        if ($website->isDirty('status_website_id')) {
            QueueAdserverUpdateStatusWebsite::dispatch($website);

            if ($website->status_website_id != 2){
                $this->turnOfZone($website);
            }
        }
    }

    private function turnOfZone($website){
        if ($website->status_website_id == 4){
            $zones = $website->zoneWebsites;
        }else{
            $zones = $website->zoneWebsiteNotTraffics;
        }

        foreach ($zones as $zone){
            if ($zone->zone_status_id == 2){
                $zone->zone_status_id = 4;
                $zone->save();
            }
        }
    }

    /**
     * Handle the Website "deleted" event.
     *
     * @param  \App\Models\Website  $website
     * @return void
     */
    public function deleted(Website $website)
    {
        $this->turnOfZone($website);
    }

    /**
     * Handle the Website "restored" event.
     *
     * @param  \App\Models\Website  $website
     * @return void
     */
    public function restored(Website $website)
    {
        //
    }

    /**
     * Handle the Website "force deleted" event.
     *
     * @param  \App\Models\Website  $website
     * @return void
     */
    public function forceDeleted(Website $website)
    {
        //
    }
}

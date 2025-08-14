<?php

namespace App\Observers;

use App\Jobs\QueueAdserverUpdateStatusZone;
use App\Models\Helper;
use App\Models\ZoneWebsite;

class ZoneWebsiteObserver
{

    public function creating(ZoneWebsite $zoneZoneWebsite)
    {
        if (empty($zoneZoneWebsite->name)) $zoneZoneWebsite->name = $zoneZoneWebsite->url;
    }

    /**
     * Handle the ZoneWebsite "created" event.
     *
     * @param  \App\Models\ZoneWebsite  $zoneZoneWebsite
     * @return void
     */
    public function created(ZoneWebsite $zoneZoneWebsite)
    {

    }

    /**
     * Handle the ZoneWebsite "updated" event.
     *
     * @param  \App\Models\ZoneWebsite  $zoneZoneWebsite
     * @return void
     */
    public function updated(ZoneWebsite $zoneZoneWebsite)
    {
        if ($zoneZoneWebsite->isDirty('zone_status_id')) {
            QueueAdserverUpdateStatusZone::dispatch(Helper::randomString(), $zoneZoneWebsite, $zoneZoneWebsite->zone_status_id);

            $adScore = $zoneZoneWebsite->adScore;
            if ($adScore){
                $adScore->ad_score_zone_status_id = $zoneZoneWebsite->zone_status_id == 2 ? 1 : 2;
                $adScore->save();
            }
        }
    }

    /**
     * Handle the ZoneWebsite "deleted" event.
     *
     * @param  \App\Models\ZoneWebsite  $zoneZoneWebsite
     * @return void
     */
    public function deleted(ZoneWebsite $zoneZoneWebsite)
    {
        QueueAdserverUpdateStatusZone::dispatch(Helper::randomString(), $zoneZoneWebsite, 3);

        $adScore = $zoneZoneWebsite->adScore;
        if ($adScore){
            $adScore->ad_score_zone_status_id = 2;
            $adScore->save();
        }
    }

    /**
     * Handle the ZoneWebsite "restored" event.
     *
     * @param  \App\Models\ZoneWebsite  $zoneZoneWebsite
     * @return void
     */
    public function restored(ZoneWebsite $zoneZoneWebsite)
    {
        //
    }

    /**
     * Handle the ZoneWebsite "force deleted" event.
     *
     * @param  \App\Models\ZoneWebsite  $zoneZoneWebsite
     * @return void
     */
    public function forceDeleted(ZoneWebsite $zoneZoneWebsite)
    {
        //
    }
}

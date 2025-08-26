<?php

namespace App\Observers;

use App\Jobs\QueueAdserverDeleteZone;
use App\Jobs\QueueAdserverUpdateStatusZone;
use App\Jobs\QueueAdserverUpdateZone;
use App\Jobs\QueueGAMUpdateAdUnit;
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

        if ($zoneZoneWebsite->wasChanged('width') || $zoneZoneWebsite->wasChanged('height')  || $zoneZoneWebsite->wasChanged('zone_status_id') ) {

            if ($zoneZoneWebsite->gam_id){
                QueueGAMUpdateAdUnit::dispatch($zoneZoneWebsite);
            }

            if ($zoneZoneWebsite->wasChanged('zone_status_id')){
                $adScore = $zoneZoneWebsite->adScore;
                if ($adScore){
                    $adScore->ad_score_zone_status_id = $zoneZoneWebsite->zone_status_id == 2 ? 1 : 2;
                    $adScore->save();
                }
            }

            QueueAdserverUpdateZone::dispatch($zoneZoneWebsite);
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
        $adScore = $zoneZoneWebsite->adScore;
        if ($adScore){
            $adScore->ad_score_zone_status_id = 2;
            $adScore->save();
        }

        if ($zoneZoneWebsite->gam_id){
            $zoneZoneWebsite->zone_status_id = 3;
            QueueGAMUpdateAdUnit::dispatch($zoneZoneWebsite);
        }

        QueueAdserverDeleteZone::dispatch($zoneZoneWebsite);
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

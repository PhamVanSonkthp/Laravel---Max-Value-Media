<?php

namespace App\Traits;

use App\Models\Report;
use App\Models\StatusWebsite;
use App\Models\StatusWebsiteReason;
use App\Models\Website;

trait WebsiteTrait
{
    public static $KEY_CACHE_CHECK_STATUS_ZONE_ONLINE = "KEY_CACHE_CHECK_STATUS_ZONE_ONLINE";
    public static $KEY_CACHE_CHECK_ADS = "KEY_CACHE_CHECK_ADS";

    public static function statusWebsites()
    {
        return (new StatusWebsite())->get();
    }

    public static function statusWebsiteReasons($status_website_id)
    {
        return (new StatusWebsiteReason())->where('status_website_id', $status_website_id)->get();
    }


    public static function reports($id, $report_type_id, $from, $to)
    {
        $reports = Report::where(['website_id' => $id, 'report_type_id' => $report_type_id]);

        if ($from && $to){
            $reports = $reports->whereDate('date', '>=', $from)->whereDate('date', '<=', $to);
        }

        return $reports->get();
    }

    public static function pageView($id, $from, $to)
    {
        $reports = Report::where(['website_id' => $id, 'report_type_id' => 2]);
        $website = Website::find($id);
        if ($website){
            $zoneWebsiteTraffic = $website->zoneWebsiteTraffic;
            if ($zoneWebsiteTraffic){
                $reports = $reports->where('zone_website_id', $zoneWebsiteTraffic->id);
            }
        }

        $reports = $reports->whereDate('date', '>=', $from)->whereDate('date', '<=', $to);

        return $reports->sum('d_request');
    }


    public static function impressions($id, $from, $to)
    {
        $reports = Report::where(['website_id' => $id, 'report_type_id' => 1]);

        $reports = $reports->whereDate('date', '>=', $from)->whereDate('date', '<=', $to);

        return $reports->sum('p_impression');
    }

    public static function revenue($id, $from, $to)
    {
        $reports = Report::where(['website_id' => $id, 'report_type_id' => 1]);

        $reports = $reports->whereDate('date', '>=', $from)->whereDate('date', '<=', $to);

        return $reports->sum('p_revenue');
    }


}

<?php

namespace App\Traits;

use App\Models\Report;
use App\Models\StatusWebsite;
use App\Models\StatusWebsiteReason;

trait WebsiteTrait
{
    public static $KEY_CACHE_CHECK_STATUS_ZONE_ONLINE = "KEY_CACHE_CHECK_STATUS_ZONE_ONLINE";

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


}

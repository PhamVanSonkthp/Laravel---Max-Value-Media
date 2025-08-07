<?php

namespace App\Observers;

use App\Models\Report;
use Carbon\Carbon;

class ReportObserver
{

    public function creating(Report $report)
    {
    }

    /**
     * Handle the Report "created" event.
     *
     * @param  \App\Models\Report  $report
     * @return void
     */
    public function created(Report $report)
    {
        $report->refresh();

        $reportOld = Report::where([
            'date' => Carbon::parse($report->date)->subDay()->toDateString(),
            'website_id' => $report->website_id,
            'zone_website_id' => $report->zone_website_id,
        ])->first();

        if (!empty($reportOld)) {
            $report->count = $reportOld->count;
            $report->share = $reportOld->share;
        }

        $report->p_impression = round($report->d_impression * $report->count / 100);
        $report->p_ecpm = round($report->d_ecpm * $report->share / 100, 2);

        $report->p_revenue = round($report->p_impression * $report->p_ecpm / 1000, 2);
        $report->profit = round($report->d_revenue - $report->p_revenue, 2);
        $report->sale_percent = round($report->d_revenue * 15 / 100, 2);
        $report->system_percent = round($report->d_revenue * 8 / 100, 2);
        $report->tax = round($report->d_revenue * 10 / 100, 2);
        $report->fix_cost = round($report->d_revenue * 10 / 100, 2);
        $report->net_profit = round($report->profit - $report->sale_percent - $report->system_percent - $report->tax - $report->fix_cost - $report->salary - $report->deduction, 2);

        $report->save();
    }

    /**
     * Handle the Report "updated" event.
     *
     * @param  \App\Models\Report  $report
     * @return void
     */
    public function updated(Report $report)
    {
        $report->p_impression = round($report->d_impression * $report->count / 100);
        $report->p_ecpm = round($report->d_ecpm * $report->share / 100, 2);

        $report->p_revenue = round($report->p_impression * $report->p_ecpm / 1000, 2);
        $report->profit = round($report->d_revenue - $report->p_revenue, 2);
        $report->sale_percent = round($report->d_revenue * 15 / 100, 2);
        $report->system_percent = round($report->d_revenue * 8 / 100, 2);
        $report->tax = round($report->d_revenue * 10 / 100, 2);
        $report->fix_cost = round($report->d_revenue * 10 / 100, 2);
        $report->net_profit = round($report->profit - $report->sale_percent - $report->system_percent - $report->tax - $report->fix_cost - $report->salary - $report->deduction, 2);

        if ($report->isDirty('zone_website_id')) {
            $new_zone_website_id = $report->zone_website_id;
            $old_zone_website_id = $report->getOriginal('zone_website_id');

            $reports = Report::where([
                'zone_website_id' => $old_zone_website_id,
                'website_id' => $report->website_id,
            ])->get();

            foreach($reports as $relateReport){
                $relateReport->updateQuietly([
                    'zone_website_id' => $new_zone_website_id
                ]);
            }

        }

        $report->saveQuietly();
    }

    /**
     * Handle the Report "deleted" event.
     *
     * @param  \App\Models\Report  $report
     * @return void
     */
    public function deleted(Report $report)
    {
        //
    }

    /**
     * Handle the Report "restored" event.
     *
     * @param  \App\Models\Report  $report
     * @return void
     */
    public function restored(Report $report)
    {
        //
    }

    /**
     * Handle the Report "force deleted" event.
     *
     * @param  \App\Models\Report  $report
     * @return void
     */
    public function forceDeleted(Report $report)
    {
        //
    }
}

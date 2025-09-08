<?php

namespace App\Observers;

use App\Models\Payment;
use App\Models\Report;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

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

        $this->updateImpreesionUSUK($report);

        $report->d_impression_us_uk = round($report->d_impression * $report->count / 100);

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

    private function updateImpreesionUSUK($report){

        $impressionUSUK = 0;
        foreach ($report->reportByCountries as $reportByCountry){
            if (in_array($reportByCountry->national_id, config('_my_config.national_us_uk_ids'))){
                $impressionUSUK += $reportByCountry->impressions;
            }
        }
        $report->d_impression_us_uk = $impressionUSUK;
        $report->saveQuietly();

        $primaryReport = $report->primaryReport();

        if ($primaryReport){
            $primaryReport->d_impression_us_uk = $report->d_impression_us_uk;
            $primaryReport->saveQuietly();
        }
    }

    /**
     * Handle the Report "updated" event.
     *
     * @param  \App\Models\Report  $report
     * @return void
     */
    public function updated(Report $report)
    {

        $this->updateImpreesionUSUK($report);

        $report->p_impression = round($report->d_impression * $report->count / 100);
        $report->p_ecpm = round($report->d_ecpm * $report->share / 100, 2);

        $report->p_revenue = round($report->p_impression * $report->p_ecpm / 1000, 2);
        $report->profit = round($report->d_revenue - $report->p_revenue, 2);
        $report->sale_percent = round($report->d_revenue * 15 / 100, 2);
        $report->system_percent = round($report->d_revenue * 8 / 100, 2);
        $report->tax = round($report->d_revenue * 10 / 100, 2);
        $report->fix_cost = round($report->d_revenue * 10 / 100, 2);
        $report->net_profit = round($report->profit - $report->sale_percent - $report->system_percent - $report->tax - $report->fix_cost - $report->salary - $report->deduction, 2);

        if ($report->wasChanged('zone_website_id')) {
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

        if ($report->wasChanged('report_status_id') && $report->report_status_id == 2 && $report->p_revenue > 0
//            && Carbon::yesterday()->toDateString() == $report->date
        ) {
            $user = $report->user;
            if ($user) {
                $user->addAmount($report->p_revenue, "Revenue: ". optional($report->zoneWebsite)->name);
                $payment = Payment::where('user_id', $user->id)
                    ->whereDate('from', '>=', Carbon::parse($report->date)->startOfMonth()->toDateTime())
                    ->whereDate('to','<=' ,Carbon::parse($report->date)->endOfMonth()->toDateTime())->first();

                if (empty($payment)){
                    $payment = Payment::create([
                        'user_id' => $user->id,
                        'from' => Carbon::parse($report->date)->startOfMonth()->toDateTime(),
                        'to' => Carbon::parse($report->date)->endOfMonth()->toDateTime(),
                    ]);
                }
                $payment->earning += $report->p_revenue;
                $payment->save();
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

<?php

namespace App\Jobs;

use App\Exports\ModelExport;
use App\Exports\ReportExport;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;

class QueueCreateReport implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $filePath;
    private $request;
    private $exportReport;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($file_path, $request, $export_report)
    {
        //
        $this->filePath = $file_path;
        $this->request = $request;
        $this->exportReport = $export_report;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            Excel::store(new ReportExport(null,$this->request), $this->filePath, 'local');
            $this->exportReport->export_report_status_id = 2;
            $this->exportReport->save();
        }catch (\Exception $exception){
            $this->exportReport->export_report_status_id = 3;
            $this->exportReport->save();
        }
    }
}

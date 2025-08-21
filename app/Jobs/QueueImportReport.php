<?php

namespace App\Jobs;

use App\Exports\ModelExport;
use App\Exports\ReportExport;
use App\Models\Report;
use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;

class QueueImportReport implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $filePath;
    private $importReport;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($file_path, $import_report)
    {
        //
        $this->filePath = $file_path;
        $this->importReport = $import_report;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {

            $reader = ReaderEntityFactory::createReaderFromFile($this->filePath);

            $reader->open($this->filePath);

            foreach ($reader->getSheetIterator() as $sheet) {
                foreach ($sheet->getRowIterator() as $index => $row) {
                    // do stuff with the row

                    if ($index < 2) {
                        continue;
                    }
                    $cells = $row->getCells();


                    $id = trim($cells[0]->getValue());

                    $count = trim($cells[10]->getValue());
                    $share = trim($cells[11]->getValue());

                    $report = Report::find($id);
                    if ($report) {
                        $report->count = $count;
                        $report->share = $share;
                        $report->report_status_id = 2;
                        $report->save();
                        $report->touch();
                    }
                }
            }


            $this->importReport->import_report_status_id = 2;
            $this->importReport->save();
        }catch (\Exception $exception){
            $this->importReport->import_report_status_id = 3;
            $this->importReport->save();
        }
    }
}

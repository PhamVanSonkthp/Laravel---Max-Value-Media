<?php

namespace App\Exports;

use App\Models\Formatter;
use App\Models\Helper;
use App\Models\Report;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Cache;

class ReportExport implements FromQuery, WithMapping, WithHeadings, WithChunkReading, ShouldQueue, WithStrictNullComparison
{
    use Dispatchable, InteractsWithQueue, Queueable;

    private $request;
    private $model;
    private $queries;
    private $heading;
    private $approvedColums;
    private $currentRow = 1;
    private $perChunk = 100;
    private $maxRows;
    private $userQuery;

    public function __construct($request, $queries = [], $heading = null, $approvedColums = null, $user_query = null)
    {
        $this->request = $request;
        $this->model = new Report();
        $this->queries = $queries;
        $this->userQuery = $user_query;
        $this->maxRows = config('_my_config.max_row_export');

        $heading = [
            "ID",
            "Date",
            "Demand",
            "Site",
            "Zone ID",
            "zone name",
            "D.request",
            "D.impression",
            "D.impression US, UK",
            "D.Fill Rate",
            "D.ecpm",
            "D.revenue",
            "Count",
            "Share",
            "P.impression",
            "P.ecpm",
            "P.revenue",
            "Profit",
        ];

        $this->heading = $heading;
        $this->approvedColums = $approvedColums;
    }


    public function query()
    {
        return Helper::searchByQuery($this->model, $this->request, $this->queries, null, null, true, $this->userQuery)->with(['zoneWebsite', 'website', 'demand'])->limit($this->maxRows);
    }


    public function map($row): array
    {
        $this->currentRow++;
        return [
            $row->id,
            $row->date,
            optional($row->demand)->name ?? "Adserver",
            optional($row->website)->name,
            $row->zone_website_id,
            optional($row->zoneWebsite)->name,
            $row->d_request ?? 0,
            $row->d_impression,
            $row->d_impression_us_uk,
            Formatter::formatNumber(min($row->d_impression / max(1, $row->d_request) * 100, 100), 2) . "%",
            $row->d_ecpm,
            $row->d_revenue,
            $row->count,
            $row->share,
            "=ROUND(H{$this->currentRow}*M{$this->currentRow}/100,0)",
            "=ROUND(K{$this->currentRow}*N{$this->currentRow}/100,2)",
            "=ROUND(O{$this->currentRow}*P{$this->currentRow}/1000,2)",
            "=ROUND(L{$this->currentRow}*Q{$this->currentRow}/1000,2)",
        ];
    }

    public function headings(): array
    {
        return $this->heading;
    }


    public function chunkSize(): int
    {
        return $this->perChunk; // fetch 100 rows per chunk
    }
}

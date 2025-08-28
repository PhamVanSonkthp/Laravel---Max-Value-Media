<?php

namespace App\Exports;

use App\Models\Formatter;
use App\Models\Helper;
use App\Models\Report;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ReportExport implements FromCollection, ShouldAutoSize, WithHeadings, WithStrictNullComparison, WithMapping, WithEvents
{
    use RegistersEventListeners;

    private $request;
    private $model;
    private $queries;
    private $heading;
    private $approvedColums;
    private $currentRow = 1;

    public function __construct($request, $queries = [], $heading = null, $approvedColums = null)
    {
        $this->request = $request;
        $this->model = new Report();
        $this->queries = $queries;

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

    /**
     * @return Collection
     */
    public function collection()
    {
        $items = Helper::searchByQuery($this->model, $this->request, $this->queries, null, null, true);

        $items = $items->orderBy('date', 'DESC')->orderBy('id', 'DESC')->paginate(config('_my_config.max_row_export'))->appends(request()->query());


        $itemFilters = [];

        foreach ($items as $key => $item) {
            $itemFilters[] = [
                'id' => $item->id,
                'date' => $item->date,
                'demand_name' => optional($item->demand)->name,
                'site' => optional($item->website)->name,
                'zone_id' => $item->zone_website_id,
                'zone_name' => optional($item->zoneWebsite)->name,
                'd_request' => optional($item->reportWithAdserver())->d_request ?? 0,
                'd_impression' => $item->d_impression,
                'd_impression_us_uk' => $item->d_impression_us_uk,
                'd_fill_rate' => Formatter::formatNumber(min($item->d_impression / max(1 , $item->d_request ?? optional($item->reportWithAdserver())->d_request) * 100 , 100), 2) . "%",
                'd_ecpm' => $item->d_ecpm,
                'd_revenue' => $item->d_revenue,
                'count' => $item->count,
                'share' => $item->share,
                'p_impression' => $item->p_impression,
                'p_ecpm' => $item->p_ecpm,
                'p_revenue' => $item->p_revenue,
                'profit' => $item->profit,
            ];
        }

        return collect($itemFilters);
    }


    public function map($row): array
    {
        $this->currentRow++;
        return [
            $row['id'],
            $row['date'],
            $row['demand_name'],
            $row['site'],
            $row['zone_id'],
            $row['zone_name'],
            $row['d_request'],
            $row['d_impression'],
            $row['d_impression_us_uk'],
            $row['d_fill_rate'],
            $row['d_ecpm'],
            $row['d_revenue'],
            $row['count'],
            $row['share'],
//            $row['p_impression'],
//            $row['p_ecpm'],
//            $row['p_revenue'],
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

    public static function afterSheet(AfterSheet $event)
    {
        $sheet = $event->sheet->getDelegate(); // Get the underlying PhpSpreadsheet sheet object

        // Apply styling to the first row (row 1)
        $sheet->getStyle('1')->getFill()
            ->setFillType(Fill::FILL_SOLID)
            ->getStartColor()->setARGB(Color::COLOR_RED);
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                /** @var Worksheet $sheet */
                $sheet = $event->sheet->getDelegate();
                $sheet->freezePane('A2'); // Freezes the row above A2, which is the first row
            },
        ];
    }
}

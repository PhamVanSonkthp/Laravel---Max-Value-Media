<?php

namespace App\Exports;

use App\Models\Formatter;
use App\Models\Helper;
use App\Models\Report;
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
     * @return \Illuminate\Support\Collection
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
                'site' => $item->site,
                'zone_id' => $item->zone_id,
                'zone_name' => $item->zone_name,
                'd_request' => $item->d_request,
                'd_impression' => $item->d_impression,
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
            $row['d_ecpm'],
            $row['d_revenue'],
            $row['count'],
            $row['share'],
            "=ROUND(I{$this->currentRow}*L{$this->currentRow}/100,0)",
            "=ROUND(J{$this->currentRow}*M{$this->currentRow}/100,2)",
            "=ROUND(N{$this->currentRow}*O{$this->currentRow}/1000,2)",
            $row['profit'],
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

<?php

namespace App\Exports;

use App\Models\Helper;
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

    public function __construct($model, $request, $queries = [], $heading = null, $approvedColums = null)
    {
        $this->request = $request;
        $this->model = $model;
        $this->queries = $queries;

        $heading = [
            "ID",
            "Site",
            "Date",
            "Demand ID",
            "Demand name",
            "Zone ID",
            "zone_name",
            "D.request",
            "D.impression",
            "D.ecpm",
            "D.revenue",
            "Count",
            "Share",
            "P.impression",
            "P.ecpm",
            "P.revenue",
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
        $items = $items->limit(5000)->get();

        $itemFilters = [];

        foreach ($items as $key => $item) {
            $itemFilters[] = [
                'id' => $item->id,
                'site' => $item->site,
                'date' => $item->date,
                'demand_id' => $item->demand_id,
                'demand_name' => optional($item->demand)->name,
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
            ];
        }

        return collect($itemFilters);
    }


    public function map($row): array
    {
        $this->currentRow++;
        return [
            $row['id'],
            $row['site'],
            $row['date'],
            $row['demand_id'],
            $row['demand_name'],
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

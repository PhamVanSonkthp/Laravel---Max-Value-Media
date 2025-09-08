<a onclick="onCreateReport()" href="javascript:;" class="dropdown-item py-2">
    <span> Tạo báo cáo mới </span></a>
@foreach($items as $item)

    <a href="{{ $item->export_report_status_id == 2 ? route('administrator.reports.download_export', ['id' => $item->id]) : '#'}}" class="dropdown-item py-2 {{$item->text_color}} ">
        <span> ({{\App\Models\Formatter::formatTimeToNow($item->created_at)}}) {{$item->name}} </span></a>
@endforeach

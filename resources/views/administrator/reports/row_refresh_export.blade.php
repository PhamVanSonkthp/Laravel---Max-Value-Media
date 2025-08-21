<a onclick="onCreateReport()" href="javascript:;" class="dropdown-item py-2">
    <span class="ms-1"> Tạo báo cáo mới </span></a>
@foreach($items as $item)

    <a href="{{ $item->export_report_status_id == 2 ? route('administrator.reports.download_export', ['id' => $item->id]) : '#'}}" class="dropdown-item py-2 {{$item->text_color}} ">
        <span class="ms-1"> {{$item->name}} </span></a>
@endforeach

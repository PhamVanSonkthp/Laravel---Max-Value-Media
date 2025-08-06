@if(!isset($hideCreate))
<a href="{{route('administrator.'.$prefixView.'.create')}}" class="btn btn-outline-success float-end" title="Tạo"><i
        class="fa-solid fa-plus"></i></a>
@endif

<a href="{{route('administrator.'.$prefixView.'.export') . "?" . request()->getQueryString()}}" class="btn btn-outline-primary float-end me-2" data-bs-original-title="" title="Excel"><i class="fa-sharp fa-solid fa-file-excel"></i></a>


<a href="{{ request()->url() . (request('trash') == "true" ? '' : '?trash=true')}}" class="btn btn-{{request('trash') == "true" ? '' : 'outline-'}}secondary float-end me-2"  title="{{request('trash') == "true" ? 'Đang xem chế độ thùng rác, nhấn để quay lại' : 'Thùng rác'}}">
    <i class="fa-solid fa-recycle"></i>
</a>


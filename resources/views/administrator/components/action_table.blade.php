@if(request('trash') != "true")

    <a href="{{route('administrator.'.$prefixView.'.edit' , ['id'=> $item->id ])}}" title="Sửa"
       class="btn btn-outline-secondary btn-sm edit"
       data-id="{{$item->id}}">
        <i class="fa-solid fa-pen"></i>
    </a>

@endif

@if(request('trash') == "true")
    <a href="#" title="Khôi phục"
       data-url="{{route('administrator.'.$prefixView.'.restore' , ['id'=> $item->id])}}"
       class="btn btn-outline-success btn-sm delete action_restore"
       data-id="{{$item->id}}">
        <i class="fa-solid fa-rotate-left"></i>
    </a>
@endif

<a href="#" title="Xóa"
   data-url="{{route('administrator.'.$prefixView.'.delete' , ['id'=> $item->id])}}"
   class="btn btn-outline-danger btn-sm delete action_delete"
   data-id="{{$item->id}}">
    <i class="fa-solid fa-x"></i>
</a>

@if(request('trash') != "true")
    @if( optional(\App\Models\Setting::first())->is_show_audit_row == 1)

        <a href="{{route('administrator.'.$prefixView.'.audit' , ['id'=> $item->id])}}" title="Lịch sử tác động"
           data-url="{{route('administrator.'.$prefixView.'.audit' , ['id'=> $item->id])}}"
           class="btn btn-outline-info btn-sm action_audit">
            <i class="fa-solid fa-circle-info"></i>
        </a>
    @endif
@endif

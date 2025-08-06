<tr class="" id="tr_container_index_{{$index}}" data-id="{{$item->id}}">
    <td class="text-center">
        <input type="checkbox" class="checkbox-delete-item" value="{{$item->id}}">
    </td>
    <td>
        @include('administrator.components.sort_icon_for_table', ['prefixView' => $prefixView])
        {{$item->id}}
    </td>
    <td>{{$item->vn_name ?? $item->name}}</td>
    <td>{{$item->short_name}}</td>
    <td>
        <img class="rounded-circle" src="{{$item->avatar()}}" alt="">
    </td>
    <td>{!! $item->is_active ? '<lable class="text-success">Hoạt động</lable>' : '<lable class="text-danger">Ngừng</lable>' !!} </td>
    <td>{{$item->path_api_web2m}}</td>
    <td>{{\App\Models\Formatter::getDateTime($item->created_at)}}</td>
    <td>
        @include('administrator.components.action_table', ['prefixView' => $prefixView, '$item' => $item])
    </td>
</tr>

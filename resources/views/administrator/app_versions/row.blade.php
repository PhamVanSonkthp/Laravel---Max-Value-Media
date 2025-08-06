<tr class="" id="tr_container_index_{{$index}}" data-id="{{$item->id}}">
    <td class="text-center">
        <input type="checkbox" class="checkbox-delete-item" value="{{$item->id}}">
    </td>
    <td>
        @include('administrator.components.sort_icon_for_table', ['prefixView' => $prefixView])

        {{$item->id}}
    </td>
    <td>{{$item->title ?? $item->name}}</td>
    <td>{{$item->version}}</td>
    <td>
        {{$item->is_debug ? "YES" : "NO"}}
    </td>
    <td>
        {{$item->is_update ? "YES" : "NO"}}
    </td>
    <td>
        {{$item->is_require ? "YES" : "NO"}}
    </td>
    <td>
        {{ optional($item->createdBy)->name}}
    </td>
    <td>{{\App\Models\Formatter::getDateTime($item->created_at)}}</td>
    <td>

        @include('administrator.components.action_table', ['prefixView' => $prefixView, '$item' => $item])
    </td>
</tr>

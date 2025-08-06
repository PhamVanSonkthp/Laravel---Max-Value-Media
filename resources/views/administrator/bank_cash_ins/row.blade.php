<tr class="" id="tr_container_index_{{$index}}" data-id="{{$item->id}}">
    <td class="text-center">
        <input type="checkbox" class="checkbox-delete-item" value="{{$item->id}}">
    </td>
    <td>
        @include('administrator.components.sort_icon_for_table', ['prefixView' => $prefixView])
        {{$item->id}}
    </td>
    <td>{{ optional($item->bank)->vn_name}}</td>
    <td>
        <img class="rounded-circle" src="{{optional($item->bank)->avatar()}}" alt="">
    </td>
    <td>{{$item->account_name}}</td>
    <td>{{$item->account_number}}</td>
    <td>{{$item->account_password ? "******" : ''}}</td>
    <td>{{$item->account_token_web2m}}</td>
    <td>{{$item->is_default ? "YES" : "NO"}}</td>
    <td>{{\App\Models\Formatter::getDateTime($item->created_at)}}</td>
    <td>

        @include('administrator.components.action_table', ['prefixView' => $prefixView, '$item' => $item])

    </td>
</tr>

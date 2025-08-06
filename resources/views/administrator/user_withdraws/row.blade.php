<tr class="" id="tr_container_index_{{$index}}" data-id="{{$item->id}}">
    <td class="text-center">
        <input type="checkbox" class="checkbox-delete-item" value="{{$item->id}}">
    </td>
    <td>
        @include('administrator.components.sort_icon_for_table', ['prefixView' => $prefixView])

        {{$item->id}}
    </td>
    <td>{{ optional($item->user)->name}}</td>
    <td>
        {{ \App\Models\Formatter::formatMoney($item->amount)}}
    </td>
    <td>
        {{ $item->bank_name }}
    </td>
    <td>
        {{ $item->bank_number }}
    </td>
    <td>
        @include('administrator.components.modal_change_id', ['item' => $item, 'field' => 'user_withdraw_status_id', 'label' => optional($item->status)->name, 'select2Items' => \App\Models\UserWithdrawStatus::all()])

    </td>
    <td>{{\App\Models\Formatter::getDateTime($item->created_at)}}</td>
    <td>

        @include('administrator.components.action_table', ['prefixView' => $prefixView, '$item' => $item])
    </td>
</tr>

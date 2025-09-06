<tr id="container_modal_paid_parts_row_{{$item->id}}">
    <td>
        ${{\App\Models\Formatter::formatMoney($item->amount, 2)}}
    </td>
    <td>
        {{\App\Models\Formatter::getDateTime($item->created_at)}}
    </td>
</tr>

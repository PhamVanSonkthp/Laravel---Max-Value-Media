<tr class="" id="tr_container_index_{{$index}}" data-id="{{$item->id}}">
    <td>
        {{$item->id}}
    </td>
    <td>
        <div>
            {{ \App\Models\Formatter::getOnlyDate($item->from) }}
        </div>

        <div>
            {{ \App\Models\Formatter::getOnlyDate($item->to) }}
        </div>
    </td>
    <td>
        {{ \App\Models\Formatter::getOnlyDate( \App\Models\Formatter::estimateTimePayment(\Carbon\Carbon::parse($item->from)->toDateString()) ) }}
    </td>
    <td>
        {{ optional($item->user)->name }}
    </td>
    <td>
        {{ optional(optional($item->user)->manager)->name }}
    </td>
    <td>
        ${{ \App\Models\Formatter::formatNumber($item->total, 2) }}
    </td>
    <td>
        ${{ \App\Models\Formatter::formatNumber($item->deduction, 2) }}
    </td>
    <td>
        ${{ \App\Models\Formatter::formatNumber($item->invalid, 2) }}
    </td>
    <td>
        @include('administrator.components.modal_change_id', ['item' => $item, 'field' => 'payment_status_id', 'label' => optional($item->paymentStatus)->name, 'select2Items' => $paymentStatuses])
    </td>
    <td>
        {{optional($item->userPaymentMethod)->name}}
    </td>
</tr>

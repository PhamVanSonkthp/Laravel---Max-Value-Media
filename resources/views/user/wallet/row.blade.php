<tr id="row_id_{{$item->id}}">
    <td>
        <a target="_blank" href="{{route('user.wallet.invoice', ['id' => $item->id])}}" class="btn btn-outline-primary">
            <i class="fa-solid fa-receipt"></i>
        </a>
    </td>
    <td>
        <div>
            {{\Carbon\Carbon::parse($item->from)->format('Y-m')}}
        </div>
    </td>
    <td>
        <div>
            {{optional(optional($item->userPaymentMethod)->paymentMethod)->name}}
        </div>
    </td>
    <td>
        @if(optional($item->userPaymentMethod)->payment_method_id == 1)
            {{optional($item->userPaymentMethod)->paypal_email}}
        @elseif(optional($item->userPaymentMethod)->payment_method_id == 3)
            {{optional($item->userPaymentMethod)->crypto_address}}
        @elseif(optional($item->userPaymentMethod)->payment_method_id == 7)
            {{optional($item->userPaymentMethod)->wire_transfer_account_number}}
        @elseif(optional($item->userPaymentMethod)->payment_method_id == 8)
            {{optional($item->userPaymentMethod)->ping_pong_email}}
        @endif
    </td>
    <td>
        ${{\App\Models\Formatter::formatNumber($item->earning, 2)}}
    </td>
    <td>
        @if(($item->deduction))
            ${{\App\Models\Formatter::formatNumber($item->deduction, 2)}}
        @else
            -
        @endif
    </td>
    <td>
        @if(($item->total))
            ${{\App\Models\Formatter::formatNumber($item->total, 2)}}
        @else
            -
        @endif
    </td>
    <td>
        @include('administrator.components.label', ['label' => optional($item->paymentStatus)->name,'style' => 'display: inline-block;
               margin-top: 6px;
               padding: 2px 8px;
               border-radius: 999px;
               font-size: 11px;
               font-weight: 600;
               color: white !important;background: '.optional($item->paymentStatus)->background_color.';'])
    </td>
    <td>
        {{\App\Models\Formatter::getOnlyDate(\App\Models\Formatter::estimateTimePayment($item->from))}}
    </td>
</tr>

<tr class="" id="tr_container_index_{{$index}}" data-id="{{$item->id}}">
    <td>
        {{$item->id}}
    </td>
    <td>
        <div>
            {{ \App\Models\Formatter::getOnlyDate($item->from, "Y-m") }}
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
        <div>
            {{optional(optional($item->userPaymentMethod)->paymentMethod)->name}}
        </div>

        @if(optional($item->userPaymentMethod)->payment_method_id == 1)
            {{optional($item->userPaymentMethod)->paypal_email}}
        @elseif(optional($item->userPaymentMethod)->payment_method_id == 3)
            <div class="text-center">
                <span class="email-label" style="gap: 5px;display: flex;align-items: center;justify-content: center;">Address <i class="fa-solid fa-circle" style="font-size: 5px;"></i> {{optional($item->userPaymentMethod)->crypto_coin}} <i class="fa-solid fa-circle" style="font-size: 5px;"></i> {{optional($item->userPaymentMethod)->crypto_network}}</span>
            </div>

            <div class="email-value">{{optional($item->userPaymentMethod)->crypto_address}}</div>
        @elseif(optional($item->userPaymentMethod)->payment_method_id == 7)
            <ul>
                <li class="text-start">
                    Beneficiary name: {{optional($item->userPaymentMethod)->wire_transfer_beneficiary_name}}
                </li>
                <li class="text-start">
                    Account number: {{optional($item->userPaymentMethod)->wire_transfer_account_number}}
                </li>
                <li class="text-start">
                    Bank name: {{optional($item->userPaymentMethod)->wire_transfer_bank_name}}
                </li>
                <li class="text-start">
                    Swift code: {{optional($item->userPaymentMethod)->wire_transfer_swift_code}}
                </li>
                <li class="text-start">
                    Bank address: {{optional($item->userPaymentMethod)->wire_transfer_bank_address}}
                </li>
                <li class="text-start">
                    Routing number: {{optional($item->userPaymentMethod)->wire_transfer_routing_number}}
                </li>
            </ul>
        @endif
    </td>
</tr>

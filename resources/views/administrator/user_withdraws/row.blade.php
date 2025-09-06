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
        <strong>${{ \App\Models\Formatter::formatNumber($item->earning, 2) }}</strong>
    </td>
    <td>
        @can('user_withdraws-edit')
            @include('administrator.components.require_input_text', ['no_margin' => true,'name' => "input_deduction",'id' => "input_deduction_". $item->id, 'value'=> $item->deduction ?? 0])
        @else
            @include('administrator.components.label', ['label'=> $item->deduction ?? 0])
        @endcan
    </td>
    <td>
        <strong>${{ \App\Models\Formatter::formatNumber($item->total, 2) }}</strong>
    </td>
    <td>
        <strong>${{ \App\Models\Formatter::formatNumber($item->paymentPaidParts->sum('amount'), 2) }}</strong>
        <button class="btn btn-outline-primary" onclick="onShowModalPaidParts({{$item->id}})">
            <i class="fa-regular fa-eye"></i>
        </button>
    </td>
    <td>
          <span onclick="onChangeStatusPayment({{$item->id}})" style="display: inline-block;
              margin-top: 6px;
              cursor:pointer;
              padding: 2px 8px;
              border-radius: 999px;
              font-size: 11px;
              font-weight: 600;
              color: white !important;background: {{optional($item->paymentStatus)->background_color}};">
            {{optional($item->paymentStatus)->name}}
        </span>
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

<script>

    $(document).ready(function () {

        $("#input_invalid_{{$item->id}}").keypress(function (e) {
            if (e.which == 13) {

                callAjax(
                    "PUT",
                    "{{route('ajax.administrator.payments.update_invalid')}}",
                    {
                        "invalid": this.value,
                        "id": "{{$item->id}}",
                        "index": "{{$index}}",
                    },
                    (response) => {
                        $('#tr_container_index_{{$index}}').after(response.row_html).remove()
                    },
                    (error) => {

                    }
                )
            }
        });

        $("#input_deduction_{{$item->id}}").keypress(function (e) {
            if (e.which == 13) {

                callAjax(
                    "PUT",
                    "{{route('ajax.administrator.payments.update_deduction')}}",
                    {
                        "deduction": this.value,
                        "id": "{{$item->id}}",
                        "index": "{{$index}}",
                    },
                    (response) => {
                        $('#tr_container_index_{{$index}}').after(response.row_html).remove()
                    },
                    (error) => {

                    }
                )
            }
        });

    });

</script>

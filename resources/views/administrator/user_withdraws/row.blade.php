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
        @can('user_withdraws-edit')
            @include('administrator.components.require_input_text', ['no_margin' => true,'name' => "input_deduction",'id' => "input_deduction_". $item->id, 'value'=> $item->deduction ?? 0])
        @else
            @include('administrator.components.label', ['label'=> $item->deduction ?? 0])
        @endcan
    </td>
    <td>
        @can('user_withdraws-edit')
            @include('administrator.components.require_input_text', ['no_margin' => true,'name' => "input_invalid",'id' => "input_invalid_". $item->id, 'value'=> $item->invalid ?? 0])
        @else
            @include('administrator.components.label', ['label'=> $item->invalid ?? 0])
        @endcan

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

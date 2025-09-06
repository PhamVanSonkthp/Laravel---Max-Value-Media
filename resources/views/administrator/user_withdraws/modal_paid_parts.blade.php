<div class="table-responsive product-table">
    <table class="table table-hover table-bordered">
        <thead>
        <tr>
            <th class="text-start">
                <div>
                    Amount
                </div>
            </th>
            <th>
                <div>
                    Craeted at
                </div>
            </th>
        </tr>
        </thead>
        <tbody class="" id="modal_modal_paid_parts_body_container_item">
        @foreach($item->paymentPaidParts as $index => $paymentPaidPart)

            @include('administrator.user_withdraws.modal_paid_parts_row', ['item' => $paymentPaidPart])

        @endforeach

        </tbody>

    </table>
</div>

@if(in_array($item->payment_status_id , [1,4]))

@include('administrator.components.input_text', ['label' => 'Add paid','name' => 'none', 'id' => 'modal_paid_parts_input_amount'])

<div class="row">
    <div class="col-6">
        <button onclick="onStorePaidPart({{$item->id}})" class="btn btn-primary mt-3">Save</button>
    </div>
    <div class="col-6">
        <button onclick="onStorePaidAllPart({{$item->id}})" class="btn btn-danger mt-3">Pay all</button>
    </div>
</div>


@endif

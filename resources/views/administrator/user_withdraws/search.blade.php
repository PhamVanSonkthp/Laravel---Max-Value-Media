<div>
    @include('administrator.components.search', ['hideTime' => true, 'hideFind' => true])

    @include('administrator.components.search_right', ['hideCreate' => true,'hideExport'=>true,'hideTrash'=>true])

</div>

<div class="clearfix"></div>

<div class="row mt-1">
    <div class="col-xl-4">
        <div class="card">
            <div class="card-body">
                <h3>
                    ${{\App\Models\Formatter::formatNumber($summary->total, 2)}}
                </h3>
                <div>
                    Total
                </div>
            </div>

        </div>
    </div>
    <div class="col-xl-4">
        <div class="card">
            <div class="card-body">
                <h3>
                    ${{\App\Models\Formatter::formatNumber($summary->unpaid, 2)}}
                </h3>
                <div>
                    Unpaid
                </div>
            </div>

        </div>
    </div>
    <div class="col-xl-4">
        <div class="card">
            <div class="card-body">
                <h3>
                    ${{\App\Models\Formatter::formatNumber($summary->deduction, 2)}}
                </h3>
                <div>
                    Deduction
                </div>
            </div>

        </div>
    </div>
</div>

<div class="row">

    <div class="col-md-3">
        <div class="mt-3">
            <label>Time</label>
            <input id="input_search_month" type="date"
                   class="bg-white form-control" placeholder="--/--/--">
        </div>
    </div>

    <div class="col-md-3">
        <div>
            @include('administrator.components.search_select2_ajax_allow_clear' , ['name' => 'user_id' , 'label' => 'Publisher', 'url' => route('ajax.administrator.model.search', ['is_admin' => 0]), 'model' => 'users'])
        </div>
    </div>

    <div class="col-md-3">
        <div>
            @include('administrator.components.search_select2_allow_clear' , ['name' => 'payment_method_id' , 'label' => 'Method', 'select2Items' => $paymentMethos])
        </div>
    </div>

    <div class="col-md-3">
        <div>
            @include('administrator.components.search_select2_allow_clear' , ['name' => 'payment_status_id' , 'label' => 'Status', 'select2Items' => $paymentStatuses])
        </div>
    </div>

</div>

<script>
    $(document).ready(function () {

        $('#input_search_month').flatpickr({
            plugins: [
                new monthSelectPlugin({
                    shorthand: true, //defaults to false
                    dateFormat: "y-m", //defaults to "F Y"
                    altFormat: "y-m", //defaults to "F Y"
                })
            ],
            maxDate: '{{\Carbon\Carbon::today()->toDateString()}}',
            onClose: function (selectedDates, dateStr, instance) {
                if (dateStr != "{{request('date')}}") {
                    addUrlParameter('date', dateStr)
                }

            },
            @if(!empty(request('date')) )
            defaultDate: "{{str_replace("-","",request('date'))}}",
            @endif

        });

    });


    // Change filter if you want
    // function onSearchQuery() {
    //     addUrlParameterObjects([
    //         {name: "search_query", value: $('#input_search_query').val()},
    //         {name: "from", value: input_query_from},
    //         {name: "to", value: input_query_to},
    //     ])
    // }

</script>

<div>
    @include('administrator.components.search')

    @include('administrator.components.search_right')
</div>

<div class="clearfix"></div>

<div class="row">

    <div class="col-md-3">
        <div>
            @include('administrator.components.search_select2_allow_clear' , ['name' => 'order_status_id' , 'label' => 'Trạng thái đơn hàng', 'select2Items' => \App\Models\OrderStatus::all()])
        </div>
    </div>

    <div class="col-md-3">
        <div>
            @include('administrator.components.search_select2_allow_clear' , ['name' => 'shipping_method_id' , 'label' => 'Phương thức vận chuyển', 'select2Items' => \App\Models\ShippingMethod::all()])
        </div>
    </div>

    <div class="col-md-3">
        <div>
            @include('administrator.components.search_select2_allow_clear' , ['name' => 'shipping_method_id' , 'label' => 'Phương thức thanh toán', 'select2Items' => \App\Models\PaymentMethod::all()])
        </div>
    </div>

</div>


<script>

    function onSearchQuery() {
        addUrlParameterObjects([
            {name: "search_query", value: $('#input_search_query').val()},
            {name: "from", value: input_query_from},
            {name: "to", value: input_query_to},
        ])
    }

</script>

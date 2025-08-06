<div>
    @include('administrator.components.search')

    @include('administrator.components.search_right')

    <div class="clearfix"></div>
    {{--        write your filter here ...--}}
    {{--example--}}
    {{--    <div class="row">--}}

    {{--        <div class="col-md-3">--}}
    {{--            <div>--}}
    {{--                @include('administrator.components.search_select2_allow_clear' , ['name' => 'order_status_id' , 'label' => 'Trạng thái đơn hàng', 'select2Items' => \App\Models\OrderStatus::all()])--}}
    {{--            </div>--}}
    {{--        </div>--}}

    {{--    </div>--}}

</div>


<script>

    // Change filter if you want
    // function onSearchQuery() {
    //     addUrlParameterObjects([
    //         {name: "search_query", value: $('#input_search_query').val()},
    //         {name: "from", value: input_query_from},
    //         {name: "to", value: input_query_to},
    //     ])
    // }

</script>

<div>
    @include('administrator.components.search')

    @if(!isset($hideCreate))
        <a href="#" onclick="onShowModalCreateWebsite()" class="btn btn-outline-success float-end" title="Tạo"><i
                class="fa-solid fa-plus"></i></a>
    @endif

    <a href="{{route('administrator.'.$prefixView.'.export') . "?" . request()->getQueryString()}}" class="btn btn-outline-primary float-end me-2" data-bs-original-title="" title="Excel"><i class="fa-sharp fa-solid fa-file-excel"></i></a>


    <a href="{{ request()->url() . (request('trash') == "true" ? '' : '?trash=true')}}" class="btn btn-{{request('trash') == "true" ? '' : 'outline-'}}secondary float-end me-2"  title="{{request('trash') == "true" ? 'Đang xem chế độ thùng rác, nhấn để quay lại' : 'Thùng rác'}}">
        <i class="fa-solid fa-recycle"></i>
    </a>


</div>

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

<div>
    @include('administrator.components.search')

    <a href="{{route('administrator.'.$prefixView.'.create')}}" class="btn btn-outline-success float-end"><i
            class="fa-solid fa-plus"></i></a>

    <a href="{{route('administrator.'.$prefixView.'.export')}}" class="btn btn-outline-primary float-end me-2" data-bs-original-title="" title="Export excel"><i class="fa-sharp fa-solid fa-file-excel"></i></a>

{{--    <div class="clearfix"></div>--}}

{{--    <div class="row">--}}
{{--        <div class="col-md-3">--}}
{{--            <div class="mt-3">--}}
{{--                @include('administrator.components.select2_allow_clear', ['name' => 'rotaion_luck_id', 'label' => 'Loại vòng quay','select2Items' => \App\Models\RotationLuck::all(), 'value' => request('rotaion_luck_id')])--}}
{{--            </div>--}}
{{--        </div>--}}

{{--    </div>--}}
</div>


<script>

    // function onSearchQuery() {
    //     addUrlParameterObjects([
    //         {name: "search_query", value: $('#input_search_query').val()},
    //         {name: "from", value: input_query_from},
    //         {name: "to", value: input_query_to},
    //     ])
    // }

    // $('select[name="rotaion_luck_id"]').on('change', function () {
    //     addUrlParameter('rotaion_luck_id', this.value)
    // });

</script>

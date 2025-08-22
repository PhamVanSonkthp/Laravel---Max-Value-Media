<div>
    @include('administrator.components.search', ['hideFind' => true])

    <a href="{{route('user.report.export') . "?" . request()->getQueryString()}}" class="btn btn-outline-primary float-end me-2" data-bs-original-title="" title="Excel"><i class="fa-sharp fa-solid fa-file-excel"></i></a>

</div>

<div class="clearfix"></div>
{{--        write your filter here ...--}}
{{--example--}}
    <div class="row">

        <div class="col-md-3">
            <div>
                @include('administrator.components.search_select2_allow_clear' , ['name' => 'website_id' , 'label' => 'Websites', 'select2Items' => $websites])
            </div>
        </div>

        <div class="col-md-3">
            <div>
                @include('administrator.components.search_select2_allow_clear' , ['name' => 'zone_website_id' , 'label' => 'Zones', 'select2Items' => $zoneWebsites])
            </div>
        </div>

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

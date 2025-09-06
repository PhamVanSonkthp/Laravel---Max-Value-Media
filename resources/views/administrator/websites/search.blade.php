<div>
    @include('administrator.components.search')

    @can('websites-add')
        <button onclick="onShowModalCreateWebsite()" class="btn btn-success float-end" title="Create">
            Create website <i class="fa-solid fa-plus"></i></button>
    @endcan

</div>

<div class="clearfix"></div>
{{--        write your filter here ...--}}
{{--example--}}
    <div class="row">

        <div class="col-md-3">
            <div>
                @include('administrator.components.search_select2_ajax_allow_clear' , ['name' => 'user_id' , 'label' => 'Publisher', 'url' => route('ajax.administrator.model.search', ['is_admin' => 0]), 'model' => 'users'])
            </div>
        </div>

        <div class="col-md-3">
            <div>
                @include('administrator.components.search_select2_ajax_allow_clear' , ['name' => 'id' , 'label' => 'Website', 'url' => route('ajax.administrator.model.search'), 'model' => 'websites'])
            </div>
        </div>

        <div class="col-md-3">
            <div>
                @include('administrator.components.search_select2_allow_clear' , ['name' => 'status_website_id' , 'label' => 'Status Website', 'select2Items' => $statusWebsites])
            </div>
        </div>

        <div class="col-md-3">
            <div>
                @include('administrator.components.search_select2_ajax_allow_clear' , ['name' => 'zone_website_id' , 'label' => 'Zone', 'url' => route('ajax.administrator.model.search'), 'model' => 'zone_websites'])
            </div>
        </div>

        <div class="col-md-3">
            <div>
                @include('administrator.components.search_select2_allow_clear' , ['name' => 'manager_id' , 'label' => 'Manager', 'select2Items' => $managers])
            </div>
        </div>
        <div class="col-md-3">
            <div>
                @include('administrator.components.search_select2_allow_clear' , ['name' => 'cs_id' , 'label' => 'CS', 'select2Items' => $cses])
            </div>
        </div>

        <div class="col-md-3">
            <div>
                @include('administrator.components.search_select2_allow_clear' , ['name' => 'zone_status_id' , 'label' => 'Status Zone', 'select2Items' => $zoneStatuses])
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

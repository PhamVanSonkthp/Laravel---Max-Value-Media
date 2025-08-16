<div>
    @include('administrator.components.search')

    <a onclick="onAdd()" class="btn btn-outline-success float-end"><i
            class="fa-solid fa-plus"></i></a>

    <a href="{{route('administrator.'.$prefixView.'.export')}}" class="btn btn-outline-primary float-end me-2"
       data-bs-original-title="" title="Excel"><i class="fa-sharp fa-solid fa-file-excel"></i></a>

    <div class="clearfix"></div>

    <div class="row">

        <div class="col-md-3">
            <div>
                @include('administrator.components.search_select2_allow_clear' , ['name' => 'manager_id' , 'label' => 'Manager', 'select2Items' => $managers])
            </div>
        </div>

        <div class="col-md-3">
            <div>
                @include('administrator.components.search_select2_ajax_allow_clear' , ['name' => 'id' , 'label' => 'Publisher', 'url' => route('ajax.administrator.model.search', ['is_admin' => 0]), 'model' => 'users'])
            </div>
        </div>

        <div class="col-md-3">
            <div>
                @include('administrator.components.search_select2_ajax_allow_clear' , ['name' => 'website_id' , 'label' => 'Website', 'url' => route('ajax.administrator.model.search'), 'model' => 'websites'])
            </div>
        </div>

        <div class="col-md-3">
            <div>
                @include('administrator.components.search_select2_allow_clear' , ['name' => 'is_verify' , 'label' => 'Verify', 'select2Items' => $isVerifies])
            </div>
        </div>

        <div class="col-md-3">
            <div>
                @include('administrator.components.search_select2_allow_clear' , ['name' => 'is_balance' , 'label' => 'Balance', 'select2Items' => $isBalances])
            </div>
        </div>

        <div class="col-md-3">
            <div>
                @include('administrator.components.search_select2_allow_clear' , ['name' => 'user_status_id' , 'label' => 'Status', 'select2Items' => $userStatus])
            </div>
        </div>

        <div class="col-md-3">
            <div>
                @include('administrator.components.search_select2_allow_clear' , ['name' => 'status_website_id' , 'label' => 'Website status', 'select2Items' => $statusWebsite])
            </div>
        </div>

    </div>
</div>


<script>

    $('select[name="user_type_id"]').on('change', function () {
        addUrlParameter('user_type_id', this.value)
    });

</script>

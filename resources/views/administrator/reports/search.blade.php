<style>
    .wrapper {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .wrapper .file-upload input[type='file'] {
        height: 200px;
        width: 200px;
        position: absolute;
        top: 0;
        left: 0;
        opacity: 0;
        cursor: pointer;
    }

    .wrapper .file-upload:hover {
        background-position: 0 -100%;
        color: #2590eb;
    }

    #exportDropdown::after{
        display: none;
    }

    #importDropdown::after{
        display: none;
    }

</style>


<div>
    @include('administrator.components.search')

    @can('reports-edit_import')
    <div class="float-end">
        <a class="p-0 nav-link dropdown-toggle btn btn-outline-success" href="#" id="exportDropdown" role="button"
           data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa-sharp fa-solid fa-download" style="margin: 10px;color: green;"></i>
        </a>
        <div class="p-0 dropdown-menu" aria-labelledby="exportDropdown" id="container_export_dropdown">
            <a onclick="onCreateReport()" href="javascript:;" class="dropdown-item py-2">
                <span class="ms-1"> Tạo báo cáo mới </span></a>

        </div>
    </div>

    @endcan


    @can('reports-list_export')
    <div class="float-end me-1">
        <a class="p-0 nav-link dropdown-toggle btn btn-outline-success" href="#" id="importDropdown" role="button"
           data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa-sharp fa-solid fa-upload" style="margin: 10px;color: green;"></i>
        </a>
        <div class="dropdown-menu" aria-labelledby="importDropdown" style="width: 238px;">

            <form action="{{route('administrator.'.$prefixView.'.import')}}" method="POST" enctype="multipart/form-data"
                  style="display: contents">
                @csrf

                <div class="wrapper" style="float: right;">
                    <div class="file-upload me-2">
                        Tải báo cáo mới (Sẽ tính revenue cho publisher nếu update vào ngày hôm qua, tính theo giờ utc +0)
                        <input id="input_import" type="file" class="@error('input_import') is-invalid @enderror"
                               accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel"
                               onchange="onImport()"/>
                        <i class="fa-sharp fa-solid fa-upload"></i>
                        @error('input_import')
                        <div class="alert alert-danger">{{$message}}</div>
                        @enderror
                    </div>
                </div>

            </form>

            <div class="dropdown-menu show" style="right: 0px;    margin-top: 68px;" id="container_import_dropdown">

            </div>
        </div>
    </div>

    @endcan
</div>

<div class="clearfix"></div>
{{--        write your filter here ...--}}
{{--example--}}
    <div class="row">

        <div class="col-md-3">
            <div>
                @include('administrator.components.search_select2_ajax_allow_clear' , ['name' => 'user_id' , 'label' => 'Publishers', 'url' => route('ajax.administrator.model.search'), 'model' => 'users'])
            </div>
        </div>

        @can('reports-list-demand')
            <div class="col-md-3">
                <div class="mt-3">
                    <label>Demands</label>
                    <select name="demand_id" class="form-control select2_init_allow_clear">
                        <option value="">
                            Chọn
                        </option>
                        @foreach($demands as $demand)
                            <option value="{{$demand->id}}" {{request('demand_id') == $demand->id ? 'selected' : ''}}>{{$demand->name}}</option>
                        @endforeach
                    </select>

                </div>

                <script>

                    $('select[name="demand_id"]').on('change', function () {
                        addUrlParameterObjects([{name: 'demand_id', value: this.value},{name: 'zone_id', value: ""},{name: 'website_id', value: ""}])
                    });
                </script>

            </div>
        @endcan


        <div class="col-md-3">
            <div>
                @include('administrator.components.search_select2_ajax_allow_clear' , ['name' => 'website_id' , 'label' => 'Website', 'url' => route('ajax.administrator.model.search'), 'model' => 'websites'])
            </div>
        </div>

        <div class="col-md-3">
            <div>
                @include('administrator.components.search_select2_ajax_allow_clear' , ['name' => 'zone_website_id' , 'label' => 'Zone', 'url' => route('ajax.administrator.model.search'), 'model' => 'zone_websites'])
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

    function onImport() {
        var formData = new FormData(); // Currently empty
        formData.append('import_file', document.querySelector('#input_import').files[0]);

        callAjaxMultipart(
            "POST",
            "{{route('administrator.'.$prefixView.'.import')}}",
            formData,
            (response) => {
                showToastSuccess("Đã tạo import thành công, vui lòng reload lại trang khi import hoàn tất");
            },
            (error) => {

            },
            (percent) => {

            },
            true,
            true,
            true,
        )
    }

    function onCreateReport() {
        callAjax(
            "GET",
            "{!! route('administrator.'.$prefixView.'.export') . "?" . request()->getQueryString() !!}",
            {

            },
            (response) => {
                showToastSuccess("Đã tạo báo cáo, vui lòng click vào báo cáo ở góc phải để xem tiến trình");
            },
            (error) => {

            },
            true,
        )
    }

    function onRefreshExport(){
        callAjax(
            "GET",
            "{{route('ajax.administrator.'.$prefixView.'.refresh_export') . "?" . request()->getQueryString()}}",
            {

            },
            (response) => {
                $('#container_export_dropdown').html(response.data.export_html)
                $('#container_import_dropdown').html(response.data.import_html)
            },
            (error) => {

            },
            false,
        )
    }

    $(document).ready(function() {
        onRefreshExport()
        setInterval(onRefreshExport, 5000);
    });

</script>

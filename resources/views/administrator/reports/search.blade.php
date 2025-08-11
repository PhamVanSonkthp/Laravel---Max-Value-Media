<style>
    .wrapper {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .wrapper .file-upload {
        height: 37px;
        width: 50px;
        border-radius: 100px;
        position: relative;
        display: flex;
        justify-content: center;
        align-items: center;
        overflow: hidden;
        background-image: linear-gradient(to bottom, #2590eb 50%, #fff 50%);
        background-size: 100% 200%;
        transition: all 1s;
        color: #fff;
        font-size: 20px;
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

</style>


<div>
    @include('administrator.components.search')

    <a href="{{route('administrator.'.$prefixView.'.export') . "?" . request()->getQueryString()}}" class="btn btn-outline-success float-end me-2" data-bs-original-title="" title="Xuất Excel"><i class="fa-sharp fa-solid fa-download"></i></a>

    <form action="{{route('administrator.'.$prefixView.'.import')}}" method="POST" enctype="multipart/form-data" style="display: contents">
        @csrf

        <div class="wrapper" style="float: right;">
            <div class="file-upload me-2">
                <input id="input_import" type="file" class="@error('input_import') is-invalid @enderror"
                       accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" onchange="onImport()"/>
                <i class="fa-sharp fa-solid fa-upload"></i>
                @error('input_import')
                <div class="alert alert-danger">{{$message}}</div>
                @enderror
            </div>
        </div>

    </form>
</div>

<div class="clearfix"></div>
{{--        write your filter here ...--}}
{{--example--}}
    <div class="row">

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
        formData.append('import_file', document.querySelector('#input_import').files[0], 'chris.jpg');

        callAjaxMultipart(
            "POST",
            "{{route('administrator.'.$prefixView.'.import')}}",
            formData,
            (response) => {
                window.location.reload()
                // alert('đã thêm ' + response + " sản phẩm")
            },
            (error) => {
                console.log(error)
            },
            (percent) => {
                console.log(percent)
            },
            true,
            true,
            true,
        )
    }

</script>

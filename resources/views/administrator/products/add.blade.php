@extends('administrator.layouts.master')

@include('administrator.'.$prefixView.'.header')

@section('css')
    <style>
        .item-vari {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .skus{
            min-width: 150px;
        }
    </style>
@endsection

@section('content')

    <form action="{{route('administrator.'.$prefixView.'.store') }}" method="post"
          enctype="multipart/form-data">
        @csrf
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">

                    <div class="row">
                        <div class="col-md-6">

                            @include('administrator.components.require_input_text' , ['name' => 'name' , 'label' => 'Tên'])

                            @include('administrator.components.select_category' , ['lable' => 'Danh mục', 'name' => 'category_id' ,'html_category' => \App\Models\Category::getCategory(isset($item) ? optional($item)->category_id : ''), 'can_create' => true])

                            @include('administrator.components.require_textarea_description', ['id' => 'description','name' => 'description' , 'label' => 'Mô tả'])

                            <div class="form-check form-switch mb-3 mt-3">
                                <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" value="on">
                                <label class="form-check-label" for="flexSwitchCheckDefault">Sản phẩm có biến thể?</label>
                            </div>

                            <div id="container_no_vari" class="mt-3">
                                <div class="row">
                                    <div class="col-4">
                                        <div>

                                            @include('administrator.components.require_input_number' , ['name' => 'price' , 'label' => 'Giá'])

                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div>
                                            @include('administrator.components.require_input_number' , ['name' => 'inventory' , 'label' => 'Tồn kho'])

                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div>
                                            @include('administrator.components.input_text' , ['name' => 'sku' , 'label' => 'SKU'])

                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div id="container_vari_parent" style="display: none">
                                <div class="grid-margin stretch-card">
                                    <div class="card">
                                        <div class="card-body">

                                            <div id="container_vari">
                                                <div id="container_vari_1">
                                                    <div>
                                                        <div class="d-flex" style="align-items: center;gap: 5px;">
                                                            <h6>Biến thể 1</h6>
                                                        </div>
                                                        <input oninput="onDrawTableVari()" id="input_vari_1" type="text" class="form-control" placeholder="Nhập" required/>
                                                    </div>
                                                    <ul class="list-group ms-3 mt-1" id="container_item_vari_1">

                                                        <li class="list-group-item" style="">

                                                            <div class="item-vari">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                                     viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                                     stroke-width="2"
                                                                     stroke-linecap="round" stroke-linejoin="round"
                                                                     class="feather feather-move icon-sm handle me-2">
                                                                    <polyline points="5 9 2 12 5 15"></polyline>
                                                                    <polyline points="9 5 12 2 15 5"></polyline>
                                                                    <polyline points="15 19 12 22 9 19"></polyline>
                                                                    <polyline points="19 9 22 12 19 15"></polyline>
                                                                    <line x1="2" y1="12" x2="22" y2="12"></line>
                                                                    <line x1="12" y1="2" x2="12" y2="22"></line>
                                                                </svg>

                                                                <input value="0" class="d-none atrribute-id-vari-1">

                                                                <input oninput="onUpdateVari1()" type="text"
                                                                       class="form-control value-vari-1" placeholder="Nhập"
                                                                       required/>
                                                                <i class="fa-solid fa-trash" onclick="onDeleteItem(this)"></i>
                                                            </div>
                                                        </li>

                                                    </ul>
                                                </div>

                                                <div class="mt-3 text-end" id="container_btn_add_vari">
                                                    <button id="btn_add_vari" type="button" class="btn btn-success">+</button>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="col-md-6">
                            @if($isSingleImage)
                                <div class="mt-3 mb-3">
                                    @include('administrator.components.upload_image', ['post_api' => $imagePostUrl, 'table' => $table, 'image' => $imagePathSingple , 'relate_id' => $relateImageTableId])
                                </div>
                            @endif

                            @if($isMultipleImages)
                                <div class="mt-3 mb-3">
                                    @include('administrator.components.upload_multiple_images', ['post_api' => $imageMultiplePostUrl, 'delete_api' => $imageMultipleDeleteUrl , 'sort_api' => $imageMultipleSortUrl, 'table' => $table , 'images' => $imagesPath,'relate_id' => $relateImageTableId])
                                </div>
                            @endif

                            <div class="accordion mt-3">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingTwo">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                            Nâng cao
                                        </button>
                                    </h2>
                                    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <div class="row">
                                                <div class="col-4">
                                                    @include('administrator.components.require_input_number' , ['name' => 'price_import' , 'label' => 'Giá nhập'])
                                                </div>

                                                <div class="col-4">
                                                    @include('administrator.components.require_input_number' , ['name' => 'price_agent' , 'label' => 'Giá bán buôn (đại lý)'])

                                                </div>
                                                <div class="col-4">
                                                    @include('administrator.components.require_input_number' , ['name' => 'price_partner' , 'label' => 'Giá CTV (Cộng tác viên)'])

                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>

                    <div id="container_table_vari">

                    </div>



                    <div style="position: relative;">
                        <button onclick="onSave()" id="{{isset($id) ? $id : \App\Models\Helper::randomString()}}" type="button" class="btn btn-primary mt-3">Lưu lại</button>
                    </div>

                </div>
            </div>
        </div>
    </form>

@endsection

@section('js')

    <script>

        function onSave(e){

            if(isEmptyInput('name', true, 'Vui lòng điền tên', true)) return


            const name = $('input[name="name"]').val()
            const category = $('select[name="category_id"]').val()
            const description = tinymce.get('description').getContent();
            const sku = $('input[name="sku"]').val()

            if(empty(description)) {
                alert('Chưa điền mô tả')
                return
            }

            if ($('#flexSwitchCheckDefault').is(':checked')){

                const header_vari_1 = $('#input_vari_1').val()
                const header_vari_2 = $('#input_vari_2').val()

                let elements = document.querySelectorAll(".value-vari-1");
                const values_1 = [];

                elements.forEach(element => {
                    values_1.push(element.value); // For elements like input or textarea
                });

                elements = document.querySelectorAll(".value-vari-2");
                const values_2 = [];

                elements.forEach(element => {
                    values_2.push(element.value); // For elements like input or textarea
                });

                const prices = [];

                $('input[name="prices"]').each(function() {
                    prices.push($(this).val());
                });

                const inventories = [];

                $('input[name="inventories"]').each(function() {
                    inventories.push($(this).val());
                });

                let counter_1 = 0;
                for(let i = 0; i < values_1.length; i++){
                    if(!values_1[i]) counter_1 ++;
                }

                if (!header_vari_1){
                    alert('Vui lòng điền biến thể 1')
                    return;
                }

                if(counter_1 > 1 || values_1.length == 1){
                    alert('Vui lòng điền tất cả giá trị của biến thể 1')
                    return;
                }

                if (header_vari_2){
                    let counter_2 = 0;
                    for(let i = 0; i < values_2.length; i++){
                        if(!values_2[i]) counter_2 ++;
                    }

                    if(counter_2 > 1 || values_2.length == 1){
                        alert('Vui lòng điền tất cả giá trị của biến thể 2')
                        return;
                    }
                }

                callAjax(
                    "POST",
                    "{{route('ajax.administrator.products.store')}}",
                    {
                        name : name,
                        category : category,
                        description : description,
                        is_variant : 1,

                        header_vari_1: header_vari_1,
                        header_vari_2: header_vari_2,
                        values_1: values_1,
                        values_2: values_2,
                        prices: prices,
                        inventories: inventories,
                    },
                    (response) => {
                        window.location.href = "{{route('administrator.products.index')}}"
                    },
                    (error) => {

                    },
                )

            }else{
                if(isEmptyInput('price', true, 'Vui lòng điền giá', true)) return
                if(isEmptyInput('inventory', true, 'Vui lòng điền tồn kho', true)) return

                const price = $('input[name="price"]').val()
                const inventory = $('input[name="inventory"]').val()
                const price_import = $('input[name="price_import"]').val()
                const price_agent = $('input[name="price_agent"]').val()
                const price_partner = $('input[name="price_partner"]').val()

                callAjax(
                    "POST",
                    "{{route('ajax.administrator.products.store')}}",
                    {
                        name : name,
                        category : category,
                        description : description,
                        price : price,
                        inventory : inventory,
                        sku : sku,
                        price_import : price_import,
                        price_agent : price_agent,
                        price_partner : price_partner,
                        is_variant : 0,
                    },
                    (response) => {
                        window.location.href = "{{route('administrator.products.index')}}"
                    },
                    (error) => {

                    },
                )
            }

        }

        $('#flexSwitchCheckDefault').change(function() {

            if ($(this).is(':checked')) {
                $('#container_no_vari').hide()
                $('#container_vari_parent').show()
                $('#container_table_vari').show()
            } else {
                $('#container_no_vari').show()
                $('#container_vari_parent').hide()
                $('#container_table_vari').hide()
            }
        });

        let timeoutId;


        function onDrawTableVari() {
            clearTimeout(timeoutId); // Clear the previous timer
            timeoutId = setTimeout(() => {
                const header_vari_1 = $('#input_vari_1').val()
                const header_vari_2 = $('#input_vari_2').val()

                let elements = document.querySelectorAll(".value-vari-1");
                const values_1 = [];

                elements.forEach(element => {
                    values_1.push(element.value); // For elements like input or textarea
                });

                elements = document.querySelectorAll(".value-vari-2");
                const values_2 = [];

                elements.forEach(element => {
                    values_2.push(element.value); // For elements like input or textarea
                });

                elements = document.querySelectorAll(".atrribute-id-vari-1");
                const atrributes_id_vari_1 = [];

                elements.forEach(element => {
                    atrributes_id_vari_1.push(element.value); // For elements like input or textarea
                });

                elements = document.querySelectorAll(".atrribute-id-vari-2");
                const atrributes_id_vari_2 = [];

                elements.forEach(element => {
                    atrributes_id_vari_2.push(element.value); // For elements like input or textarea
                });

                callAjax(
                    "GET",
                    "{{route('ajax.administrator.products.render_table_vari')}}",
                    {
                        header_vari_1: header_vari_1,
                        header_vari_2: header_vari_2,
                        values_1: values_1,
                        values_2: values_2,
                        atrributes_id_vari_1: atrributes_id_vari_1,
                        atrributes_id_vari_2: atrributes_id_vari_2,
                    },
                    (response) => {
                        $('#container_table_vari').html(response.html)
                    },
                    (error) => {

                    },
                    false,
                )

            }, 500); // Adjust the delay time as needed


        }

        function onDeleteContainerVari2() {
            $('#btn_add_vari').show()
            $('#container_vari_2').remove()
            onDrawTableVari()
        }

        function onUpdateVari1() {

            let number_empty = 0
            const elements = document.querySelectorAll(".value-vari-1");
            elements.forEach((element) => {
                if (!element.value) number_empty++
            });

            if (number_empty == 0) {
                $('#container_item_vari_1').append(`<li class="list-group-item" style="">

                                                <div class="item-vari">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                         viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                         stroke-linecap="round" stroke-linejoin="round"
                                                         class="feather feather-move icon-sm handle me-2">
                                                        <polyline points="5 9 2 12 5 15"></polyline>
                                                        <polyline points="9 5 12 2 15 5"></polyline>
                                                        <polyline points="15 19 12 22 9 19"></polyline>
                                                        <polyline points="19 9 22 12 19 15"></polyline>
                                                        <line x1="2" y1="12" x2="22" y2="12"></line>
                                                        <line x1="12" y1="2" x2="12" y2="22"></line>
                                                    </svg>
                                                    <input value="0" class="d-none atrribute-id-vari-1">
                                                    <input oninput="onUpdateVari1()" type="text" class="form-control value-vari-1" placeholder="Nhập" required/>
                                                    <i class="fa-solid fa-trash" onclick="onDeleteItem(this)"></i>
                                                </div>
                                            </li>`)
            }

            onDrawTableVari()
        }

        function onUpdateVari2() {

            let number_empty = 0
            const elements = document.querySelectorAll(".value-vari-2");
            elements.forEach((element) => {
                if (!element.value) number_empty++
            });

            if (number_empty == 0) {
                $('#container_item_vari_2').append(`<li class="list-group-item" style="">

                                                <div class="item-vari">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                         viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                         stroke-linecap="round" stroke-linejoin="round"
                                                         class="feather feather-move icon-sm handle me-2">
                                                        <polyline points="5 9 2 12 5 15"></polyline>
                                                        <polyline points="9 5 12 2 15 5"></polyline>
                                                        <polyline points="15 19 12 22 9 19"></polyline>
                                                        <polyline points="19 9 22 12 19 15"></polyline>
                                                        <line x1="2" y1="12" x2="22" y2="12"></line>
                                                        <line x1="12" y1="2" x2="12" y2="22"></line>
                                                    </svg>
                                                    <input value="0" class="d-none atrribute-id-vari-2">
                                                    <input oninput="onUpdateVari2()" type="text" class="form-control value-vari-2" placeholder="Nhập" required/>
                                                    <i class="fa-solid fa-trash" onclick="onDeleteItem(this)"></i>
                                                </div>
                                            </li>`)
            }

            onDrawTableVari()
        }

        function onDeleteItem(element) {

            $(element).parent().parent().remove()

            if (!document.querySelector(".value-vari-1")) {

                $('#container_item_vari_1').append(`<li class="list-group-item" style="">

                                                <div class="item-vari">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                         viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                         stroke-linecap="round" stroke-linejoin="round"
                                                         class="feather feather-move icon-sm handle me-2">
                                                        <polyline points="5 9 2 12 5 15"></polyline>
                                                        <polyline points="9 5 12 2 15 5"></polyline>
                                                        <polyline points="15 19 12 22 9 19"></polyline>
                                                        <polyline points="19 9 22 12 19 15"></polyline>
                                                        <line x1="2" y1="12" x2="22" y2="12"></line>
                                                        <line x1="12" y1="2" x2="12" y2="22"></line>
                                                    </svg>
                                                    <input value="0" class="d-none atrribute-id-vari-1">
                                                    <input oninput="onUpdateVari1()" type="text" class="form-control value-vari-1" placeholder="Nhập" required/>
                                                    <i class="fa-solid fa-trash" onclick="onDeleteItem(this)"></i>
                                                </div>
                                            </li>`)
            }

            if (!document.querySelector(".value-vari-2")) {

                $('#container_item_vari_2').append(`<li class="list-group-item" style="">

                                                <div class="item-vari">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                         viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                         stroke-linecap="round" stroke-linejoin="round"
                                                         class="feather feather-move icon-sm handle me-2">
                                                        <polyline points="5 9 2 12 5 15"></polyline>
                                                        <polyline points="9 5 12 2 15 5"></polyline>
                                                        <polyline points="15 19 12 22 9 19"></polyline>
                                                        <polyline points="19 9 22 12 19 15"></polyline>
                                                        <line x1="2" y1="12" x2="22" y2="12"></line>
                                                        <line x1="12" y1="2" x2="12" y2="22"></line>
                                                    </svg>
                                                    <input value="0" class="d-none atrribute-id-vari-2">
                                                    <input oninput="onUpdateVari2()" type="text" class="form-control value-vari-2" placeholder="Nhập" required/>
                                                    <i class="fa-solid fa-trash" onclick="onDeleteItem(this)"></i>
                                                </div>
                                            </li>`)
            }

            onDrawTableVari()

            onUpdateVari1()
            onUpdateVari2()
        }

        var simpleList = document.querySelector("#container_item_vari_1");
        new Sortable(simpleList, {
            animation: 150,
            ghostClass: 'bg-light'
        });

        $('#btn_add_vari').on("click", function () {
            $('#btn_add_vari').hide()
            $('#container_vari').append(`<div id="container_vari_2"class="mt-3">
                                        <div>
                                            <div class="d-flex" style="align-items: center;gap: 5px;">
                                                <h6>Biến thể 2</h6>
                                                <i class="fa-solid fa-trash" onclick="onDeleteContainerVari2()"></i>
                                            </div>
                                            <input oninput="onDrawTableVari()" id="input_vari_2" type="text" class="form-control" placeholder="Nhập" required/>
                                        </div>
                                        <ul class="list-group ms-3 mt-1" id="container_item_vari_2">

                                            <li class="list-group-item" style="">

                                                <div class="item-vari">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                         viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                         stroke-linecap="round" stroke-linejoin="round"
                                                         class="feather feather-move icon-sm handle me-2">
                                                        <polyline points="5 9 2 12 5 15"></polyline>
                                                        <polyline points="9 5 12 2 15 5"></polyline>
                                                        <polyline points="15 19 12 22 9 19"></polyline>
                                                        <polyline points="19 9 22 12 19 15"></polyline>
                                                        <line x1="2" y1="12" x2="22" y2="12"></line>
                                                        <line x1="12" y1="2" x2="12" y2="22"></line>
                                                    </svg>
                                                    <input value="0" class="d-none atrribute-id-vari-2">
                                                    <input oninput="onUpdateVari2()" type="text" class="form-control value-vari-2" placeholder="Nhập" required/>
                                                    <i class="fa-solid fa-trash" onclick="onDeleteItem(this)"></i>
                                                </div>
                                            </li>

                                        </ul>
                                    </div>`);

            var simpleList = document.querySelector("#container_item_vari_2");
            new Sortable(simpleList, {
                animation: 150,
                ghostClass: 'bg-light'
            });
        });

    </script>

    <script>
        function _addAttribute() {
            $('#bassic_price').append(`<div class="p-3">

                <div id="attribute_2" class="card p-3">

                    <div class="text-end">
                        <button onclick="removeAllAttribute(this)" type="button" class="btn btn-danger"><i
                                class="fa-solid fa-x"></i></button>
                    </div>

                    <div class="d-flex mt-3">
                        <input type="text" autocomplete="off" class="form-control header-_attributes" placeholder="Thuộc tính" oninput="renderTableAttribute()" required>
                        <button type="button" onclick="addItemValueAttribute(this)" class="btn btn-success ms-1"
                                data-bs-original-title="" title=""><i class="fa-solid fa-plus"></i></button>
                    </div>

                    <div class="ms-3 mt-3 me-3 d-flex align-items-center">
                        <div class="d-flex mt-1">
                            <input type="text" autocomplete="off" class="form-control value-attribute" required placeholder="Giá trị" oninput="renderTableAttribute()">
                        </div>

                        <div class="text-end">
                            <button onclick="_removeAttribute(this)" type="button" class="btn btn-danger"><i class="fa-solid fa-x"></i></button>
                        </div>
                    </div>
                </div>

            </div>`)

            getAll_attributes()
        }

        function addValueAttribute() {
            $('#container_infor__attributes').html('')

            $('#bassic_price').html(`<div class="p-3">

                <div class="card p-3">

                    <div class="text-end">
                        <button onclick="removeAllAttribute(this)" type="button" class="btn btn-danger"><i
                                class="fa-solid fa-x"></i></button>
                    </div>

                    <div class="d-flex mt-3">
                        <input type="text" autocomplete="off" class="form-control header-_attributes"  oninput="renderTableAttribute()"
                               placeholder="Thuộc tính" required>
                        <button type="button" onclick="addItemValueAttribute(this)" class="btn btn-success ms-1"
                                data-bs-original-title="" title=""><i class="fa-solid fa-plus"></i></button>
                    </div>

                    <div class="ms-3 mt-3 me-3 d-flex align-items-center">
                        <div class="d-flex mt-1">
                            <input type="text" autocomplete="off" class="form-control value-attribute" required
                                   placeholder="Giá trị" oninput="renderTableAttribute()">
                        </div>

                        <div class="text-end">
                            <button onclick="_removeAttribute(this)" type="button" class="btn btn-danger"><i class="fa-solid fa-x"></i></button>
                        </div>
                    </div>
                </div></div><div class="add-attibutes p-3">
                    <label>
                        Thêm thuộc tính
                    </label>
                    <button onclick="_addAttribute()" type="button" class="btn btn-outline-success"
                            data-bs-original-title="" title=""><i class="fa-solid fa-plus"></i></button>
                </div>`)

            getAll_attributes()
        }

        function removeValueAttribute(e) {
            const ele = $(e)
            ele.parent().remove()
        }

        function removeAllAttribute(e) {
            const ele = $(e)
            ele.parent().parent().parent().remove()

            getAll_attributes()

            renderTableAttribute()
        }

        function addItemValueAttribute(e) {
            $(e).parent().parent().append(`<div class="ms-3 mt-3 me-3 d-flex align-items-center">
                        <div class="d-flex mt-1">
                            <input type="text" autocomplete="off" class="form-control value-attribute" required
                                   placeholder="Giá trị" oninput="renderTableAttribute()">
                        </div>

                        <div class="text-end">
                            <button onclick="_removeAttribute(this)" type="button" class="btn btn-danger"><i class="fa-solid fa-x"></i></button>
                        </div>
                    </div>`)
        }

        function _removeAttribute(e) {
            $(e).parent().parent().remove()

            renderTableAttribute()
        }

        let _headers = []
        let _attributes = []

        function getAll_attributes() {

            _headers = []
            _attributes = []

            let p3s = document.querySelectorAll('#bassic_price > .p-3')

            for (let i = 0; i < p3s.length; i++) {
                const header = p3s[i].querySelector('.header-_attributes')

                if (!empty(header)) {
                    _headers.push(header.value)

                    const child__attributes = p3s[i].querySelectorAll('.value-attribute')

                    const value__attributes = []

                    for (let j = 0; j < child__attributes.length; j++) {
                        value__attributes.push(child__attributes[j].value)
                    }
                    _attributes.push(value__attributes)
                }
            }
            $('.add-attibutes').remove()

            if (_headers.length < 2) {
                $('#bassic_price').append(`<div class="add-attibutes">
                    <label>
                        Thêm thuộc tính
                    </label>
                    <button onclick="_addAttribute()" type="button" class="btn btn-outline-success"
                            data-bs-original-title="" title=""><i class="fa-solid fa-plus"></i></button>
                </div>`)
            }

            if (_headers.length == 0) {
                $('#price').show()
                $('#table_bassic_price').hide()
            } else {
                $('#price').hide()
                $('#table_bassic_price').show()
            }

        }

        function renderTableAttribute() {

            _headers = []
            _attributes = []

            let p3s = document.querySelectorAll('#bassic_price > .p-3')

            for (let i = 0; i < p3s.length; i++) {
                const header = p3s[i].querySelector('.header-_attributes')

                if (!empty(header)) {
                    _headers.push(header.value)

                    const child__attributes = p3s[i].querySelectorAll('.value-attribute')

                    const value__attributes = []

                    for (let j = 0; j < child__attributes.length; j++) {
                        value__attributes.push(child__attributes[j].value)
                    }
                    _attributes.push(value__attributes)
                }
            }

            console.log(_headers)
            console.log(_attributes)

            $('#_headers').val(JSON.stringify(_headers))
            $('#_attributes').val(JSON.stringify(_attributes))

            $('#table_bassic_price').html('')

            if (_headers.length == 1) {

                let header = `<div class="row mt-2">
                        <div class="col-4">
                            ${_headers[0]}
                        </div>
                        <div class="col-1">
                            Giá nhập
                        </div>
                        <div class="col-1">
                            Giá bán lẻ
                        </div>
                        <div class="col-1">
                            Giá bán buôn
                        </div>
                        <div class="col-1">
                            Giá CTV
                        </div>
                        <div class="col-2">
                            Kho hàng
                        </div>
                        <div class="col-2">
                            SKU
                        </div>
                    </div>`

                $('#table_bassic_price').append(header)

                for (let i = 0; i < _attributes[0].length; i++) {
                    let row = '<div class="row mt-2">'
                    row += `<div class="col-4">${_attributes[0][i]}</div>`
                    row += `<div class="col-1">
                            <input name="import_prices[]" type="text" autocomplete="off" class="form-control number" value="" required>
                        </div>
                        <div class="col-1">
                            <input name="client_prices[]" type="text" autocomplete="off" class="form-control number" value="" required>
                        </div>
                        <div class="col-1">
                            <input name="agent_prices[]" type="text" autocomplete="off" class="form-control number" value="" required>
                        </div>
                        <div class="col-1">
                            <input name="partner_prices[]" type="text" autocomplete="off" class="form-control number" value="" required>
                        </div>
                        <div class="col-2">
                            <input name="inventories[]" type="text" autocomplete="off" class="form-control number" value="" required>
                        </div>
                        <div class="col-2">
                            <input name="skus[]" type="text" autocomplete="off" class="form-control" value="">
                        </div>`

                    row += "</div>"

                    $('#table_bassic_price').append(row)
                }
            } else {
                let header = `<div class="row mt-2">
                        <div class="col-2">
                            ${_headers[0]}
                        </div>
                        <div class="col-2">
                            ${_headers[1]}
                        </div>
                        <div class="col-1">
                            Giá nhập
                        </div>
                        <div class="col-1">
                            Giá bán lẻ
                        </div>
                        <div class="col-1">
                            Giá bán buôn
                        </div>
                        <div class="col-1">
                            Giá CTV
                        </div>
                        <div class="col-2">
                            Kho hàng
                        </div>
                        <div class="col-2">
                            SKU
                        </div>
                    </div>`

                $('#table_bassic_price').append(header)

                for (let i = 0; i < _attributes[0].length; i++) {
                    for (let j = 0; j < _attributes[1].length; j++) {
                        let row = '<div class="row mt-2">'
                        row += `<div class="col-2">${_attributes[0][i]}</div>`
                        row += `<div class="col-2">${_attributes[1][j]}</div>`
                        row += `<div class="col-1">
                            <input name="import_prices[]" type="text" autocomplete="off" class="form-control number" value="" required>
                        </div>
                        <div class="col-1">
                            <input name="client_prices[]" type="text" autocomplete="off" class="form-control number" value="" required>
                        </div>
                        <div class="col-1">
                            <input name="agent_prices[]" type="text" autocomplete="off" class="form-control number" value="" required>
                        </div>
                        <div class="col-1">
                            <input name="partner_prices[]" type="text" autocomplete="off" class="form-control number" value="" required>
                        </div>
                        <div class="col-2">
                            <input name="inventories[]" type="text" autocomplete="off" class="form-control number" value="" required>
                        </div>
                        <div class="col-2">
                            <input name="skus[]" type="text" autocomplete="off" class="form-control" value="">
                        </div>`

                        row += "</div>"

                        $('#table_bassic_price').append(row)
                    }
                }
            }


        }
    </script>
@endsection

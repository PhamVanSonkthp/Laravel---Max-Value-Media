@extends('administrator.layouts.master')

@include('administrator.'.$prefixView.'.header')

@section('css')

    <style>
        .item-product {
            cursor: pointer;
            width: 100%;
        }

        .item-product:hover {
            background-color: aliceblue;
        }

    </style>

@endsection

@section('content')

    <div class="container-fluid list-products">
        <div class="row">

            <div class="col-md-6">

                <div class="card">
                    <div class="card-body">
                        <div class="form-group mt-3">
                            <label>Sản phẩm <span class="text-danger">*</span></label>
                            <input id="input_search_product" type="text" autocomplete="off" name="name"
                                   class="form-control " value="" oninput="onSearchProduct()"
                                   required="" data-bs-original-title="" title="" placeholder="Tên, code, id, sku, ...">
                        </div>

                        <div id="container_result_search">

                        </div>

                    </div>
                </div>
            </div>

            <div class="col-md-6">

                <div class="card">

                    <div class="card-header" style="display: flex;justify-content: space-between;">

                        <div class="mt-3">
                            Danh sách sản phẩm
                        </div>

                        <div>
                            @include('administrator.components.select2_allow_clear', ['label' => 'Khách hàng', 'name' => 'user_id' , 'select2Items' => \App\Models\User::where('is_admin', 0)->latest()->get()])
                        </div>
                    </div>

                    <div class="card-body">

                        <div class="table-responsive product-table">
                            <table class="table table-hover table-bordered">
                                <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Sản phẩm</th>
                                    <th>Thuộc tính</th>
                                    <th>Đơn giá</th>
                                    <th>Số lượng</th>
                                    <th>Tổng</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody id="container_products">

                                @foreach($item->products as $index => $product)
                                    <tr id="row_product_id_{{$product->product_id}}">

                                        <td class="index_product">{{$index + 1}}</td>

                                        <td>
                                            <input class="product_ids d-none" value="{{$product->product_id}}">
                                            {{\App\Models\Formatter::getShortDescriptionAttribute($product->name)}}
                                        </td>
                                        <td>
                                            @if(!empty($product->order_size) || !empty($product->order_color))
                                                <div>
                                                    Phân loại:
                                                    <strong>{{\App\Models\Formatter::getShortDescriptionAttribute($product->order_size)}}</strong>,
                                                    <strong>{{\App\Models\Formatter::getShortDescriptionAttribute($product->order_color)}}</strong>
                                                </div>
                                            @endif
                                        </td>

                                        <td id="price_product_{{$product->product_id}}">
                                            {{\App\Models\Formatter::formatMoney($product->price)}}
                                        </td>

                                        <td>
                                            <input id="input_number_product_{{$product->product_id}}" type="text" class="form-control number input_products quantities" value="{{$product->quantity}}" oninput="onChangeNumberProduct('{{$product->product_id}}')">
                                        </td>

                                        <td>
                                            <strong id="total_row_product_{{$product->product_id}}" class="prices">
                                                {{\App\Models\Formatter::formatMoney($product->price * $product->quantity)}}
                                            </strong>

                                        </td>
                                        <td>

                                            <a class="btn btn-outline-danger btn-sm" onclick="onDeleteProduct('row_product_id_{{$product->product_id}}')">
                                                <i class="fa-solid fa-x"></i>
                                            </a>

                                        </td>
                                    </tr>
                                @endforeach

                                </tbody>

                                <tbody id="container_voucher" style="{{$item->amount_voucher == 0 ? "display: none" : ""}}">
                                <tr>
                                    <td colspan="5">
                                        <strong class="text-danger">
                                            Mã giảm giá
                                        </strong>
                                    </td>

                                    <td class="text-end" colspan="2">
                                        <strong class="text-warning" id="label_amount_discount">
                                            {{\App\Models\Formatter::formatMoney($item->amount_voucher)}}
                                        </strong>
                                    </td>
                                </tr>
                                </tbody>

                                <tbody>
                                <tr>
                                    <td colspan="4">
                                        <strong class="text-danger">
                                            Tổng
                                        </strong>
                                    </td>
                                    <td class="text-end">
                                        <strong id="total_number">
                                            0
                                        </strong>
                                    </td>
                                    <td class="text-end" colspan="2">
                                        <strong class="text-danger" id="total_price">
                                            0
                                        </strong>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>

                    <div class="card-footer">

                        @include('administrator.components.require_input_number', ['label' => 'Phí vận chuyển', 'name' => 'shipping_fee' ])

                        <button class="btn btn-primary mt-3" onclick="onCreateOrder()">Lưu</button>

                    </div>
                </div>
            </div>

        </div>

    </div>

@endsection

@section('js')

    <script>

        let keywordSearch = "";
        let discount = {{$item->amount_voucher}};

        function onSearchProduct() {
            keywordSearch = $('#input_search_product').val()

            if (keywordSearch.length) {

                callAjax(
                    "GET",
                    "{{route('ajax.administrator.products.search')}}",
                    {
                        'search_query': keywordSearch,
                    },
                    (response) => {
                        if (keywordSearch) {
                            if (keywordSearch == response.search_query) {
                                $('#container_result_search').html(response.html)

                            }
                        } else {
                            $('#container_result_search').html("")
                        }
                    },
                    (error) => {

                    },
                    false,
                )

            } else {
                $('#container_result_search').html("")
            }
        }

        function renderSTT() {
            $('.index_product').each(function(i, obj) {
                $(obj).html(i + 1)
            });


        }

        function renderTotalPrice() {

            let totalNumberProduct = 0;
            let totalPriceProduct = 0;

            var ek=[];
            $('.prices').each(function() { ek.push($(this).html()); });


            $('.input_products').each(function(i, obj) {
                totalNumberProduct += tryParseInt($(obj).val())
                totalPriceProduct += tryParseInt(ek[i])
            });

            totalPriceProduct -= discount

            $('#total_number').html(totalNumberProduct)
            $('#total_price').html(formatMoney(totalPriceProduct) + "đ")
        }

        function onAddProduct(id, name, variation , price) {


            if ($('#row_product_id_' + id).html()){
                $('#input_number_product_' + id).val(tryParseInt($('#input_number_product_' + id).val()) + 1)

                onChangeNumberProduct(id)
            }else{
                $('#container_products').append(`<tr id="row_product_id_${id}">

                                    <td class="index_product">
                                        1
                                    </td>

                                    <td>
                                        <input class="product_ids d-none" value="${id}"/>
                                        ${name}
                                    </td>
                                    <td>
                                        ${variation}
                                    </td>

                                    <td id="price_product_${id}">
                                        ${formatMoney(price)}
                                    </td>

                                    <td>
                                        <input id="input_number_product_${id}" type="text" class="form-control input_products quantities" value="1" oninput="onChangeNumberProduct('${id}')">
                                    </td>

                                    <td>
                                        <strong id="total_row_product_${id}" class="prices">${formatMoney(price)}</strong>

                                    </td>
                                    <td>

                                        <a
                                           class="btn btn-outline-danger btn-sm" onclick="onDeleteProduct('row_product_id_${id}')">
                                            <i class="fa-solid fa-x"></i>
                                        </a>

                                    </td>
                                </tr>`)
            }



            renderSTT()
            renderTotalPrice()
        }

        function onDeleteProduct(id) {
            $('#' + id).remove()
            renderSTT()
            renderTotalPrice()
        }

        function onChangeNumberProduct(id) {
            const number = tryParseInt(getOnlyNumber($('#input_number_product_' + id).val()))

            $('#total_row_product_' + id).html(formatMoney(number * tryParseInt($('#price_product_' + id).html())))
            renderTotalPrice()
        }

        function onCreateOrder() {

            const product_ids = [];
            const quantities = [];

            $('.product_ids').each(function() {
                product_ids.push($(this).val());
            });

            $('.quantities').each(function() { quantities.push($(this).val()); });

            if (product_ids.length == 0) return showToastError("Vui lòng chọn sản phẩm")


            callAjax(
                "PUT",
                "{{route('ajax.administrator.orders.update')}}",
                {
                    id : "{{$item->id}}",
                    product_ids: product_ids,
                    quantities: quantities,
                    user_id: $('select[name="user_id"]').val(),
                    shipping_fee: $('input[name="shipping_fee"]').val(),
                },
                (response) => {

                    console.log(response)

                },
                (error) => {

                },
                true,
            )

        }

        renderSTT()
        renderTotalPrice()
    </script>

@endsection


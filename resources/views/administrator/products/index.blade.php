@extends('administrator.layouts.master')

@include('administrator.'.$prefixView.'.header')

@section('css')
    <style>

        .child-edit{
            cursor: pointer;
        }

        .child-edit:hover {
            .child-edit-hide{
                visibility: visible;
            }
        }

        .child-edit-hide{
            visibility: hidden;
        }
    </style>
@endsection

@section('content')

    <div class="container-fluid list-products">
        <div class="row">
            <!-- Individual column searching (text inputs) Starts-->
            <div class="col-12">

                <div class="card">

                    <div class="card-header">
                        @include('administrator.'.$prefixView.'.search')
                    </div>

                    <div class="card-body">

                        @include('administrator.components.checkbox_delete_table')

                        <div class="table-responsive product-table">
                            <table class="table table-hover table-bordered">
                                <thead>
                                <tr>
                                    <th><input id="check_box_delete_all" type="checkbox" class="checkbox-parent"
                                               onclick="onSelectCheckboxDeleteItem()"></th>
{{--                                    <th style="width: 0%;">#</th>--}}
                                    <th>Tên sản phẩm</th>
                                    <th>Doanh số</th>
                                    <th>Giá</th>
                                    <th>Kho hàng</th>
                                    <th>Hành động</th>
                                </tr>
                                </thead>
                                <tbody class="" id="body_container_item">
                                @foreach($items as $index => $item)
                                    @include('administrator.'.$prefixView.'.row', ['item' => $item, 'index' => $index])
                                @endforeach

                                </tbody>

                                <tfoot>
                                <tr>
                                    <th><input id="check_box_delete_all_footer" type="checkbox" class="checkbox-parent" onclick="onSelectCheckboxDeleteItemFooter()"></th>
{{--                                    <th style="width: 0%;">#</th>--}}
                                    <th>Tên sản phẩm</th>
                                    <th>Doanh số</th>
                                    <th>Giá</th>
                                    <th>Kho hàng</th>
                                    <th>Hành động</th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                        <div>
                            @include('administrator.components.footer_table')
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="model_change_inventory" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Cập nhật kho hàng</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="container_inventory_sku">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                    <button type="button" class="btn btn-primary" onclick="onUpdateInventory()">Cập nhật</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="model_change_price" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Cập nhật giá</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="container_price_sku">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                    <button type="button" class="btn btn-primary" onclick="onUpdatePrice()">Cập nhật</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')
    <script>

        let current_product_id;

        function onEditInventory(id) {
            current_product_id = id;

            callAjax(
                "GET",
                "{{route('ajax.administrator.products.render_container_inventory')}}",
                {
                    id: id,
                },
                (response) => {

                    $('#container_inventory_sku').html(response.html)
                    showModal('model_change_inventory')

                    // showToastSuccess()

                },
                (error) => {

                },
                true,
            )
        }

        function onEditPrice(id) {
            current_product_id = id;

            callAjax(
                "GET",
                "{{route('ajax.administrator.products.render_container_price')}}",
                {
                    id: id,
                },
                (response) => {

                    $('#container_price_sku').html(response.html)
                    showModal('model_change_price')

                    // showToastSuccess()

                },
                (error) => {

                },
                true,
            )
        }

        function onUpdateInventory() {
            const sku_inventory_ids = []
            const sku_inventory_values = []

            $('.sku-inventory-ids').each(function() {
                sku_inventory_ids.push($(this).val());
            });

            $('.sku-inventory-values').each(function() {
                sku_inventory_values.push($(this).val());
            });


            callAjax(
                "PUT",
                "{{route('ajax.administrator.products.update_inventory')}}",
                {
                    product_id: current_product_id,
                    index: $('#tr_container_index_' + current_product_id).data('id'),
                    skus: sku_inventory_ids,
                    values: sku_inventory_values,
                },
                (response) => {
                    hideModal('model_change_inventory')
                    showToastSuccess()
                    $('.tr_container_index_' + current_product_id).remove()
                    $('#tr_container_index_' + current_product_id).after(response.html).remove();
                },
                (error) => {

                },
                true,
            )

        }

        function onUpdatePrice() {
            const sku_price_ids = []
            const sku_price_values = []

            $('.sku-price-ids').each(function() {
                sku_price_ids.push($(this).val());
            });

            $('.sku-price-values').each(function() {
                sku_price_values.push($(this).val());
            });


            callAjax(
                "PUT",
                "{{route('ajax.administrator.products.update_price')}}",
                {
                    product_id: current_product_id,
                    index: $('#tr_container_index_' + current_product_id).data('id'),
                    skus: sku_price_ids,
                    values: sku_price_values,
                },
                (response) => {
                    hideModal('model_change_price')
                    showToastSuccess()
                    $('.tr_container_index_' + current_product_id).remove()
                    $('#tr_container_index_' + current_product_id).after(response.html).remove();
                },
                (error) => {

                },
                true,
            )

        }

        function onChangeInventoryAllInput() {
            const val = tryParseInt($('#input_set_all_inventory').val())

            $('.sku-inventory-values').val(val)
        }

        function onChangePriceAllInput() {
            const val = tryParseInt($('#input_set_all_price').val())

            $('.sku-price-values').val(val)
        }

        function onShowMoreVariant(id) {
            $('.variant-' + id).removeClass('d-none')
            $('#btn_show_more_' + id).addClass('d-none')
            $('#btn_show_less_' + id).removeClass('d-none')
        }

        function onShowLessVariant(id) {
            $('.variant-' + id).addClass('d-none')
            $('#btn_show_more_' + id).removeClass('d-none')
            $('#btn_show_less_' + id).addClass('d-none')
        }
    </script>


@endsection


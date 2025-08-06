@extends('administrator.layouts.master')

@include('administrator.'.$prefixView.'.header')

@section('css')

@endsection

@section('content')

    <div class="container-fluid list-products">
        <div class="row">
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
                                    <th onclick='onSortSearch(`id`, `{{ \App\Models\Helper::getValueInFilterReuquest('id') == "" ? "asc" : (\App\Models\Helper::getValueInFilterReuquest('id') != "desc" ? "desc" : "") }}`)'>
                                        <div>
                                            # {!! \App\Models\Helper::getValueInFilterReuquest('id') == "" ? '<i class="fa-solid fa-sort"></i>' : (\App\Models\Helper::getValueInFilterReuquest('id') != "desc" ? '<i class="fa-solid fa-arrow-up-a-z text-success"></i>' : '<i class="fa-solid fa-arrow-down-z-a text-danger"></i>') !!}
                                        </div>
                                    </th>
                                    <th>Khách hàng</th>
                                    <th>Sản phẩm</th>
                                    <th>Voucher</th>
                                    <th>Phương thức giao hàng</th>
                                    <th>Phương thức thanh toán</th>
                                    <th>Tổng tiền</th>
                                    <th>Trạng thái</th>
                                    <th onclick='onSortSearch(`created_by_id`, `{{ \App\Models\Helper::getValueInFilterReuquest('created_by_id') == "" ? "asc" : (\App\Models\Helper::getValueInFilterReuquest('created_by_id') != "desc" ? "desc" : "") }}`)'>
                                        <div>
                                            Tạo bởi {!! \App\Models\Helper::getValueInFilterReuquest('created_by_id') == "" ? '<i class="fa-solid fa-sort"></i>' : (\App\Models\Helper::getValueInFilterReuquest('created_by_id') != "desc" ? '<i class="fa-solid fa-arrow-up-a-z text-success"></i>' : '<i class="fa-solid fa-arrow-down-z-a text-danger"></i>') !!}
                                        </div>
                                    </th>
                                    <th onclick='onSortSearch(`created_at`, `{{ \App\Models\Helper::getValueInFilterReuquest('created_at') == "" ? "asc" : (\App\Models\Helper::getValueInFilterReuquest('created_at') != "desc" ? "desc" : "") }}`)'>
                                        <div>
                                            Thời gian tạo {!! \App\Models\Helper::getValueInFilterReuquest('created_at') == "" ? '<i class="fa-solid fa-sort"></i>' : (\App\Models\Helper::getValueInFilterReuquest('created_at') != "desc" ? '<i class="fa-solid fa-arrow-up-a-z text-success"></i>' : '<i class="fa-solid fa-arrow-down-z-a text-danger"></i>') !!}
                                        </div>
                                    </th>
                                    <th>Hành động</th>
                                </tr>
                                </thead>
                                <tbody class="" id="body_container_item">
                                @foreach($items as $item)

                                    @include('administrator.orders.row' , ['item' => $item])

                                @endforeach

                                </tbody>

                                <tfoot>
                                <tr>
                                    <th><input id="check_box_delete_all_footer" type="checkbox" class="checkbox-parent" onclick="onSelectCheckboxDeleteItemFooter()"></th>
                                    <th onclick='onSortSearch(`id`, `{{ \App\Models\Helper::getValueInFilterReuquest('id') == "" ? "asc" : (\App\Models\Helper::getValueInFilterReuquest('id') != "desc" ? "desc" : "") }}`)'>
                                        <div>
                                            # {!! \App\Models\Helper::getValueInFilterReuquest('id') == "" ? '<i class="fa-solid fa-sort"></i>' : (\App\Models\Helper::getValueInFilterReuquest('id') != "desc" ? '<i class="fa-solid fa-arrow-up-a-z text-success"></i>' : '<i class="fa-solid fa-arrow-down-z-a text-danger"></i>') !!}
                                        </div>
                                    </th>
                                    <th>Khách hàng</th>
                                    <th>Sản phẩm</th>
                                    <th>Voucher</th>
                                    <th>Phương thức giao hàng</th>
                                    <th>Phương thức thanh toán</th>
                                    <th>Tổng tiền</th>
                                    <th>Trạng thái</th>

                                    <th onclick='onSortSearch(`created_by_id`, `{{ \App\Models\Helper::getValueInFilterReuquest('created_by_id') == "" ? "asc" : (\App\Models\Helper::getValueInFilterReuquest('created_by_id') != "desc" ? "desc" : "") }}`)'>
                                        <div>
                                            Tạo bởi {!! \App\Models\Helper::getValueInFilterReuquest('created_by_id') == "" ? '<i class="fa-solid fa-sort"></i>' : (\App\Models\Helper::getValueInFilterReuquest('created_by_id') != "desc" ? '<i class="fa-solid fa-arrow-up-a-z text-success"></i>' : '<i class="fa-solid fa-arrow-down-z-a text-danger"></i>') !!}
                                        </div>
                                    </th>
                                    <th onclick='onSortSearch(`created_at`, `{{ \App\Models\Helper::getValueInFilterReuquest('created_at') == "" ? "asc" : (\App\Models\Helper::getValueInFilterReuquest('created_at') != "desc" ? "desc" : "") }}`)'>
                                        <div>
                                            Thời gian tạo {!! \App\Models\Helper::getValueInFilterReuquest('created_at') == "" ? '<i class="fa-solid fa-sort"></i>' : (\App\Models\Helper::getValueInFilterReuquest('created_at') != "desc" ? '<i class="fa-solid fa-arrow-up-a-z text-success"></i>' : '<i class="fa-solid fa-arrow-down-z-a text-danger"></i>') !!}
                                        </div>
                                    </th>
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

@endsection

@section('js')
    <script>
        function onReadyShip(id) {

            callAjax(
                "PUT",
                "{{route('ajax.administrator.orders.update_to_shipping')}}",
                {
                    id: id
                },
                (response) => {
                    $('#row_' + id).after(response.html).remove();
                },
                (error) => {

                },
                false,
            )

        }
    </script>
@endsection


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
                                    <th><input id="check_box_delete_all" type="checkbox" class="checkbox-parent" onclick="onSelectCheckboxDeleteItem()"></th>
                                    <th>#</th>
                                    <th>Tiêu đề</th>
                                    <th>Hình ảnh</th>
                                    <th>Danh mục</th>
                                    <th>Thời gian tạo</th>
                                    <th>Hành động</th>
                                </tr>
                                </thead>
                                <tbody class="" id="body_container_item">
                                @foreach($items as $index => $item)
                                    @include('administrator.'.$prefixView.'.row', ['item' => $item, 'prefixView' => $prefixView, 'index' => $index])
                                @endforeach

                                </tbody>

                                <tfoot>
                                <tr>
                                    <th><input id="check_box_delete_all_footer" type="checkbox" class="checkbox-parent" onclick="onSelectCheckboxDeleteItemFooter()"></th>
                                    <th>#</th>
                                    <th>Tiêu đề</th>
                                    <th>Hình ảnh</th>
                                    <th>Danh mục</th>
                                    <th>Thời gian tạo</th>
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

@endsection


@extends('administrator.layouts.master')

@include('administrator.'.$prefixView.'.header')

@section('css')

@endsection

@section('content')

    <div class="container-fluid list-products">

        <form action="{{route('administrator.'.$prefixView.'.update', ['id'=> $item->id]) }}" method="post"
              enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="row">
                <div class="col-xxl-6">
                    <div class="card">
                        <div class="card-body">
                            @include('administrator.components.require_input_text' , ['name' => 'name' , 'label' => 'Tên'])

                            @include('administrator.components.require_input_datetime' , ['name' => 'begin' , 'label' => 'Ngày bắt đầu'])

                            @include('administrator.components.require_input_datetime' , ['name' => 'end' , 'label' => 'Ngày kết thúc'])

                            @include('administrator.components.require_check_box' , ['name' => 'is_active' , 'label' => 'Hoạt động?'])

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

                            {{--                            @include('administrator.components.textarea_description', ['name' => 'description' , 'label' => 'Mô tả'])--}}

                            @include('administrator.components.button_save')
                        </div>
                    </div>
                </div>

                <div class="col-md-6">

                    <div class="card">

                        <div class="card-header">
                            <div class="form-group mt-3">
                                <label>Sản phẩm <span class="text-danger">*</span></label>
                                <input id="input_search_product" type="text" autocomplete="off" name="names"
                                       class="form-control " value="" oninput="onSearchProduct()"
                                       data-bs-original-title="" title="" placeholder="Tên, code, id, sku, ...">
                            </div>

                            <div id="container_result_search">

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

                                    </tbody>

                                    <tbody id="container_voucher" style="display: none">
                                    <tr>
                                        <td colspan="5">
                                            <strong class="text-danger">
                                                Mã giảm giá
                                            </strong>
                                        </td>

                                        <td class="text-end" colspan="2">
                                            <strong class="text-warning" id="label_amount_discount">
                                                0
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
                    </div>
                </div>

            </div>
        </form>

    </div>
@endsection

@section('js')

@endsection

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
                                    <th onclick='onSortSearch(`id`, `{{ \App\Models\Helper::getValueInFilterReuquest('id') == "" ? "asc" : (\App\Models\Helper::getValueInFilterReuquest('id') != "desc" ? "desc" : "") }}`)'>
                                        <div>
                                            # {!! \App\Models\Helper::getValueInFilterReuquest('id') == "" ? '<i class="fa-solid fa-sort"></i>' : (\App\Models\Helper::getValueInFilterReuquest('id') != "desc" ? '<i class="fa-solid fa-arrow-up-a-z text-success"></i>' : '<i class="fa-solid fa-arrow-down-z-a text-danger"></i>') !!}
                                        </div>
                                    </th>
                                    <th>Khách hàng</th>
                                    <th>Sản phẩm</th>
                                    <th>Nội dung</th>
                                    <th>Số sao</th>
                                    <th>Hình ảnh</th>
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
                                    @include('administrator.product_comments.row', ['item' => $item, 'prefixView' => $prefixView])
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
                                    <th>Nội dung</th>
                                    <th>Số sao</th>
                                    <th>Hình ảnh</th>
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

    <!-- Modal -->
    <div class="modal fade" id="editStatus" tabindex="-1" aria-labelledby="editStatusLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="editStatusLabel">Change status</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="mt-3">
                        <label class="bold">Status @include('administrator.components.lable_require')</label>
                        <select name="select_product_comment_status_id" class="form-control select2_init" required>
                            @foreach(\App\Models\ProductCommentStatus::all() as $itemProductCommentStatus)
                                <option value="{{$itemProductCommentStatus->id}}">{{$itemProductCommentStatus->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="modal-footer justify-content-center">
                    <button type="button" onclick="onSubmitChangeStatus()" class="btn btn-info">Update now</button>
                </div>

            </div>
        </div>
    </div>

@endsection

@section('js')
    <script>

        let edited_id;

        function onEditStatus(id, id_status) {
            edited_id = id

            $('select[name="select_product_comment_status_id"]').val(id_status).change()
        }

        function onSubmitChangeStatus() {
            $.ajax({
                type: "PUT",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                cache: false,
                data: {
                    id: edited_id,
                    product_comment_status_id: $('select[name="select_product_comment_status_id"]').val(),
                },
                url: "{{route('ajax.administrator.product_comments.update')}}",
                beforeSend: function () {
                    showLoading()
                },
                success: function (response) {
                    hideModal('editStatus')
                    hideLoading()
                    $('#container_row_' + edited_id).after(response.html).remove()
                },
                error: function (err) {
                    hideLoading()
                    Swal.fire(
                        {
                            icon: 'error',
                            title: err.responseText,
                        }
                    );
                    console.log(err)
                },
            });
        }

    </script>
@endsection


@extends('administrator.layouts.master')

@include('administrator.'.$prefixView.'.header')

@section('css')
    <style>
        #qrcode > img {
            width: 110px;
        }

        /*.scroller::-webkit-scrollbar {*/
        /*    width: 5px;*/
        /*}*/

    </style>
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

                        <div class="table-responsive product-table ">
                            <table class="table table-hover table-bordered">
                                <thead>
                                <tr>
                                    <th>Mã GD</th>
                                    <th>Tài khoản</th>
                                    <th>Số điểm</th>
                                    <th>Nội dung</th>
                                    <th onclick='onSortSearch(`created_at`, `{{ \App\Models\Helper::getValueInFilterReuquest('created_at') == "" ? "asc" : (\App\Models\Helper::getValueInFilterReuquest('created_at') != "desc" ? "desc" : "") }}`)'>
                                        <div>
                                            Thời gian tạo {!! \App\Models\Helper::getValueInFilterReuquest('created_at') == "" ? '<i class="fa-solid fa-sort"></i>' : (\App\Models\Helper::getValueInFilterReuquest('created_at') != "desc" ? '<i class="fa-solid fa-arrow-up-a-z text-success"></i>' : '<i class="fa-solid fa-arrow-down-z-a text-danger"></i>') !!}
                                        </div>
                                    </th>
                                </tr>
                                </thead>

                                <tbody id="container_row">

                                @foreach($items as $item)
                                    @include('administrator.user_points.row', compact('item'))
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>Mã GD</th>
                                    <th>Tài khoản</th>
                                    <th>Số điểm</th>
                                    <th>Nội dung</th>
                                    <th onclick='onSortSearch(`created_at`, `{{ \App\Models\Helper::getValueInFilterReuquest('created_at') == "" ? "asc" : (\App\Models\Helper::getValueInFilterReuquest('created_at') != "desc" ? "desc" : "") }}`)'>
                                        <div>
                                            Thời gian tạo {!! \App\Models\Helper::getValueInFilterReuquest('created_at') == "" ? '<i class="fa-solid fa-sort"></i>' : (\App\Models\Helper::getValueInFilterReuquest('created_at') != "desc" ? '<i class="fa-solid fa-arrow-up-a-z text-success"></i>' : '<i class="fa-solid fa-arrow-down-z-a text-danger"></i>') !!}
                                        </div>
                                    </th>
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
    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="createModalLabel">Tạo giao dịch điểm</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mt-3">
                        <label>Khách hàng</label>
                        <select id="user_id" class="form-control">
                            @foreach($users as $itemUser)
                                <option
                                    value="{{$itemUser->id}}" {{request('user_id') == $itemUser->id ? 'selected' : ''}}>
                                    #{{$itemUser->id}} - {{$itemUser->name}} - {{$itemUser->email}}
                                    - {{$itemUser->phone}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mt-3">
                        <label>Số tiền @include('administrator.components.lable_require')</label>
                        <input id="amount" type="text" class="form-control number" autocomplete="off">
                        <i>(* Để trừ điểm hãy nhập số âm: -100.000)</i>
                    </div>

                    <div class="mt-3">
                        <label class="form-label">Nội dung</label>
                        <textarea id="description" class="form-control" rows="5"></textarea>
                    </div>

                </div>

                <div class="modal-footer">
                    <div class="text-end">
                        <button onclick="onSubmitAddTransaction()" class="btn btn-outline-success">Xác nhận
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection

@section('js')

    <script>

        let id_edited;

        function onEditModal(id) {
            id_edited = id;
        }

        function onSubmitAddTransaction() {
            callAjax(
                "POST",
                "{{route('ajax.administrator.user_points.store')}}",
                {
                    user_id: $('#user_id').val(),
                    amount: $('#amount').val(),
                    description: $('#description').val(),
                },
                (response) => {
                    console.log(response)
                    $('#container_row').prepend(response.html_row)
                    hideModal('createModal')
                },
                (error) => {

                },
                true,
            )
        }

        $(document).ready(function () {
            $("#user_id").select2({
                dropdownParent: $("#createModal")
            });
        });

    </script>
@endsection


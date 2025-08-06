@extends('administrator.layouts.master')

@include('administrator.'.$prefixView.'.header')

@section('css')

@endsection

@section('content')

    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="row">
            <!-- Individual column searching (text inputs) Starts-->
            <div class="col-sm-12">
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
                                    <th>Avatar</th>
                                    <th onclick='onSortSearch(`name`, `{{ \App\Models\Helper::getValueInFilterReuquest('name') == "" ? "asc" : (\App\Models\Helper::getValueInFilterReuquest('name') != "desc" ? "desc" : "") }}`)'>
                                        <div>
                                            Tên KH {!! \App\Models\Helper::getValueInFilterReuquest('name') == "" ? '<i class="fa-solid fa-sort"></i>' : (\App\Models\Helper::getValueInFilterReuquest('name') != "desc" ? '<i class="fa-solid fa-arrow-up-a-z text-success"></i>' : '<i class="fa-solid fa-arrow-down-z-a text-danger"></i>') !!}
                                        </div>
                                    </th>
                                    <th onclick='onSortSearch(`phone`, `{{ \App\Models\Helper::getValueInFilterReuquest('phone') == "" ? "asc" : (\App\Models\Helper::getValueInFilterReuquest('phone') != "desc" ? "desc" : "") }}`)'>
                                        <div>
                                            Số điện thoại {!! \App\Models\Helper::getValueInFilterReuquest('phone') == "" ? '<i class="fa-solid fa-sort"></i>' : (\App\Models\Helper::getValueInFilterReuquest('phone') != "desc" ? '<i class="fa-solid fa-arrow-up-a-z text-success"></i>' : '<i class="fa-solid fa-arrow-down-z-a text-danger"></i>') !!}
                                        </div>
                                    </th>
                                    <th onclick='onSortSearch(`email`, `{{ \App\Models\Helper::getValueInFilterReuquest('email') == "" ? "asc" : (\App\Models\Helper::getValueInFilterReuquest('email') != "desc" ? "desc" : "") }}`)'>
                                        <div>
                                            Email {!! \App\Models\Helper::getValueInFilterReuquest('email') == "" ? '<i class="fa-solid fa-sort"></i>' : (\App\Models\Helper::getValueInFilterReuquest('email') != "desc" ? '<i class="fa-solid fa-arrow-up-a-z text-success"></i>' : '<i class="fa-solid fa-arrow-down-z-a text-danger"></i>') !!}
                                        </div>
                                    </th>
                                    <th onclick='onSortSearch(`date_of_birth`, `{{ \App\Models\Helper::getValueInFilterReuquest('date_of_birth') == "" ? "asc" : (\App\Models\Helper::getValueInFilterReuquest('date_of_birth') != "desc" ? "desc" : "") }}`)'>
                                        <div>
                                            Ngày sinh {!! \App\Models\Helper::getValueInFilterReuquest('date_of_birth') == "" ? '<i class="fa-solid fa-sort"></i>' : (\App\Models\Helper::getValueInFilterReuquest('date_of_birth') != "desc" ? '<i class="fa-solid fa-arrow-up-a-z text-success"></i>' : '<i class="fa-solid fa-arrow-down-z-a text-danger"></i>') !!}
                                        </div>
                                    </th>
                                    <th onclick='onSortSearch(`amount`, `{{ \App\Models\Helper::getValueInFilterReuquest('amount') == "" ? "asc" : (\App\Models\Helper::getValueInFilterReuquest('amount') != "desc" ? "desc" : "") }}`)'>
                                        <div>
                                            Số dư {!! \App\Models\Helper::getValueInFilterReuquest('amount') == "" ? '<i class="fa-solid fa-sort"></i>' : (\App\Models\Helper::getValueInFilterReuquest('amount') != "desc" ? '<i class="fa-solid fa-arrow-up-a-z text-success"></i>' : '<i class="fa-solid fa-arrow-down-z-a text-danger"></i>') !!}
                                        </div>
                                    </th>
                                    <th onclick='onSortSearch(`point`, `{{ \App\Models\Helper::getValueInFilterReuquest('point') == "" ? "asc" : (\App\Models\Helper::getValueInFilterReuquest('point') != "desc" ? "desc" : "") }}`)'>
                                        <div>
                                            Điểm {!! \App\Models\Helper::getValueInFilterReuquest('point') == "" ? '<i class="fa-solid fa-sort"></i>' : (\App\Models\Helper::getValueInFilterReuquest('point') != "desc" ? '<i class="fa-solid fa-arrow-up-a-z text-success"></i>' : '<i class="fa-solid fa-arrow-down-z-a text-danger"></i>') !!}
                                        </div>
                                    </th>
                                    <th onclick='onSortSearch(`user_type_id`, `{{ \App\Models\Helper::getValueInFilterReuquest('user_type_id') == "" ? "asc" : (\App\Models\Helper::getValueInFilterReuquest('user_type_id') != "desc" ? "desc" : "") }}`)'>
                                        <div>
                                            Loại {!! \App\Models\Helper::getValueInFilterReuquest('user_type_id') == "" ? '<i class="fa-solid fa-sort"></i>' : (\App\Models\Helper::getValueInFilterReuquest('user_type_id') != "desc" ? '<i class="fa-solid fa-arrow-up-a-z text-success"></i>' : '<i class="fa-solid fa-arrow-down-z-a text-danger"></i>') !!}
                                        </div>
                                    </th>
                                    <th onclick='onSortSearch(`user_status_id`, `{{ \App\Models\Helper::getValueInFilterReuquest('user_status_id') == "" ? "asc" : (\App\Models\Helper::getValueInFilterReuquest('user_status_id') != "desc" ? "desc" : "") }}`)'>
                                        <div>
                                            Trạng thái {!! \App\Models\Helper::getValueInFilterReuquest('user_status_id') == "" ? '<i class="fa-solid fa-sort"></i>' : (\App\Models\Helper::getValueInFilterReuquest('user_status_id') != "desc" ? '<i class="fa-solid fa-arrow-up-a-z text-success"></i>' : '<i class="fa-solid fa-arrow-down-z-a text-danger"></i>') !!}
                                        </div>
                                    </th>
                                    <th onclick='onSortSearch(`last_seen`, `{{ \App\Models\Helper::getValueInFilterReuquest('last_seen') == "" ? "asc" : (\App\Models\Helper::getValueInFilterReuquest('last_seen') != "desc" ? "desc" : "") }}`)'>
                                        <div>
                                            Hoạt động gần đây {!! \App\Models\Helper::getValueInFilterReuquest('last_seen') == "" ? '<i class="fa-solid fa-sort"></i>' : (\App\Models\Helper::getValueInFilterReuquest('last_seen') != "desc" ? '<i class="fa-solid fa-arrow-up-a-z text-success"></i>' : '<i class="fa-solid fa-arrow-down-z-a text-danger"></i>') !!}
                                        </div>
                                    </th>
                                    <th onclick='onSortSearch(`created_by_id`, `{{ \App\Models\Helper::getValueInFilterReuquest('created_by_id') == "" ? "asc" : (\App\Models\Helper::getValueInFilterReuquest('created_by_id') != "desc" ? "desc" : "") }}`)'>
                                        <div>
                                            Tạo bởi {!! \App\Models\Helper::getValueInFilterReuquest('created_by_id') == "" ? '<i class="fa-solid fa-sort"></i>' : (\App\Models\Helper::getValueInFilterReuquest('created_by_id') != "desc" ? '<i class="fa-solid fa-arrow-up-a-z text-success"></i>' : '<i class="fa-solid fa-arrow-down-z-a text-danger"></i>') !!}
                                        </div>
                                    </th>
                                    <th onclick='onSortSearch(`created_at`, `{{ \App\Models\Helper::getValueInFilterReuquest('created_at') == "" ? "asc" : (\App\Models\Helper::getValueInFilterReuquest('created_at') != "desc" ? "desc" : "") }}`)'>
                                        <div>
                                            Ngày sử dụng {!! \App\Models\Helper::getValueInFilterReuquest('created_at') == "" ? '<i class="fa-solid fa-sort"></i>' : (\App\Models\Helper::getValueInFilterReuquest('created_at') != "desc" ? '<i class="fa-solid fa-arrow-up-a-z text-success"></i>' : '<i class="fa-solid fa-arrow-down-z-a text-danger"></i>') !!}
                                        </div>
                                    </th>
                                    <th>Hành động</th>
                                </tr>
                                </thead>
                                <tbody class="" id="body_container_item">

                                @foreach($items as $item)

                                    @include('administrator.users.row', compact('item'))

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
                                    <th>Avatar</th>
                                    <th onclick='onSortSearch(`name`, `{{ \App\Models\Helper::getValueInFilterReuquest('name') == "" ? "asc" : (\App\Models\Helper::getValueInFilterReuquest('name') != "desc" ? "desc" : "") }}`)'>
                                        <div>
                                            Tên KH {!! \App\Models\Helper::getValueInFilterReuquest('name') == "" ? '<i class="fa-solid fa-sort"></i>' : (\App\Models\Helper::getValueInFilterReuquest('name') != "desc" ? '<i class="fa-solid fa-arrow-up-a-z text-success"></i>' : '<i class="fa-solid fa-arrow-down-z-a text-danger"></i>') !!}
                                        </div>
                                    </th>
                                    <th onclick='onSortSearch(`phone`, `{{ \App\Models\Helper::getValueInFilterReuquest('phone') == "" ? "asc" : (\App\Models\Helper::getValueInFilterReuquest('phone') != "desc" ? "desc" : "") }}`)'>
                                        <div>
                                            Số điện thoại {!! \App\Models\Helper::getValueInFilterReuquest('phone') == "" ? '<i class="fa-solid fa-sort"></i>' : (\App\Models\Helper::getValueInFilterReuquest('phone') != "desc" ? '<i class="fa-solid fa-arrow-up-a-z text-success"></i>' : '<i class="fa-solid fa-arrow-down-z-a text-danger"></i>') !!}
                                        </div>
                                    </th>
                                    <th onclick='onSortSearch(`email`, `{{ \App\Models\Helper::getValueInFilterReuquest('email') == "" ? "asc" : (\App\Models\Helper::getValueInFilterReuquest('email') != "desc" ? "desc" : "") }}`)'>
                                        <div>
                                            Email {!! \App\Models\Helper::getValueInFilterReuquest('email') == "" ? '<i class="fa-solid fa-sort"></i>' : (\App\Models\Helper::getValueInFilterReuquest('email') != "desc" ? '<i class="fa-solid fa-arrow-up-a-z text-success"></i>' : '<i class="fa-solid fa-arrow-down-z-a text-danger"></i>') !!}
                                        </div>
                                    </th>
                                    <th onclick='onSortSearch(`date_of_birth`, `{{ \App\Models\Helper::getValueInFilterReuquest('date_of_birth') == "" ? "asc" : (\App\Models\Helper::getValueInFilterReuquest('date_of_birth') != "desc" ? "desc" : "") }}`)'>
                                        <div>
                                            Ngày sinh {!! \App\Models\Helper::getValueInFilterReuquest('date_of_birth') == "" ? '<i class="fa-solid fa-sort"></i>' : (\App\Models\Helper::getValueInFilterReuquest('date_of_birth') != "desc" ? '<i class="fa-solid fa-arrow-up-a-z text-success"></i>' : '<i class="fa-solid fa-arrow-down-z-a text-danger"></i>') !!}
                                        </div>
                                    </th>
                                    <th onclick='onSortSearch(`amount`, `{{ \App\Models\Helper::getValueInFilterReuquest('amount') == "" ? "asc" : (\App\Models\Helper::getValueInFilterReuquest('amount') != "desc" ? "desc" : "") }}`)'>
                                        <div>
                                            Số dư {!! \App\Models\Helper::getValueInFilterReuquest('amount') == "" ? '<i class="fa-solid fa-sort"></i>' : (\App\Models\Helper::getValueInFilterReuquest('amount') != "desc" ? '<i class="fa-solid fa-arrow-up-a-z text-success"></i>' : '<i class="fa-solid fa-arrow-down-z-a text-danger"></i>') !!}
                                        </div>
                                    </th>
                                    <th onclick='onSortSearch(`point`, `{{ \App\Models\Helper::getValueInFilterReuquest('point') == "" ? "asc" : (\App\Models\Helper::getValueInFilterReuquest('point') != "desc" ? "desc" : "") }}`)'>
                                        <div>
                                            Điểm {!! \App\Models\Helper::getValueInFilterReuquest('point') == "" ? '<i class="fa-solid fa-sort"></i>' : (\App\Models\Helper::getValueInFilterReuquest('point') != "desc" ? '<i class="fa-solid fa-arrow-up-a-z text-success"></i>' : '<i class="fa-solid fa-arrow-down-z-a text-danger"></i>') !!}
                                        </div>
                                    </th>
                                    <th onclick='onSortSearch(`user_type_id`, `{{ \App\Models\Helper::getValueInFilterReuquest('user_type_id') == "" ? "asc" : (\App\Models\Helper::getValueInFilterReuquest('user_type_id') != "desc" ? "desc" : "") }}`)'>
                                        <div>
                                            Loại {!! \App\Models\Helper::getValueInFilterReuquest('user_type_id') == "" ? '<i class="fa-solid fa-sort"></i>' : (\App\Models\Helper::getValueInFilterReuquest('user_type_id') != "desc" ? '<i class="fa-solid fa-arrow-up-a-z text-success"></i>' : '<i class="fa-solid fa-arrow-down-z-a text-danger"></i>') !!}
                                        </div>
                                    </th>
                                    <th onclick='onSortSearch(`user_status_id`, `{{ \App\Models\Helper::getValueInFilterReuquest('user_status_id') == "" ? "asc" : (\App\Models\Helper::getValueInFilterReuquest('user_status_id') != "desc" ? "desc" : "") }}`)'>
                                        <div>
                                            Trạng thái {!! \App\Models\Helper::getValueInFilterReuquest('user_status_id') == "" ? '<i class="fa-solid fa-sort"></i>' : (\App\Models\Helper::getValueInFilterReuquest('user_status_id') != "desc" ? '<i class="fa-solid fa-arrow-up-a-z text-success"></i>' : '<i class="fa-solid fa-arrow-down-z-a text-danger"></i>') !!}
                                        </div>
                                    </th>
                                    <th onclick='onSortSearch(`last_seen`, `{{ \App\Models\Helper::getValueInFilterReuquest('last_seen') == "" ? "asc" : (\App\Models\Helper::getValueInFilterReuquest('last_seen') != "desc" ? "desc" : "") }}`)'>
                                        <div>
                                            Hoạt động gần đây {!! \App\Models\Helper::getValueInFilterReuquest('last_seen') == "" ? '<i class="fa-solid fa-sort"></i>' : (\App\Models\Helper::getValueInFilterReuquest('last_seen') != "desc" ? '<i class="fa-solid fa-arrow-up-a-z text-success"></i>' : '<i class="fa-solid fa-arrow-down-z-a text-danger"></i>') !!}
                                        </div>
                                    </th>
                                    <th onclick='onSortSearch(`created_by_id`, `{{ \App\Models\Helper::getValueInFilterReuquest('created_by_id') == "" ? "asc" : (\App\Models\Helper::getValueInFilterReuquest('created_by_id') != "desc" ? "desc" : "") }}`)'>
                                        <div>
                                            Tạo bởi {!! \App\Models\Helper::getValueInFilterReuquest('created_by_id') == "" ? '<i class="fa-solid fa-sort"></i>' : (\App\Models\Helper::getValueInFilterReuquest('created_by_id') != "desc" ? '<i class="fa-solid fa-arrow-up-a-z text-success"></i>' : '<i class="fa-solid fa-arrow-down-z-a text-danger"></i>') !!}
                                        </div>
                                    </th>
                                    <th onclick='onSortSearch(`created_at`, `{{ \App\Models\Helper::getValueInFilterReuquest('created_at') == "" ? "asc" : (\App\Models\Helper::getValueInFilterReuquest('created_at') != "desc" ? "desc" : "") }}`)'>
                                        <div>
                                            Ngày sử dụng {!! \App\Models\Helper::getValueInFilterReuquest('created_at') == "" ? '<i class="fa-solid fa-sort"></i>' : (\App\Models\Helper::getValueInFilterReuquest('created_at') != "desc" ? '<i class="fa-solid fa-arrow-up-a-z text-success"></i>' : '<i class="fa-solid fa-arrow-down-z-a text-danger"></i>') !!}
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
    <!-- Individual column searching (text inputs) Ends-->
    <!-- Container-fluid Ends-->

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
                        <select id="select_user_status_id" name="select_user_status_id" class="form-control select2_init" required>

                            @foreach($userStatuses as $itemUserStatuses)
                                <option value="{{$itemUserStatuses->id}}">{{$itemUserStatuses->name}}</option>
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

    <!-- Modal -->
    <div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="editUserModalLabel">Chỉnh sửa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="container_modal_edit">



                </div>

                <div class="modal-footer justify-content-between">
                    <div>
                    </div>

                    <button type="submit" id="btn_submit" class="btn btn-info" onclick="onSubmitEdit()">Update</button>

                </div>

            </div>
        </div>
    </div>

@endsection

@section('js')
    <script>

        let user_id, user_status_id, toucher_id


        function onEditStatus(toucher, id, id_status) {
            toucher_id = toucher
            user_id = id
            user_status_id = id_status

            $('select[name="select_user_status_id"]').val(id_status).change()
        }

        function onAdd() {
            user_id = 0;

            $('#input_name').val('')
            $('#input_phone').val('')
            $('#input_email').val('')
            $('#input_date_of_birth').val('')
            $('#input_address').val('')
            $('#input_password').val('')

            $('#btn_submit').removeClass('btn-info')
            $('#btn_submit').addClass('btn-success')
            $('#btn_submit').html('Create')
        }

        function onSubmitEdit() {
            if (user_id == 0) {
                $.ajax({
                    type: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    cache: false,
                    data: {
                        name: $('#input_name').val(),
                        phone: $('#input_phone').val(),
                        email: $('#input_email').val(),
                        date_of_birth: $('#input_date_of_birth').val(),
                        address: $('#input_address').val(),
                        user_status_id: $('#select_user_status_id').val(),
                        user_type_id: $('#select_user_type_id').val(),
                        password: $('#input_password').val(),
                        gender_id: $('#radio_gender').is(':checked') ? 1 : 2,
                    },
                    url: "{{route('ajax.administrator.user.store')}}",
                    beforeSend: function () {
                        showLoading()
                    },
                    success: function (response) {
                        hideModal('editUserModal')
                        hideLoading()
                        $('#container_row').prepend(response.html_row_add)
                    },
                    error: function (err) {
                        console.log(err)
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
            } else {
                $.ajax({
                    type: "PUT",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    cache: false,
                    data: {
                        id: user_id,
                        name: $('#input_name').val(),
                        phone: $('#input_phone').val(),
                        email: $('#input_email').val(),
                        date_of_birth: $('#input_date_of_birth').val(),
                        address: $('#input_address').val(),
                        user_status_id: $('#select_user_status_id').val(),
                        user_type_id: $('#select_user_type_id').val(),
                        password: $('#input_password').val(),
                        gender_id: $('#radio_gender').is(':checked') ? 1 : 2,
                    },
                    url: "{{route('ajax.administrator.user.update')}}",
                    beforeSend: function () {
                        showLoading()
                    },
                    success: function (response) {
                        hideModal('editUserModal')
                        hideLoading()
                        $('#container_row_' + user_id).after(response.html_row).remove()
                    },
                    error: function (err) {
                        console.log(err)
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
        }

        function onInfo(toucher, id, id_status) {
            // $('#btn_submit').addClass('btn-info')
            // $('#btn_submit').removeClass('btn-success')
            // $('#btn_submit').html('Update')

            toucher_id = toucher
            user_id = id
            user_status_id = id_status

            $.ajax({
                type: "GET",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                cache: false,
                data: {
                    id: user_id,
                },
                url: "{{route('ajax.administrator.user.get')}}",
                beforeSend: function () {
                    showLoading()
                },
                success: function (response) {
                    hideLoading()

                    $('#container_modal_info').html(response.htmlInfo)
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

            // $('select[name="select_user_status_id"]').val(id_status).change()
        }
        function onDetail(toucher, id, id_status) {
            $('#btn_submit').addClass('btn-info')
            $('#btn_submit').removeClass('btn-success')
            $('#btn_submit').html('Update')

            toucher_id = toucher
            user_id = id
            user_status_id = id_status

            $.ajax({
                type: "GET",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                cache: false,
                data: {
                    id: user_id,
                },
                url: "{{route('ajax.administrator.user.get')}}",
                beforeSend: function () {
                    showLoading()
                },
                success: function (response) {
                    hideLoading()

                    $('#container_modal_edit').html(response.html)
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

            $('select[name="select_user_status_id"]').val(id_status).change()
        }

        function onSubmitChangeStatus() {
            $.ajax({
                type: "PUT",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                cache: false,
                data: {
                    id: user_id,
                    user_status_id: $('select[name="select_user_status_id"]').val(),
                },
                url: "{{route('ajax.administrator.user.update')}}",
                beforeSend: function () {
                    showLoading()
                },
                success: function (response) {
                    hideModal('editStatus')
                    hideLoading()
                    $('#container_row_' + user_id).after(response.html_row).remove()
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



    <script>
        $('#select_user_status_id').select2({
            dropdownParent: $('#editStatus')
        });

    </script>

@endsection

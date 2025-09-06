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

                        <div class="table-responsive product-table">
                            <table class="table table-hover table-bordered">
                                <thead>
                                <tr>
                                    <th onclick='onSortSearch(`id`, `{{ \App\Models\Helper::getValueInFilterReuquest('id') == "" ? "asc" : (\App\Models\Helper::getValueInFilterReuquest('id') != "desc" ? "desc" : "") }}`)'>
                                        <div>
                                            # {!! \App\Models\Helper::getValueInFilterReuquest('id') == "" ? '<i class="fa-solid fa-sort"></i>' : (\App\Models\Helper::getValueInFilterReuquest('id') != "desc" ? '<i class="fa-solid fa-arrow-up-a-z text-success"></i>' : '<i class="fa-solid fa-arrow-down-z-a text-danger"></i>') !!}
                                        </div>
                                    </th>
                                    <th>Order time</th>
                                    <th>Est. payment</th>
                                    <th>Publisher</th>
                                    <th>Account manager</th>
                                    <th onclick='onSortSearch(`earning`, `{{ \App\Models\Helper::getValueInFilterReuquest('earning') == "" ? "asc" : (\App\Models\Helper::getValueInFilterReuquest('earning') != "desc" ? "desc" : "") }}`)'>
                                        <div>
                                            Earning {!! \App\Models\Helper::getValueInFilterReuquest('earning') == "" ? '<i class="fa-solid fa-sort"></i>' : (\App\Models\Helper::getValueInFilterReuquest('earning') != "desc" ? '<i class="fa-solid fa-arrow-up-a-z text-success"></i>' : '<i class="fa-solid fa-arrow-down-z-a text-danger"></i>') !!}
                                        </div>
                                    </th>
                                    <th style="width:50px;" onclick='onSortSearch(`deduction`, `{{ \App\Models\Helper::getValueInFilterReuquest('deduction') == "" ? "asc" : (\App\Models\Helper::getValueInFilterReuquest('deduction') != "desc" ? "desc" : "") }}`)'>
                                        <div>
                                            Deduction {!! \App\Models\Helper::getValueInFilterReuquest('deduction') == "" ? '<i class="fa-solid fa-sort"></i>' : (\App\Models\Helper::getValueInFilterReuquest('deduction') != "desc" ? '<i class="fa-solid fa-arrow-up-a-z text-success"></i>' : '<i class="fa-solid fa-arrow-down-z-a text-danger"></i>') !!}
                                        </div>
                                    </th>

                                    <th onclick='onSortSearch(`total`, `{{ \App\Models\Helper::getValueInFilterReuquest('total') == "" ? "asc" : (\App\Models\Helper::getValueInFilterReuquest('total') != "desc" ? "desc" : "") }}`)'>
                                        <div>
                                            Total {!! \App\Models\Helper::getValueInFilterReuquest('total') == "" ? '<i class="fa-solid fa-sort"></i>' : (\App\Models\Helper::getValueInFilterReuquest('total') != "desc" ? '<i class="fa-solid fa-arrow-up-a-z text-success"></i>' : '<i class="fa-solid fa-arrow-down-z-a text-danger"></i>') !!}
                                        </div>
                                    </th>

                                    <th>
                                        <div>
                                            Paid
                                        </div>
                                    </th>

                                    <th onclick='onSortSearch(`payment_status_id`, `{{ \App\Models\Helper::getValueInFilterReuquest('payment_status_id') == "" ? "asc" : (\App\Models\Helper::getValueInFilterReuquest('payment_status_id') != "desc" ? "desc" : "") }}`)'>
                                        <div>
                                            Status {!! \App\Models\Helper::getValueInFilterReuquest('payment_status_id') == "" ? '<i class="fa-solid fa-sort"></i>' : (\App\Models\Helper::getValueInFilterReuquest('payment_status_id') != "desc" ? '<i class="fa-solid fa-arrow-up-a-z text-success"></i>' : '<i class="fa-solid fa-arrow-down-z-a text-danger"></i>') !!}
                                        </div>
                                    </th>
                                    <th>Method</th>
                                </tr>
                                </thead>
                                <tbody class="" id="body_container_item">
                                @foreach($items as $index => $item)
                                    @include('administrator.'.$prefixView.'.row', ['item' => $item, 'prefixView' => $prefixView, 'index' => $index])
                                @endforeach

                                </tbody>

                                <tfoot>
                                <tr>
                                    <th onclick='onSortSearch(`id`, `{{ \App\Models\Helper::getValueInFilterReuquest('id') == "" ? "asc" : (\App\Models\Helper::getValueInFilterReuquest('id') != "desc" ? "desc" : "") }}`)'>
                                        <div>
                                            # {!! \App\Models\Helper::getValueInFilterReuquest('id') == "" ? '<i class="fa-solid fa-sort"></i>' : (\App\Models\Helper::getValueInFilterReuquest('id') != "desc" ? '<i class="fa-solid fa-arrow-up-a-z text-success"></i>' : '<i class="fa-solid fa-arrow-down-z-a text-danger"></i>') !!}
                                        </div>
                                    </th>
                                    <th>Order time</th>
                                    <th>Est. payment</th>
                                    <th>Publisher</th>
                                    <th>Account manager</th>
                                    <th onclick='onSortSearch(`earning`, `{{ \App\Models\Helper::getValueInFilterReuquest('earning') == "" ? "asc" : (\App\Models\Helper::getValueInFilterReuquest('earning') != "desc" ? "desc" : "") }}`)'>
                                        <div>
                                            Earning {!! \App\Models\Helper::getValueInFilterReuquest('earning') == "" ? '<i class="fa-solid fa-sort"></i>' : (\App\Models\Helper::getValueInFilterReuquest('earning') != "desc" ? '<i class="fa-solid fa-arrow-up-a-z text-success"></i>' : '<i class="fa-solid fa-arrow-down-z-a text-danger"></i>') !!}
                                        </div>
                                    </th>
                                    <th style="width:50px;" onclick='onSortSearch(`deduction`, `{{ \App\Models\Helper::getValueInFilterReuquest('deduction') == "" ? "asc" : (\App\Models\Helper::getValueInFilterReuquest('deduction') != "desc" ? "desc" : "") }}`)'>
                                        <div>
                                            Deduction {!! \App\Models\Helper::getValueInFilterReuquest('deduction') == "" ? '<i class="fa-solid fa-sort"></i>' : (\App\Models\Helper::getValueInFilterReuquest('deduction') != "desc" ? '<i class="fa-solid fa-arrow-up-a-z text-success"></i>' : '<i class="fa-solid fa-arrow-down-z-a text-danger"></i>') !!}
                                        </div>
                                    </th>

                                    <th onclick='onSortSearch(`total`, `{{ \App\Models\Helper::getValueInFilterReuquest('total') == "" ? "asc" : (\App\Models\Helper::getValueInFilterReuquest('total') != "desc" ? "desc" : "") }}`)'>
                                        <div>
                                            Total {!! \App\Models\Helper::getValueInFilterReuquest('total') == "" ? '<i class="fa-solid fa-sort"></i>' : (\App\Models\Helper::getValueInFilterReuquest('total') != "desc" ? '<i class="fa-solid fa-arrow-up-a-z text-success"></i>' : '<i class="fa-solid fa-arrow-down-z-a text-danger"></i>') !!}
                                        </div>
                                    </th>

                                    <th>
                                        <div>
                                            Paid
                                        </div>
                                    </th>
                                    <th onclick='onSortSearch(`payment_status_id`, `{{ \App\Models\Helper::getValueInFilterReuquest('payment_status_id') == "" ? "asc" : (\App\Models\Helper::getValueInFilterReuquest('payment_status_id') != "desc" ? "desc" : "") }}`)'>
                                        <div>
                                            Status {!! \App\Models\Helper::getValueInFilterReuquest('payment_status_id') == "" ? '<i class="fa-solid fa-sort"></i>' : (\App\Models\Helper::getValueInFilterReuquest('payment_status_id') != "desc" ? '<i class="fa-solid fa-arrow-up-a-z text-success"></i>' : '<i class="fa-solid fa-arrow-down-z-a text-danger"></i>') !!}
                                        </div>
                                    </th>
                                    <th>Method</th>
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

    <!-- Modal change status -->
    <div class="modal fade" id="modal_change_status" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal_change_status_title">Change status</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="container_modal_change_status">

                </div>
            </div>
        </div>
    </div>

    <!-- Modal paid parts -->
    <div class="modal fade" id="modal_paid_parts" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal_paid_parts_title"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="container_modal_paid_parts">

                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')
    <script>
        function onChangeStatusPayment(id) {
            callAjax(
                "GET",
                "{{route('ajax.administrator.payments.modal_change_status')}}",
                {
                    id: id,
                },
                (response) => {
                    showModal('modal_change_status');
                    $('#container_modal_change_status').html(response.data.html);
                },
                (error) => {

                }
            )
        }

        function onSaveStatusPayment(id) {
            callAjax(
                "PUT",
                "{{route('ajax.administrator.payments.change_status')}}",
                {
                    id: id,
                    payment_status_id: $('#modal_change_status_payment_status_id').val(),
                },
                (response) => {
                    hideModal('modal_change_status');
                    $('tr[data-id="' + id + '"]').after(response.data.html).remove();
                },
                (error) => {

                }
            )
        }

        function onShowModalPaidParts(id) {
            callAjax(
                "GET",
                "{{route('ajax.administrator.payments.modal_paid_parts')}}",
                {
                    id: id,
                },
                (response) => {
                    showModal('modal_paid_parts');
                    $('#modal_paid_parts_title').html(response.data.user?.email);
                    $('#container_modal_paid_parts').html(response.data.html);
                },
                (error) => {

                }
            )
        }

        function onStorePaidPart(id) {
            callAjax(
                "POST",
                "{{route('ajax.administrator.payments.store_paid_parts')}}",
                {
                    id: id,
                    amount: $('#modal_paid_parts_input_amount').val(),
                },
                (response) => {
                    showToastSuccess('Added');
                    $('#modal_modal_paid_parts_body_container_item').prepend(response.data.html).fadeIn(500);
                    $('#modal_paid_parts_input_amount').val('');
                    onRefreshRow(id);
                },
                (error) => {

                }
            )
        }

        function onStorePaidAllPart(id) {
            callAjax(
                "POST",
                "{{route('ajax.administrator.payments.store_paid_all_parts')}}",
                {
                    id: id,
                },
                (response) => {
                    showToastSuccess('Paid');
                    $('#modal_modal_paid_parts_body_container_item').prepend(response.data.html).fadeIn(500);
                    $('#modal_paid_parts_input_amount').val('');
                    onRefreshRow(id);
                    hideModal('modal_paid_parts');
                },
                (error) => {

                }
            )
        }

        function onRefreshRow(id) {
            callAjax(
                "GET",
                "{{route('ajax.administrator.payments.refresh_row')}}",
                {
                    id: id,
                },
                (response) => {
                    $('tr[data-id="' + id + '"]').after(response.data.html).remove();
                    $('#modal_paid_parts_input_amount').val('');
                },
                (error) => {

                },false
            )
        }

    </script>
@endsection


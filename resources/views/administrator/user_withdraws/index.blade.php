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
                                    <th onclick='onSortSearch(`total`, `{{ \App\Models\Helper::getValueInFilterReuquest('total') == "" ? "asc" : (\App\Models\Helper::getValueInFilterReuquest('total') != "desc" ? "desc" : "") }}`)'>
                                        <div>
                                            Amount {!! \App\Models\Helper::getValueInFilterReuquest('total') == "" ? '<i class="fa-solid fa-sort"></i>' : (\App\Models\Helper::getValueInFilterReuquest('total') != "desc" ? '<i class="fa-solid fa-arrow-up-a-z text-success"></i>' : '<i class="fa-solid fa-arrow-down-z-a text-danger"></i>') !!}
                                        </div>
                                    </th>
                                    <th style="width:50px;" onclick='onSortSearch(`deduction`, `{{ \App\Models\Helper::getValueInFilterReuquest('deduction') == "" ? "asc" : (\App\Models\Helper::getValueInFilterReuquest('deduction') != "desc" ? "desc" : "") }}`)'>
                                        <div>
                                            Deduction {!! \App\Models\Helper::getValueInFilterReuquest('deduction') == "" ? '<i class="fa-solid fa-sort"></i>' : (\App\Models\Helper::getValueInFilterReuquest('deduction') != "desc" ? '<i class="fa-solid fa-arrow-up-a-z text-success"></i>' : '<i class="fa-solid fa-arrow-down-z-a text-danger"></i>') !!}
                                        </div>
                                    </th>
                                    <th style="width:50px;" onclick='onSortSearch(`invalid`, `{{ \App\Models\Helper::getValueInFilterReuquest('invalid') == "" ? "asc" : (\App\Models\Helper::getValueInFilterReuquest('invalid') != "desc" ? "desc" : "") }}`)'>
                                        <div>
                                            Invalid amount {!! \App\Models\Helper::getValueInFilterReuquest('invalid') == "" ? '<i class="fa-solid fa-sort"></i>' : (\App\Models\Helper::getValueInFilterReuquest('invalid') != "desc" ? '<i class="fa-solid fa-arrow-up-a-z text-success"></i>' : '<i class="fa-solid fa-arrow-down-z-a text-danger"></i>') !!}
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
                                        <th onclick='onSortSearch(`total`, `{{ \App\Models\Helper::getValueInFilterReuquest('total') == "" ? "asc" : (\App\Models\Helper::getValueInFilterReuquest('total') != "desc" ? "desc" : "") }}`)'>
                                            <div>
                                                Amount {!! \App\Models\Helper::getValueInFilterReuquest('total') == "" ? '<i class="fa-solid fa-sort"></i>' : (\App\Models\Helper::getValueInFilterReuquest('total') != "desc" ? '<i class="fa-solid fa-arrow-up-a-z text-success"></i>' : '<i class="fa-solid fa-arrow-down-z-a text-danger"></i>') !!}
                                            </div>
                                        </th>
                                        <th onclick='onSortSearch(`deduction`, `{{ \App\Models\Helper::getValueInFilterReuquest('deduction') == "" ? "asc" : (\App\Models\Helper::getValueInFilterReuquest('deduction') != "desc" ? "desc" : "") }}`)'>
                                            <div>
                                                Deduction {!! \App\Models\Helper::getValueInFilterReuquest('deduction') == "" ? '<i class="fa-solid fa-sort"></i>' : (\App\Models\Helper::getValueInFilterReuquest('deduction') != "desc" ? '<i class="fa-solid fa-arrow-up-a-z text-success"></i>' : '<i class="fa-solid fa-arrow-down-z-a text-danger"></i>') !!}
                                            </div>
                                        </th>
                                        <th onclick='onSortSearch(`invalid`, `{{ \App\Models\Helper::getValueInFilterReuquest('invalid') == "" ? "asc" : (\App\Models\Helper::getValueInFilterReuquest('invalid') != "desc" ? "desc" : "") }}`)'>
                                            <div>
                                                Invalid amount {!! \App\Models\Helper::getValueInFilterReuquest('invalid') == "" ? '<i class="fa-solid fa-sort"></i>' : (\App\Models\Helper::getValueInFilterReuquest('invalid') != "desc" ? '<i class="fa-solid fa-arrow-up-a-z text-success"></i>' : '<i class="fa-solid fa-arrow-down-z-a text-danger"></i>') !!}
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

@endsection

@section('js')

@endsection


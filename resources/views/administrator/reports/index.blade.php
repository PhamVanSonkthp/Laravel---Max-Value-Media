@extends('administrator.layouts.master')

@include('administrator.'.$prefixView.'.header')

@section('css')
    <style>
        .table-bordered > thead > tr > th {
            cursor: pointer;
            font-weight: bold;
            /* size: 9rem; */
            font-size: 0.9rem;
        }
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

                        @include('administrator.components.checkbox_delete_table')

                        <div class="table-responsive product-table">
                            <table class="table table-hover table-bordered">
                                <thead>
                                <tr>
                                    <th colspan="4">
                                        Sumary
                                    </th>
                                    <th>
                                        {{\App\Models\Formatter::formatNumber($sumary->d_request)}}
                                    </th>
                                    <th>
                                        {{\App\Models\Formatter::formatNumber($sumary->d_impression)}}
                                    </th>
                                    <th>
                                        {{\App\Models\Formatter::formatNumber(round($sumary->d_ecpm, 2),2)}}
                                    </th>
                                    <th>
                                        {{\App\Models\Formatter::formatNumber(round($sumary->d_revenue,2), 2)}}
                                    </th>
                                    <th>
                                        {{round($sumary->count,2)}}
                                    </th>
                                    <th>
                                        {{round($sumary->share,2)}}
                                    </th>
                                    <th>
                                        {{\App\Models\Formatter::formatNumber(round($sumary->p_impression))}}
                                    </th>
                                    <th>
                                        {{round($sumary->p_ecpm,2)}}
                                    </th>
                                    <th>
                                        {{\App\Models\Formatter::formatNumber(round($sumary->p_revenue,2),2)}}
                                    </th>
                                    <th>
                                        {{\App\Models\Formatter::formatNumber(round($sumary->profit,2),2)}}
                                    </th>
                                    <th>
                                        {{\App\Models\Formatter::formatNumber(round($sumary->net_profit,2),2)}}
                                    </th>
                                </tr>

                                <tr>
                                    <th onclick='onSortSearch(`date`, `{{ \App\Models\Helper::getValueInFilterReuquest('date') == "" ? "asc" : (\App\Models\Helper::getValueInFilterReuquest('date') != "desc" ? "desc" : "") }}`)'>
                                        <div>
                                            Date {!! \App\Models\Helper::getValueInFilterReuquest('date') == "" ? '<i class="fa-solid fa-sort"></i>' : (\App\Models\Helper::getValueInFilterReuquest('date') != "desc" ? '<i class="fa-solid fa-arrow-up-a-z text-success"></i>' : '<i class="fa-solid fa-arrow-down-z-a text-danger"></i>') !!}
                                        </div>
                                    </th>
                                    <th onclick='onSortSearch(`demand`, `{{ \App\Models\Helper::getValueInFilterReuquest('demand') == "" ? "asc" : (\App\Models\Helper::getValueInFilterReuquest('demand') != "desc" ? "desc" : "") }}`)'>
                                        <div>
                                            Demand {!! \App\Models\Helper::getValueInFilterReuquest('demand') == "" ? '<i class="fa-solid fa-sort"></i>' : (\App\Models\Helper::getValueInFilterReuquest('demand') != "desc" ? '<i class="fa-solid fa-arrow-up-a-z text-success"></i>' : '<i class="fa-solid fa-arrow-down-z-a text-danger"></i>') !!}
                                        </div>
                                    </th>
                                    <th onclick='onSortSearch(`site`, `{{ \App\Models\Helper::getValueInFilterReuquest('site') == "" ? "asc" : (\App\Models\Helper::getValueInFilterReuquest('site') != "desc" ? "desc" : "") }}`)'>
                                        <div>
                                            Site {!! \App\Models\Helper::getValueInFilterReuquest('site') == "" ? '<i class="fa-solid fa-sort"></i>' : (\App\Models\Helper::getValueInFilterReuquest('site') != "desc" ? '<i class="fa-solid fa-arrow-up-a-z text-success"></i>' : '<i class="fa-solid fa-arrow-down-z-a text-danger"></i>') !!}
                                        </div>
                                    </th>

{{--                                    <th onclick='onSortSearch(`zone_id`, `{{ \App\Models\Helper::getValueInFilterReuquest('zone_id') == "" ? "asc" : (\App\Models\Helper::getValueInFilterReuquest('zone_id') != "desc" ? "desc" : "") }}`)'>--}}
{{--                                        <div>--}}
{{--                                            Zone ID {!! \App\Models\Helper::getValueInFilterReuquest('zone_id') == "" ? '<i class="fa-solid fa-sort"></i>' : (\App\Models\Helper::getValueInFilterReuquest('zone_id') != "desc" ? '<i class="fa-solid fa-arrow-up-a-z text-success"></i>' : '<i class="fa-solid fa-arrow-down-z-a text-danger"></i>') !!}--}}
{{--                                        </div>--}}
{{--                                    </th>--}}
                                    <th onclick='onSortSearch(`zone_name`, `{{ \App\Models\Helper::getValueInFilterReuquest('zone_name') == "" ? "asc" : (\App\Models\Helper::getValueInFilterReuquest('zone_name') != "desc" ? "desc" : "") }}`)'>
                                        <div>
                                            Zone name {!! \App\Models\Helper::getValueInFilterReuquest('zone_name') == "" ? '<i class="fa-solid fa-sort"></i>' : (\App\Models\Helper::getValueInFilterReuquest('zone_name') != "desc" ? '<i class="fa-solid fa-arrow-up-a-z text-success"></i>' : '<i class="fa-solid fa-arrow-down-z-a text-danger"></i>') !!}
                                        </div>
                                    </th>
                                    <th onclick='onSortSearch(`d_request`, `{{ \App\Models\Helper::getValueInFilterReuquest('d_request') == "" ? "asc" : (\App\Models\Helper::getValueInFilterReuquest('d_request') != "desc" ? "desc" : "") }}`)'>
                                        <div>
                                            D.Request {!! \App\Models\Helper::getValueInFilterReuquest('d_request') == "" ? '<i class="fa-solid fa-sort"></i>' : (\App\Models\Helper::getValueInFilterReuquest('d_request') != "desc" ? '<i class="fa-solid fa-arrow-up-a-z text-success"></i>' : '<i class="fa-solid fa-arrow-down-z-a text-danger"></i>') !!}
                                        </div>
                                    </th>
                                    <th onclick='onSortSearch(`d_impression`, `{{ \App\Models\Helper::getValueInFilterReuquest('d_impression') == "" ? "asc" : (\App\Models\Helper::getValueInFilterReuquest('d_impression') != "desc" ? "desc" : "") }}`)'>
                                        <div>
                                            D.Impression {!! \App\Models\Helper::getValueInFilterReuquest('d_impression') == "" ? '<i class="fa-solid fa-sort"></i>' : (\App\Models\Helper::getValueInFilterReuquest('d_impression') != "desc" ? '<i class="fa-solid fa-arrow-up-a-z text-success"></i>' : '<i class="fa-solid fa-arrow-down-z-a text-danger"></i>') !!}
                                        </div>
                                    </th>
                                    <th onclick='onSortSearch(`d_ecpm`, `{{ \App\Models\Helper::getValueInFilterReuquest('d_ecpm') == "" ? "asc" : (\App\Models\Helper::getValueInFilterReuquest('d_ecpm') != "desc" ? "desc" : "") }}`)'>
                                        <div>
                                            D.eCPM ($) {!! \App\Models\Helper::getValueInFilterReuquest('d_ecpm') == "" ? '<i class="fa-solid fa-sort"></i>' : (\App\Models\Helper::getValueInFilterReuquest('d_ecpm') != "desc" ? '<i class="fa-solid fa-arrow-up-a-z text-success"></i>' : '<i class="fa-solid fa-arrow-down-z-a text-danger"></i>') !!}
                                        </div>
                                    </th>
                                    <th onclick='onSortSearch(`d_revenue`, `{{ \App\Models\Helper::getValueInFilterReuquest('d_revenue') == "" ? "asc" : (\App\Models\Helper::getValueInFilterReuquest('d_revenue') != "desc" ? "desc" : "") }}`)'>
                                        <div>
                                            D.Revenue ($) {!! \App\Models\Helper::getValueInFilterReuquest('d_revenue') == "" ? '<i class="fa-solid fa-sort"></i>' : (\App\Models\Helper::getValueInFilterReuquest('d_revenue') != "desc" ? '<i class="fa-solid fa-arrow-up-a-z text-success"></i>' : '<i class="fa-solid fa-arrow-down-z-a text-danger"></i>') !!}
                                        </div>
                                    </th>
                                    <th onclick='onSortSearch(`count`, `{{ \App\Models\Helper::getValueInFilterReuquest('count') == "" ? "asc" : (\App\Models\Helper::getValueInFilterReuquest('count') != "desc" ? "desc" : "") }}`)'>
                                        <div>
                                            -Count (%)- {!! \App\Models\Helper::getValueInFilterReuquest('count') == "" ? '<i class="fa-solid fa-sort"></i>' : (\App\Models\Helper::getValueInFilterReuquest('count') != "desc" ? '<i class="fa-solid fa-arrow-up-a-z text-success"></i>' : '<i class="fa-solid fa-arrow-down-z-a text-danger"></i>') !!}
                                        </div>
                                    </th>
                                    <th onclick='onSortSearch(`share`, `{{ \App\Models\Helper::getValueInFilterReuquest('share') == "" ? "asc" : (\App\Models\Helper::getValueInFilterReuquest('share') != "desc" ? "desc" : "") }}`)'>
                                        <div>
                                            -Share (%)- {!! \App\Models\Helper::getValueInFilterReuquest('share') == "" ? '<i class="fa-solid fa-sort"></i>' : (\App\Models\Helper::getValueInFilterReuquest('share') != "desc" ? '<i class="fa-solid fa-arrow-up-a-z text-success"></i>' : '<i class="fa-solid fa-arrow-down-z-a text-danger"></i>') !!}
                                        </div>
                                    </th>
                                    <th onclick='onSortSearch(`p_impression`, `{{ \App\Models\Helper::getValueInFilterReuquest('p_impression') == "" ? "asc" : (\App\Models\Helper::getValueInFilterReuquest('p_impression') != "desc" ? "desc" : "") }}`)'>
                                        <div>
                                            P.impression {!! \App\Models\Helper::getValueInFilterReuquest('p_impression') == "" ? '<i class="fa-solid fa-sort"></i>' : (\App\Models\Helper::getValueInFilterReuquest('p_impression') != "desc" ? '<i class="fa-solid fa-arrow-up-a-z text-success"></i>' : '<i class="fa-solid fa-arrow-down-z-a text-danger"></i>') !!}
                                        </div>
                                    </th>
                                    <th onclick='onSortSearch(`p_ecpm`, `{{ \App\Models\Helper::getValueInFilterReuquest('p_ecpm') == "" ? "asc" : (\App\Models\Helper::getValueInFilterReuquest('p_ecpm') != "desc" ? "desc" : "") }}`)'>
                                        <div>
                                            P.eCPM ($) {!! \App\Models\Helper::getValueInFilterReuquest('p_ecpm') == "" ? '<i class="fa-solid fa-sort"></i>' : (\App\Models\Helper::getValueInFilterReuquest('p_ecpm') != "desc" ? '<i class="fa-solid fa-arrow-up-a-z text-success"></i>' : '<i class="fa-solid fa-arrow-down-z-a text-danger"></i>') !!}
                                        </div>
                                    </th>
                                    <th onclick='onSortSearch(`p_revenue`, `{{ \App\Models\Helper::getValueInFilterReuquest('p_revenue') == "" ? "asc" : (\App\Models\Helper::getValueInFilterReuquest('p_revenue') != "desc" ? "desc" : "") }}`)'>
                                        <div>
                                            P.Revenue ($) {!! \App\Models\Helper::getValueInFilterReuquest('p_revenue') == "" ? '<i class="fa-solid fa-sort"></i>' : (\App\Models\Helper::getValueInFilterReuquest('p_revenue') != "desc" ? '<i class="fa-solid fa-arrow-up-a-z text-success"></i>' : '<i class="fa-solid fa-arrow-down-z-a text-danger"></i>') !!}
                                        </div>
                                    </th>
                                    <th onclick='onSortSearch(`profit`, `{{ \App\Models\Helper::getValueInFilterReuquest('profit') == "" ? "asc" : (\App\Models\Helper::getValueInFilterReuquest('profit') != "desc" ? "desc" : "") }}`)'>
                                        <div>
                                            Profit {!! \App\Models\Helper::getValueInFilterReuquest('profit') == "" ? '<i class="fa-solid fa-sort"></i>' : (\App\Models\Helper::getValueInFilterReuquest('profit') != "desc" ? '<i class="fa-solid fa-arrow-up-a-z text-success"></i>' : '<i class="fa-solid fa-arrow-down-z-a text-danger"></i>') !!}
                                        </div>
                                    </th>
{{--                                    <th onclick='onSortSearch(`sale_percent`, `{{ \App\Models\Helper::getValueInFilterReuquest('sale_percent') == "" ? "asc" : (\App\Models\Helper::getValueInFilterReuquest('sale_percent') != "desc" ? "desc" : "") }}`)'>--}}
{{--                                        <div>--}}
{{--                                            Sale (15% DT) {!! \App\Models\Helper::getValueInFilterReuquest('sale_percent') == "" ? '<i class="fa-solid fa-sort"></i>' : (\App\Models\Helper::getValueInFilterReuquest('sale_percent') != "desc" ? '<i class="fa-solid fa-arrow-up-a-z text-success"></i>' : '<i class="fa-solid fa-arrow-down-z-a text-danger"></i>') !!}--}}
{{--                                        </div>--}}
{{--                                    </th>--}}
{{--                                    <th onclick='onSortSearch(`system_percent`, `{{ \App\Models\Helper::getValueInFilterReuquest('system_percent') == "" ? "asc" : (\App\Models\Helper::getValueInFilterReuquest('system_percent') != "desc" ? "desc" : "") }}`)'>--}}
{{--                                        <div>--}}
{{--                                            System (8%) {!! \App\Models\Helper::getValueInFilterReuquest('system_percent') == "" ? '<i class="fa-solid fa-sort"></i>' : (\App\Models\Helper::getValueInFilterReuquest('system_percent') != "desc" ? '<i class="fa-solid fa-arrow-up-a-z text-success"></i>' : '<i class="fa-solid fa-arrow-down-z-a text-danger"></i>') !!}--}}
{{--                                        </div>--}}
{{--                                    </th>--}}
{{--                                    <th onclick='onSortSearch(`tax`, `{{ \App\Models\Helper::getValueInFilterReuquest('tax') == "" ? "asc" : (\App\Models\Helper::getValueInFilterReuquest('tax') != "desc" ? "desc" : "") }}`)'>--}}
{{--                                        <div>--}}
{{--                                            Tax (10%) {!! \App\Models\Helper::getValueInFilterReuquest('tax') == "" ? '<i class="fa-solid fa-sort"></i>' : (\App\Models\Helper::getValueInFilterReuquest('tax') != "desc" ? '<i class="fa-solid fa-arrow-up-a-z text-success"></i>' : '<i class="fa-solid fa-arrow-down-z-a text-danger"></i>') !!}--}}
{{--                                        </div>--}}
{{--                                    </th>--}}
{{--                                    <th onclick='onSortSearch(`fix_cost`, `{{ \App\Models\Helper::getValueInFilterReuquest('fix_cost') == "" ? "asc" : (\App\Models\Helper::getValueInFilterReuquest('fix_cost') != "desc" ? "desc" : "") }}`)'>--}}
{{--                                        <div>--}}
{{--                                            Fix Cost(10%) {!! \App\Models\Helper::getValueInFilterReuquest('fix_cost') == "" ? '<i class="fa-solid fa-sort"></i>' : (\App\Models\Helper::getValueInFilterReuquest('fix_cost') != "desc" ? '<i class="fa-solid fa-arrow-up-a-z text-success"></i>' : '<i class="fa-solid fa-arrow-down-z-a text-danger"></i>') !!}--}}
{{--                                        </div>--}}
{{--                                    </th>--}}
{{--                                    <th onclick='onSortSearch(`salary`, `{{ \App\Models\Helper::getValueInFilterReuquest('salary') == "" ? "asc" : (\App\Models\Helper::getValueInFilterReuquest('salary') != "desc" ? "desc" : "") }}`)'>--}}
{{--                                        <div>--}}
{{--                                            --Salary-- {!! \App\Models\Helper::getValueInFilterReuquest('salary') == "" ? '<i class="fa-solid fa-sort"></i>' : (\App\Models\Helper::getValueInFilterReuquest('salary') != "desc" ? '<i class="fa-solid fa-arrow-up-a-z text-success"></i>' : '<i class="fa-solid fa-arrow-down-z-a text-danger"></i>') !!}--}}
{{--                                        </div>--}}
{{--                                    </th>--}}
{{--                                    <th onclick='onSortSearch(`deduction`, `{{ \App\Models\Helper::getValueInFilterReuquest('deduction') == "" ? "asc" : (\App\Models\Helper::getValueInFilterReuquest('deduction') != "desc" ? "desc" : "") }}`)'>--}}
{{--                                        <div>--}}
{{--                                            Deduction ($) {!! \App\Models\Helper::getValueInFilterReuquest('deduction') == "" ? '<i class="fa-solid fa-sort"></i>' : (\App\Models\Helper::getValueInFilterReuquest('deduction') != "desc" ? '<i class="fa-solid fa-arrow-up-a-z text-success"></i>' : '<i class="fa-solid fa-arrow-down-z-a text-danger"></i>') !!}--}}
{{--                                        </div>--}}
{{--                                    </th>--}}
                                    <th onclick='onSortSearch(`net_profit`, `{{ \App\Models\Helper::getValueInFilterReuquest('net_profit') == "" ? "asc" : (\App\Models\Helper::getValueInFilterReuquest('net_profit') != "desc" ? "desc" : "") }}`)'>
                                        <div>
                                            Net Profit ($) {!! \App\Models\Helper::getValueInFilterReuquest('net_profit') == "" ? '<i class="fa-solid fa-sort"></i>' : (\App\Models\Helper::getValueInFilterReuquest('net_profit') != "desc" ? '<i class="fa-solid fa-arrow-up-a-z text-success"></i>' : '<i class="fa-solid fa-arrow-down-z-a text-danger"></i>') !!}
                                        </div>
                                    </th>
                                </tr>
                                </thead>
                                <tbody class="" id="body_container_item">
                                @foreach($items as $index => $item)
                                    @include('administrator.'.$prefixView.'.row', ['item' => $item, 'prefixView' => $prefixView, 'index' => $index])
                                @endforeach

                                </tbody>

                                <tfoot>
                                    <tr>
                                        <th onclick='onSortSearch(`date`, `{{ \App\Models\Helper::getValueInFilterReuquest('date') == "" ? "asc" : (\App\Models\Helper::getValueInFilterReuquest('date') != "desc" ? "desc" : "") }}`)'>
                                            <div>
                                                Date {!! \App\Models\Helper::getValueInFilterReuquest('date') == "" ? '<i class="fa-solid fa-sort"></i>' : (\App\Models\Helper::getValueInFilterReuquest('date') != "desc" ? '<i class="fa-solid fa-arrow-up-a-z text-success"></i>' : '<i class="fa-solid fa-arrow-down-z-a text-danger"></i>') !!}
                                            </div>
                                        </th>
                                        <th onclick='onSortSearch(`demand`, `{{ \App\Models\Helper::getValueInFilterReuquest('demand') == "" ? "asc" : (\App\Models\Helper::getValueInFilterReuquest('demand') != "desc" ? "desc" : "") }}`)'>
                                            <div>
                                                Demand {!! \App\Models\Helper::getValueInFilterReuquest('demand') == "" ? '<i class="fa-solid fa-sort"></i>' : (\App\Models\Helper::getValueInFilterReuquest('demand') != "desc" ? '<i class="fa-solid fa-arrow-up-a-z text-success"></i>' : '<i class="fa-solid fa-arrow-down-z-a text-danger"></i>') !!}
                                            </div>
                                        </th>
                                        <th onclick='onSortSearch(`site`, `{{ \App\Models\Helper::getValueInFilterReuquest('site') == "" ? "asc" : (\App\Models\Helper::getValueInFilterReuquest('site') != "desc" ? "desc" : "") }}`)'>
                                            <div>
                                                Site {!! \App\Models\Helper::getValueInFilterReuquest('site') == "" ? '<i class="fa-solid fa-sort"></i>' : (\App\Models\Helper::getValueInFilterReuquest('site') != "desc" ? '<i class="fa-solid fa-arrow-up-a-z text-success"></i>' : '<i class="fa-solid fa-arrow-down-z-a text-danger"></i>') !!}
                                            </div>
                                        </th>

{{--                                        <th onclick='onSortSearch(`zone_id`, `{{ \App\Models\Helper::getValueInFilterReuquest('zone_id') == "" ? "asc" : (\App\Models\Helper::getValueInFilterReuquest('zone_id') != "desc" ? "desc" : "") }}`)'>--}}
{{--                                            <div>--}}
{{--                                                Zone ID {!! \App\Models\Helper::getValueInFilterReuquest('zone_id') == "" ? '<i class="fa-solid fa-sort"></i>' : (\App\Models\Helper::getValueInFilterReuquest('zone_id') != "desc" ? '<i class="fa-solid fa-arrow-up-a-z text-success"></i>' : '<i class="fa-solid fa-arrow-down-z-a text-danger"></i>') !!}--}}
{{--                                            </div>--}}
{{--                                        </th>--}}
                                        <th onclick='onSortSearch(`zone_name`, `{{ \App\Models\Helper::getValueInFilterReuquest('zone_name') == "" ? "asc" : (\App\Models\Helper::getValueInFilterReuquest('zone_name') != "desc" ? "desc" : "") }}`)'>
                                            <div>
                                                Zone name {!! \App\Models\Helper::getValueInFilterReuquest('zone_name') == "" ? '<i class="fa-solid fa-sort"></i>' : (\App\Models\Helper::getValueInFilterReuquest('zone_name') != "desc" ? '<i class="fa-solid fa-arrow-up-a-z text-success"></i>' : '<i class="fa-solid fa-arrow-down-z-a text-danger"></i>') !!}
                                            </div>
                                        </th>
                                        <th onclick='onSortSearch(`d_request`, `{{ \App\Models\Helper::getValueInFilterReuquest('d_request') == "" ? "asc" : (\App\Models\Helper::getValueInFilterReuquest('d_request') != "desc" ? "desc" : "") }}`)'>
                                            <div>
                                                D.Request {!! \App\Models\Helper::getValueInFilterReuquest('d_request') == "" ? '<i class="fa-solid fa-sort"></i>' : (\App\Models\Helper::getValueInFilterReuquest('d_request') != "desc" ? '<i class="fa-solid fa-arrow-up-a-z text-success"></i>' : '<i class="fa-solid fa-arrow-down-z-a text-danger"></i>') !!}
                                            </div>
                                        </th>
                                        <th onclick='onSortSearch(`d_impression`, `{{ \App\Models\Helper::getValueInFilterReuquest('d_impression') == "" ? "asc" : (\App\Models\Helper::getValueInFilterReuquest('d_impression') != "desc" ? "desc" : "") }}`)'>
                                            <div>
                                                D.Impression {!! \App\Models\Helper::getValueInFilterReuquest('d_impression') == "" ? '<i class="fa-solid fa-sort"></i>' : (\App\Models\Helper::getValueInFilterReuquest('d_impression') != "desc" ? '<i class="fa-solid fa-arrow-up-a-z text-success"></i>' : '<i class="fa-solid fa-arrow-down-z-a text-danger"></i>') !!}
                                            </div>
                                        </th>
                                        <th onclick='onSortSearch(`d_ecpm`, `{{ \App\Models\Helper::getValueInFilterReuquest('d_ecpm') == "" ? "asc" : (\App\Models\Helper::getValueInFilterReuquest('d_ecpm') != "desc" ? "desc" : "") }}`)'>
                                            <div>
                                                D.eCPM ($) {!! \App\Models\Helper::getValueInFilterReuquest('d_ecpm') == "" ? '<i class="fa-solid fa-sort"></i>' : (\App\Models\Helper::getValueInFilterReuquest('d_ecpm') != "desc" ? '<i class="fa-solid fa-arrow-up-a-z text-success"></i>' : '<i class="fa-solid fa-arrow-down-z-a text-danger"></i>') !!}
                                            </div>
                                        </th>
                                        <th onclick='onSortSearch(`d_revenue`, `{{ \App\Models\Helper::getValueInFilterReuquest('d_revenue') == "" ? "asc" : (\App\Models\Helper::getValueInFilterReuquest('d_revenue') != "desc" ? "desc" : "") }}`)'>
                                            <div>
                                                D.Revenue ($) {!! \App\Models\Helper::getValueInFilterReuquest('d_revenue') == "" ? '<i class="fa-solid fa-sort"></i>' : (\App\Models\Helper::getValueInFilterReuquest('d_revenue') != "desc" ? '<i class="fa-solid fa-arrow-up-a-z text-success"></i>' : '<i class="fa-solid fa-arrow-down-z-a text-danger"></i>') !!}
                                            </div>
                                        </th>
                                        <th onclick='onSortSearch(`count`, `{{ \App\Models\Helper::getValueInFilterReuquest('count') == "" ? "asc" : (\App\Models\Helper::getValueInFilterReuquest('count') != "desc" ? "desc" : "") }}`)'>
                                            <div>
                                                Count (%) {!! \App\Models\Helper::getValueInFilterReuquest('count') == "" ? '<i class="fa-solid fa-sort"></i>' : (\App\Models\Helper::getValueInFilterReuquest('count') != "desc" ? '<i class="fa-solid fa-arrow-up-a-z text-success"></i>' : '<i class="fa-solid fa-arrow-down-z-a text-danger"></i>') !!}
                                            </div>
                                        </th>
                                        <th onclick='onSortSearch(`share`, `{{ \App\Models\Helper::getValueInFilterReuquest('share') == "" ? "asc" : (\App\Models\Helper::getValueInFilterReuquest('share') != "desc" ? "desc" : "") }}`)'>
                                            <div>
                                                Share (%) {!! \App\Models\Helper::getValueInFilterReuquest('share') == "" ? '<i class="fa-solid fa-sort"></i>' : (\App\Models\Helper::getValueInFilterReuquest('share') != "desc" ? '<i class="fa-solid fa-arrow-up-a-z text-success"></i>' : '<i class="fa-solid fa-arrow-down-z-a text-danger"></i>') !!}
                                            </div>
                                        </th>
                                        <th onclick='onSortSearch(`p_impression`, `{{ \App\Models\Helper::getValueInFilterReuquest('p_impression') == "" ? "asc" : (\App\Models\Helper::getValueInFilterReuquest('p_impression') != "desc" ? "desc" : "") }}`)'>
                                            <div>
                                                P.impression {!! \App\Models\Helper::getValueInFilterReuquest('p_impression') == "" ? '<i class="fa-solid fa-sort"></i>' : (\App\Models\Helper::getValueInFilterReuquest('p_impression') != "desc" ? '<i class="fa-solid fa-arrow-up-a-z text-success"></i>' : '<i class="fa-solid fa-arrow-down-z-a text-danger"></i>') !!}
                                            </div>
                                        </th>
                                        <th onclick='onSortSearch(`p_ecpm`, `{{ \App\Models\Helper::getValueInFilterReuquest('p_ecpm') == "" ? "asc" : (\App\Models\Helper::getValueInFilterReuquest('p_ecpm') != "desc" ? "desc" : "") }}`)'>
                                            <div>
                                                P.eCPM ($) {!! \App\Models\Helper::getValueInFilterReuquest('p_ecpm') == "" ? '<i class="fa-solid fa-sort"></i>' : (\App\Models\Helper::getValueInFilterReuquest('p_ecpm') != "desc" ? '<i class="fa-solid fa-arrow-up-a-z text-success"></i>' : '<i class="fa-solid fa-arrow-down-z-a text-danger"></i>') !!}
                                            </div>
                                        </th>
                                        <th onclick='onSortSearch(`p_revenue`, `{{ \App\Models\Helper::getValueInFilterReuquest('p_revenue') == "" ? "asc" : (\App\Models\Helper::getValueInFilterReuquest('p_revenue') != "desc" ? "desc" : "") }}`)'>
                                            <div>
                                                P.Revenue ($) {!! \App\Models\Helper::getValueInFilterReuquest('p_revenue') == "" ? '<i class="fa-solid fa-sort"></i>' : (\App\Models\Helper::getValueInFilterReuquest('p_revenue') != "desc" ? '<i class="fa-solid fa-arrow-up-a-z text-success"></i>' : '<i class="fa-solid fa-arrow-down-z-a text-danger"></i>') !!}
                                            </div>
                                        </th>
                                        <th onclick='onSortSearch(`profit`, `{{ \App\Models\Helper::getValueInFilterReuquest('profit') == "" ? "asc" : (\App\Models\Helper::getValueInFilterReuquest('profit') != "desc" ? "desc" : "") }}`)'>
                                            <div>
                                                Profit {!! \App\Models\Helper::getValueInFilterReuquest('profit') == "" ? '<i class="fa-solid fa-sort"></i>' : (\App\Models\Helper::getValueInFilterReuquest('profit') != "desc" ? '<i class="fa-solid fa-arrow-up-a-z text-success"></i>' : '<i class="fa-solid fa-arrow-down-z-a text-danger"></i>') !!}
                                            </div>
                                        </th>
{{--                                        <th onclick='onSortSearch(`sale_percent`, `{{ \App\Models\Helper::getValueInFilterReuquest('sale_percent') == "" ? "asc" : (\App\Models\Helper::getValueInFilterReuquest('sale_percent') != "desc" ? "desc" : "") }}`)'>--}}
{{--                                            <div>--}}
{{--                                                Sale (15% DT) {!! \App\Models\Helper::getValueInFilterReuquest('sale_percent') == "" ? '<i class="fa-solid fa-sort"></i>' : (\App\Models\Helper::getValueInFilterReuquest('sale_percent') != "desc" ? '<i class="fa-solid fa-arrow-up-a-z text-success"></i>' : '<i class="fa-solid fa-arrow-down-z-a text-danger"></i>') !!}--}}
{{--                                            </div>--}}
{{--                                        </th>--}}
{{--                                        <th onclick='onSortSearch(`system_percent`, `{{ \App\Models\Helper::getValueInFilterReuquest('system_percent') == "" ? "asc" : (\App\Models\Helper::getValueInFilterReuquest('system_percent') != "desc" ? "desc" : "") }}`)'>--}}
{{--                                            <div>--}}
{{--                                                System (8%) {!! \App\Models\Helper::getValueInFilterReuquest('system_percent') == "" ? '<i class="fa-solid fa-sort"></i>' : (\App\Models\Helper::getValueInFilterReuquest('system_percent') != "desc" ? '<i class="fa-solid fa-arrow-up-a-z text-success"></i>' : '<i class="fa-solid fa-arrow-down-z-a text-danger"></i>') !!}--}}
{{--                                            </div>--}}
{{--                                        </th>--}}
{{--                                        <th onclick='onSortSearch(`tax`, `{{ \App\Models\Helper::getValueInFilterReuquest('tax') == "" ? "asc" : (\App\Models\Helper::getValueInFilterReuquest('tax') != "desc" ? "desc" : "") }}`)'>--}}
{{--                                            <div>--}}
{{--                                                Tax (10%) {!! \App\Models\Helper::getValueInFilterReuquest('tax') == "" ? '<i class="fa-solid fa-sort"></i>' : (\App\Models\Helper::getValueInFilterReuquest('tax') != "desc" ? '<i class="fa-solid fa-arrow-up-a-z text-success"></i>' : '<i class="fa-solid fa-arrow-down-z-a text-danger"></i>') !!}--}}
{{--                                            </div>--}}
{{--                                        </th>--}}
{{--                                        <th onclick='onSortSearch(`fix_cost`, `{{ \App\Models\Helper::getValueInFilterReuquest('fix_cost') == "" ? "asc" : (\App\Models\Helper::getValueInFilterReuquest('fix_cost') != "desc" ? "desc" : "") }}`)'>--}}
{{--                                            <div>--}}
{{--                                                Fix Cost(10%) {!! \App\Models\Helper::getValueInFilterReuquest('fix_cost') == "" ? '<i class="fa-solid fa-sort"></i>' : (\App\Models\Helper::getValueInFilterReuquest('fix_cost') != "desc" ? '<i class="fa-solid fa-arrow-up-a-z text-success"></i>' : '<i class="fa-solid fa-arrow-down-z-a text-danger"></i>') !!}--}}
{{--                                            </div>--}}
{{--                                        </th>--}}
{{--                                        <th onclick='onSortSearch(`salary`, `{{ \App\Models\Helper::getValueInFilterReuquest('salary') == "" ? "asc" : (\App\Models\Helper::getValueInFilterReuquest('salary') != "desc" ? "desc" : "") }}`)'>--}}
{{--                                            <div>--}}
{{--                                                Salary {!! \App\Models\Helper::getValueInFilterReuquest('salary') == "" ? '<i class="fa-solid fa-sort"></i>' : (\App\Models\Helper::getValueInFilterReuquest('salary') != "desc" ? '<i class="fa-solid fa-arrow-up-a-z text-success"></i>' : '<i class="fa-solid fa-arrow-down-z-a text-danger"></i>') !!}--}}
{{--                                            </div>--}}
{{--                                        </th>--}}
{{--                                        <th onclick='onSortSearch(`deduction`, `{{ \App\Models\Helper::getValueInFilterReuquest('deduction') == "" ? "asc" : (\App\Models\Helper::getValueInFilterReuquest('deduction') != "desc" ? "desc" : "") }}`)'>--}}
{{--                                            <div>--}}
{{--                                                Deduction ($) {!! \App\Models\Helper::getValueInFilterReuquest('deduction') == "" ? '<i class="fa-solid fa-sort"></i>' : (\App\Models\Helper::getValueInFilterReuquest('deduction') != "desc" ? '<i class="fa-solid fa-arrow-up-a-z text-success"></i>' : '<i class="fa-solid fa-arrow-down-z-a text-danger"></i>') !!}--}}
{{--                                            </div>--}}
{{--                                        </th>--}}
                                        <th onclick='onSortSearch(`net_profit`, `{{ \App\Models\Helper::getValueInFilterReuquest('net_profit') == "" ? "asc" : (\App\Models\Helper::getValueInFilterReuquest('net_profit') != "desc" ? "desc" : "") }}`)'>
                                            <div>
                                                Net Profit ($) {!! \App\Models\Helper::getValueInFilterReuquest('net_profit') == "" ? '<i class="fa-solid fa-sort"></i>' : (\App\Models\Helper::getValueInFilterReuquest('net_profit') != "desc" ? '<i class="fa-solid fa-arrow-up-a-z text-success"></i>' : '<i class="fa-solid fa-arrow-down-z-a text-danger"></i>') !!}
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

@endsection

@section('js')


@endsection


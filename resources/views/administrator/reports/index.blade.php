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
                                    <th colspan="{{1 + collect(['reports-list-website','reports-list-demand'])->filter(fn($perm) => auth()->user()->can($perm))->count() + (auth()->user()->can('reports-list-zone_website') ? 2 : 0)}}">
                                        Sumary
                                    </th>

                                    @can('reports-list-d_request')
                                        <th>
                                            {{\App\Models\Formatter::formatNumber($sumary->d_request)}}
                                        </th>
                                    @endcan

                                    @can('reports-list-d_impression')
                                        <th>
                                            {{\App\Models\Formatter::formatNumber($sumary->d_impression)}}
                                        </th>
                                    @endcan

                                    @can('reports-list-d_impression_us_uk')
                                        <th>
                                            <div>
                                                {{\App\Models\Formatter::formatNumber($sumary->d_impression_us_uk)}}
                                            </div>
                                        </th>
                                    @endcan
                                    @can('reports-list-d_fill_rate')
                                        <th>
                                            <div>

                                            </div>
                                        </th>
                                    @endcan


                                    @can('reports-list-d_ecpm')
                                        <th>
                                            {{\App\Models\Formatter::formatNumber(round($sumary->d_ecpm, 2),2)}}
                                        </th>
                                    @endcan
                                    @can('reports-list-d_revenue')
                                        <th>
                                            {{\App\Models\Formatter::formatNumber(round($sumary->d_revenue,2), 2)}}
                                        </th>
                                    @endcan
                                    @can('reports-list-count')
                                        <th>
                                            {{round($sumary->count,2)}}
                                        </th>
                                    @endcan
                                    @can('reports-list-share')
                                        <th>
                                            {{round($sumary->share,2)}}
                                        </th>
                                    @endcan
                                    @can('reports-list-p_impression')
                                        <th>
                                            {{\App\Models\Formatter::formatNumber(round($sumary->p_impression))}}
                                        </th>
                                    @endcan
                                    @can('reports-list-p_ecpm')
                                        <th>
                                            {{round($sumary->p_ecpm,2)}}
                                        </th>
                                    @endcan
                                    @can('reports-list-p_revenue')
                                        <th>
                                            {{\App\Models\Formatter::formatNumber(round($sumary->p_revenue,2),2)}}
                                        </th>
                                    @endcan
                                    @can('reports-list-profit')
                                        <th>
                                            {{\App\Models\Formatter::formatNumber(round($sumary->profit,2),2)}}
                                        </th>
                                    @endcan
                                </tr>

                                <tr>
                                    <th onclick='onSortSearch(`date`, `{{ \App\Models\Helper::getValueInFilterReuquest('date') == "" ? "asc" : (\App\Models\Helper::getValueInFilterReuquest('date') != "desc" ? "desc" : "") }}`)'>
                                        <div>
                                            Date {!! \App\Models\Helper::getValueInFilterReuquest('date') == "" ? '<i class="fa-solid fa-sort"></i>' : (\App\Models\Helper::getValueInFilterReuquest('date') != "desc" ? '<i class="fa-solid fa-arrow-up-a-z text-success"></i>' : '<i class="fa-solid fa-arrow-down-z-a text-danger"></i>') !!}
                                        </div>
                                    </th>

                                    @can('reports-list-demand')
                                        <th onclick='onSortSearch(`demand_id`, `{{ \App\Models\Helper::getValueInFilterReuquest('demand_id') == "" ? "asc" : (\App\Models\Helper::getValueInFilterReuquest('demand_id') != "desc" ? "desc" : "") }}`)'>
                                            <div>
                                                Demand {!! \App\Models\Helper::getValueInFilterReuquest('demand_id') == "" ? '<i class="fa-solid fa-sort"></i>' : (\App\Models\Helper::getValueInFilterReuquest('demand_id') != "desc" ? '<i class="fa-solid fa-arrow-up-a-z text-success"></i>' : '<i class="fa-solid fa-arrow-down-z-a text-danger"></i>') !!}
                                            </div>
                                        </th>
                                    @endcan
                                    @can('reports-list-website')
                                        <th onclick='onSortSearch(`website_id`, `{{ \App\Models\Helper::getValueInFilterReuquest('website_id') == "" ? "asc" : (\App\Models\Helper::getValueInFilterReuquest('website_id') != "desc" ? "desc" : "") }}`)'>
                                            <div>
                                                Site {!! \App\Models\Helper::getValueInFilterReuquest('website_id') == "" ? '<i class="fa-solid fa-sort"></i>' : (\App\Models\Helper::getValueInFilterReuquest('website_id') != "desc" ? '<i class="fa-solid fa-arrow-up-a-z text-success"></i>' : '<i class="fa-solid fa-arrow-down-z-a text-danger"></i>') !!}
                                            </div>
                                        </th>
                                    @endcan
                                    @can('reports-list-zone_website')
                                        <th onclick='onSortSearch(`zone_website_id`, `{{ \App\Models\Helper::getValueInFilterReuquest('zone_website_id') == "" ? "asc" : (\App\Models\Helper::getValueInFilterReuquest('zone_website_id') != "desc" ? "desc" : "") }}`)'>
                                            <div>
                                                Zone
                                                ID {!! \App\Models\Helper::getValueInFilterReuquest('zone_website_id') == "" ? '<i class="fa-solid fa-sort"></i>' : (\App\Models\Helper::getValueInFilterReuquest('zone_website_id') != "desc" ? '<i class="fa-solid fa-arrow-up-a-z text-success"></i>' : '<i class="fa-solid fa-arrow-down-z-a text-danger"></i>') !!}
                                            </div>
                                        </th>

                                        <th>
                                            <div>
                                                Zone name
                                            </div>
                                        </th>
                                    @endcan

                                    @can('reports-list-d_request')
                                        <th>
                                            <div>
                                                D.Request
                                            </div>
                                        </th>
                                    @endcan
                                    @can('reports-list-d_impression')
                                        <th onclick='onSortSearch(`d_impression`, `{{ \App\Models\Helper::getValueInFilterReuquest('d_impression') == "" ? "asc" : (\App\Models\Helper::getValueInFilterReuquest('d_impression') != "desc" ? "desc" : "") }}`)'>
                                            <div>
                                                D.Impression {!! \App\Models\Helper::getValueInFilterReuquest('d_impression') == "" ? '<i class="fa-solid fa-sort"></i>' : (\App\Models\Helper::getValueInFilterReuquest('d_impression') != "desc" ? '<i class="fa-solid fa-arrow-up-a-z text-success"></i>' : '<i class="fa-solid fa-arrow-down-z-a text-danger"></i>') !!}
                                            </div>
                                        </th>
                                    @endcan

                                    @can('reports-list-d_impression_us_uk')
                                        <th>
                                            <div>
                                                D.Impression US, UK
                                            </div>
                                        </th>
                                    @endcan
                                    @can('reports-list-d_fill_rate')
                                        <th>
                                            <div>
                                                D.Fill Rate
                                            </div>
                                        </th>
                                    @endcan

                                    @can('reports-list-d_ecpm')
                                        <th onclick='onSortSearch(`d_ecpm`, `{{ \App\Models\Helper::getValueInFilterReuquest('d_ecpm') == "" ? "asc" : (\App\Models\Helper::getValueInFilterReuquest('d_ecpm') != "desc" ? "desc" : "") }}`)'>
                                            <div>
                                                D.eCPM
                                                ($) {!! \App\Models\Helper::getValueInFilterReuquest('d_ecpm') == "" ? '<i class="fa-solid fa-sort"></i>' : (\App\Models\Helper::getValueInFilterReuquest('d_ecpm') != "desc" ? '<i class="fa-solid fa-arrow-up-a-z text-success"></i>' : '<i class="fa-solid fa-arrow-down-z-a text-danger"></i>') !!}
                                            </div>
                                        </th>
                                    @endcan
                                    @can('reports-list-d_revenue')
                                        <th onclick='onSortSearch(`d_revenue`, `{{ \App\Models\Helper::getValueInFilterReuquest('d_revenue') == "" ? "asc" : (\App\Models\Helper::getValueInFilterReuquest('d_revenue') != "desc" ? "desc" : "") }}`)'>
                                            <div>
                                                D.Revenue
                                                ($) {!! \App\Models\Helper::getValueInFilterReuquest('d_revenue') == "" ? '<i class="fa-solid fa-sort"></i>' : (\App\Models\Helper::getValueInFilterReuquest('d_revenue') != "desc" ? '<i class="fa-solid fa-arrow-up-a-z text-success"></i>' : '<i class="fa-solid fa-arrow-down-z-a text-danger"></i>') !!}
                                            </div>
                                        </th>
                                    @endcan
                                    @can('reports-list-count')
                                        <th onclick='onSortSearch(`count`, `{{ \App\Models\Helper::getValueInFilterReuquest('count') == "" ? "asc" : (\App\Models\Helper::getValueInFilterReuquest('count') != "desc" ? "desc" : "") }}`)'>
                                            <div>
                                                -Count
                                                (%)- {!! \App\Models\Helper::getValueInFilterReuquest('count') == "" ? '<i class="fa-solid fa-sort"></i>' : (\App\Models\Helper::getValueInFilterReuquest('count') != "desc" ? '<i class="fa-solid fa-arrow-up-a-z text-success"></i>' : '<i class="fa-solid fa-arrow-down-z-a text-danger"></i>') !!}
                                            </div>
                                        </th>
                                    @endcan
                                    @can('reports-list-share')
                                        <th onclick='onSortSearch(`share`, `{{ \App\Models\Helper::getValueInFilterReuquest('share') == "" ? "asc" : (\App\Models\Helper::getValueInFilterReuquest('share') != "desc" ? "desc" : "") }}`)'>
                                            <div>
                                                -Share
                                                (%)- {!! \App\Models\Helper::getValueInFilterReuquest('share') == "" ? '<i class="fa-solid fa-sort"></i>' : (\App\Models\Helper::getValueInFilterReuquest('share') != "desc" ? '<i class="fa-solid fa-arrow-up-a-z text-success"></i>' : '<i class="fa-solid fa-arrow-down-z-a text-danger"></i>') !!}
                                            </div>
                                        </th>
                                    @endcan
                                    @can('reports-list-p_impression')
                                        <th onclick='onSortSearch(`p_impression`, `{{ \App\Models\Helper::getValueInFilterReuquest('p_impression') == "" ? "asc" : (\App\Models\Helper::getValueInFilterReuquest('p_impression') != "desc" ? "desc" : "") }}`)'>
                                            <div>
                                                P.impression {!! \App\Models\Helper::getValueInFilterReuquest('p_impression') == "" ? '<i class="fa-solid fa-sort"></i>' : (\App\Models\Helper::getValueInFilterReuquest('p_impression') != "desc" ? '<i class="fa-solid fa-arrow-up-a-z text-success"></i>' : '<i class="fa-solid fa-arrow-down-z-a text-danger"></i>') !!}
                                            </div>
                                        </th>
                                    @endcan
                                    @can('reports-list-p_ecpm')
                                        <th onclick='onSortSearch(`p_ecpm`, `{{ \App\Models\Helper::getValueInFilterReuquest('p_ecpm') == "" ? "asc" : (\App\Models\Helper::getValueInFilterReuquest('p_ecpm') != "desc" ? "desc" : "") }}`)'>
                                            <div>
                                                P.eCPM
                                                ($) {!! \App\Models\Helper::getValueInFilterReuquest('p_ecpm') == "" ? '<i class="fa-solid fa-sort"></i>' : (\App\Models\Helper::getValueInFilterReuquest('p_ecpm') != "desc" ? '<i class="fa-solid fa-arrow-up-a-z text-success"></i>' : '<i class="fa-solid fa-arrow-down-z-a text-danger"></i>') !!}
                                            </div>
                                        </th>
                                    @endcan
                                    @can('reports-list-p_revenue')
                                        <th onclick='onSortSearch(`p_revenue`, `{{ \App\Models\Helper::getValueInFilterReuquest('p_revenue') == "" ? "asc" : (\App\Models\Helper::getValueInFilterReuquest('p_revenue') != "desc" ? "desc" : "") }}`)'>
                                            <div>
                                                P.Revenue
                                                ($) {!! \App\Models\Helper::getValueInFilterReuquest('p_revenue') == "" ? '<i class="fa-solid fa-sort"></i>' : (\App\Models\Helper::getValueInFilterReuquest('p_revenue') != "desc" ? '<i class="fa-solid fa-arrow-up-a-z text-success"></i>' : '<i class="fa-solid fa-arrow-down-z-a text-danger"></i>') !!}
                                            </div>
                                        </th>
                                    @endcan
                                    @can('reports-list-profit')
                                        <th onclick='onSortSearch(`profit`, `{{ \App\Models\Helper::getValueInFilterReuquest('profit') == "" ? "asc" : (\App\Models\Helper::getValueInFilterReuquest('profit') != "desc" ? "desc" : "") }}`)'>
                                            <div>
                                                Profit {!! \App\Models\Helper::getValueInFilterReuquest('profit') == "" ? '<i class="fa-solid fa-sort"></i>' : (\App\Models\Helper::getValueInFilterReuquest('profit') != "desc" ? '<i class="fa-solid fa-arrow-up-a-z text-success"></i>' : '<i class="fa-solid fa-arrow-down-z-a text-danger"></i>') !!}
                                            </div>
                                        </th>
                                    @endcan

                                    @can('reports-list-status')
                                        <th onclick='onSortSearch(`report_status_id`, `{{ \App\Models\Helper::getValueInFilterReuquest('report_status_id') == "" ? "asc" : (\App\Models\Helper::getValueInFilterReuquest('report_status_id') != "desc" ? "desc" : "") }}`)'>
                                            <div>
                                                Status {!! \App\Models\Helper::getValueInFilterReuquest('report_status_id') == "" ? '<i class="fa-solid fa-sort"></i>' : (\App\Models\Helper::getValueInFilterReuquest('report_status_id') != "desc" ? '<i class="fa-solid fa-arrow-up-a-z text-success"></i>' : '<i class="fa-solid fa-arrow-down-z-a text-danger"></i>') !!}
                                            </div>
                                        </th>
                                    @endcan
                                </tr>
                                </thead>
                                <tbody class="" id="body_container_item">
                                @foreach($items as $index => $item)
                                    @include('administrator.'.$prefixView.'.row', ['item' => $item, 'prefixView' => $prefixView, 'index' => $index, 'showColums'=>$showColums])
                                @endforeach

                                </tbody>

                                <tfoot>

                                <tr>
                                    @foreach($showColums as $showColum)
                                        <th onclick='onSortSearch($showColum, `{{ \App\Models\Helper::getValueInFilterReuquest($showColum) == "" ? "asc" : (\App\Models\Helper::getValueInFilterReuquest($showColum) != "desc" ? "desc" : "") }}`)'>
                                            <div>
                                                {{$showColum}} {!! \App\Models\Helper::getValueInFilterReuquest($showColum) == "" ? '<i class="fa-solid fa-sort"></i>' : (\App\Models\Helper::getValueInFilterReuquest($showColum) != "desc" ? '<i class="fa-solid fa-arrow-up-a-z text-success"></i>' : '<i class="fa-solid fa-arrow-down-z-a text-danger"></i>') !!}
                                            </div>
                                        </th>
                                    @endforeach

                                    <th onclick='onSortSearch(`date`, `{{ \App\Models\Helper::getValueInFilterReuquest('date') == "" ? "asc" : (\App\Models\Helper::getValueInFilterReuquest('date') != "desc" ? "desc" : "") }}`)'>
                                        <div>
                                            Date {!! \App\Models\Helper::getValueInFilterReuquest('date') == "" ? '<i class="fa-solid fa-sort"></i>' : (\App\Models\Helper::getValueInFilterReuquest('date') != "desc" ? '<i class="fa-solid fa-arrow-up-a-z text-success"></i>' : '<i class="fa-solid fa-arrow-down-z-a text-danger"></i>') !!}
                                        </div>
                                    </th>

                                    @can('reports-list-demand')
                                        <th onclick='onSortSearch(`demand_id`, `{{ \App\Models\Helper::getValueInFilterReuquest('demand_id') == "" ? "asc" : (\App\Models\Helper::getValueInFilterReuquest('demand_id') != "desc" ? "desc" : "") }}`)'>
                                            <div>
                                                Demand {!! \App\Models\Helper::getValueInFilterReuquest('demand_id') == "" ? '<i class="fa-solid fa-sort"></i>' : (\App\Models\Helper::getValueInFilterReuquest('demand_id') != "desc" ? '<i class="fa-solid fa-arrow-up-a-z text-success"></i>' : '<i class="fa-solid fa-arrow-down-z-a text-danger"></i>') !!}
                                            </div>
                                        </th>
                                    @endcan
                                    @can('reports-list-website')
                                        <th onclick='onSortSearch(`website_id`, `{{ \App\Models\Helper::getValueInFilterReuquest('website_id') == "" ? "asc" : (\App\Models\Helper::getValueInFilterReuquest('website_id') != "desc" ? "desc" : "") }}`)'>
                                            <div>
                                                Site {!! \App\Models\Helper::getValueInFilterReuquest('website_id') == "" ? '<i class="fa-solid fa-sort"></i>' : (\App\Models\Helper::getValueInFilterReuquest('website_id') != "desc" ? '<i class="fa-solid fa-arrow-up-a-z text-success"></i>' : '<i class="fa-solid fa-arrow-down-z-a text-danger"></i>') !!}
                                            </div>
                                        </th>
                                    @endcan
                                    @can('reports-list-zone_website')
                                        <th onclick='onSortSearch(`zone_website_id`, `{{ \App\Models\Helper::getValueInFilterReuquest('zone_website_id') == "" ? "asc" : (\App\Models\Helper::getValueInFilterReuquest('zone_website_id') != "desc" ? "desc" : "") }}`)'>
                                            <div>
                                                Zone
                                                ID {!! \App\Models\Helper::getValueInFilterReuquest('zone_website_id') == "" ? '<i class="fa-solid fa-sort"></i>' : (\App\Models\Helper::getValueInFilterReuquest('zone_website_id') != "desc" ? '<i class="fa-solid fa-arrow-up-a-z text-success"></i>' : '<i class="fa-solid fa-arrow-down-z-a text-danger"></i>') !!}
                                            </div>
                                        </th>

                                        <th>
                                            <div>
                                                Zone name
                                            </div>
                                        </th>
                                    @endcan

                                    @can('reports-list-d_request')
                                        <th>
                                            <div>
                                                D.Request
                                            </div>
                                        </th>
                                    @endcan
                                    @can('reports-list-d_impression')
                                        <th onclick='onSortSearch(`d_impression`, `{{ \App\Models\Helper::getValueInFilterReuquest('d_impression') == "" ? "asc" : (\App\Models\Helper::getValueInFilterReuquest('d_impression') != "desc" ? "desc" : "") }}`)'>
                                            <div>
                                                D.Impression {!! \App\Models\Helper::getValueInFilterReuquest('d_impression') == "" ? '<i class="fa-solid fa-sort"></i>' : (\App\Models\Helper::getValueInFilterReuquest('d_impression') != "desc" ? '<i class="fa-solid fa-arrow-up-a-z text-success"></i>' : '<i class="fa-solid fa-arrow-down-z-a text-danger"></i>') !!}
                                            </div>
                                        </th>
                                    @endcan

                                    @can('reports-list-d_impression_us_uk')
                                        <th>
                                            <div>
                                                D.Impression US, UK
                                            </div>
                                        </th>
                                    @endcan
                                    @can('reports-list-d_fill_rate')
                                        <th>
                                            <div>
                                                D.Fill Rate
                                            </div>
                                        </th>
                                    @endcan

                                    @can('reports-list-d_ecpm')
                                        <th onclick='onSortSearch(`d_ecpm`, `{{ \App\Models\Helper::getValueInFilterReuquest('d_ecpm') == "" ? "asc" : (\App\Models\Helper::getValueInFilterReuquest('d_ecpm') != "desc" ? "desc" : "") }}`)'>
                                            <div>
                                                D.eCPM
                                                ($) {!! \App\Models\Helper::getValueInFilterReuquest('d_ecpm') == "" ? '<i class="fa-solid fa-sort"></i>' : (\App\Models\Helper::getValueInFilterReuquest('d_ecpm') != "desc" ? '<i class="fa-solid fa-arrow-up-a-z text-success"></i>' : '<i class="fa-solid fa-arrow-down-z-a text-danger"></i>') !!}
                                            </div>
                                        </th>
                                    @endcan
                                    @can('reports-list-d_revenue')
                                        <th onclick='onSortSearch(`d_revenue`, `{{ \App\Models\Helper::getValueInFilterReuquest('d_revenue') == "" ? "asc" : (\App\Models\Helper::getValueInFilterReuquest('d_revenue') != "desc" ? "desc" : "") }}`)'>
                                            <div>
                                                D.Revenue
                                                ($) {!! \App\Models\Helper::getValueInFilterReuquest('d_revenue') == "" ? '<i class="fa-solid fa-sort"></i>' : (\App\Models\Helper::getValueInFilterReuquest('d_revenue') != "desc" ? '<i class="fa-solid fa-arrow-up-a-z text-success"></i>' : '<i class="fa-solid fa-arrow-down-z-a text-danger"></i>') !!}
                                            </div>
                                        </th>
                                    @endcan
                                    @can('reports-list-count')
                                        <th onclick='onSortSearch(`count`, `{{ \App\Models\Helper::getValueInFilterReuquest('count') == "" ? "asc" : (\App\Models\Helper::getValueInFilterReuquest('count') != "desc" ? "desc" : "") }}`)'>
                                            <div>
                                                -Count
                                                (%)- {!! \App\Models\Helper::getValueInFilterReuquest('count') == "" ? '<i class="fa-solid fa-sort"></i>' : (\App\Models\Helper::getValueInFilterReuquest('count') != "desc" ? '<i class="fa-solid fa-arrow-up-a-z text-success"></i>' : '<i class="fa-solid fa-arrow-down-z-a text-danger"></i>') !!}
                                            </div>
                                        </th>
                                    @endcan
                                    @can('reports-list-share')
                                        <th onclick='onSortSearch(`share`, `{{ \App\Models\Helper::getValueInFilterReuquest('share') == "" ? "asc" : (\App\Models\Helper::getValueInFilterReuquest('share') != "desc" ? "desc" : "") }}`)'>
                                            <div>
                                                -Share
                                                (%)- {!! \App\Models\Helper::getValueInFilterReuquest('share') == "" ? '<i class="fa-solid fa-sort"></i>' : (\App\Models\Helper::getValueInFilterReuquest('share') != "desc" ? '<i class="fa-solid fa-arrow-up-a-z text-success"></i>' : '<i class="fa-solid fa-arrow-down-z-a text-danger"></i>') !!}
                                            </div>
                                        </th>
                                    @endcan
                                    @can('reports-list-p_impression')
                                        <th onclick='onSortSearch(`p_impression`, `{{ \App\Models\Helper::getValueInFilterReuquest('p_impression') == "" ? "asc" : (\App\Models\Helper::getValueInFilterReuquest('p_impression') != "desc" ? "desc" : "") }}`)'>
                                            <div>
                                                P.impression {!! \App\Models\Helper::getValueInFilterReuquest('p_impression') == "" ? '<i class="fa-solid fa-sort"></i>' : (\App\Models\Helper::getValueInFilterReuquest('p_impression') != "desc" ? '<i class="fa-solid fa-arrow-up-a-z text-success"></i>' : '<i class="fa-solid fa-arrow-down-z-a text-danger"></i>') !!}
                                            </div>
                                        </th>
                                    @endcan
                                    @can('reports-list-p_ecpm')
                                        <th onclick='onSortSearch(`p_ecpm`, `{{ \App\Models\Helper::getValueInFilterReuquest('p_ecpm') == "" ? "asc" : (\App\Models\Helper::getValueInFilterReuquest('p_ecpm') != "desc" ? "desc" : "") }}`)'>
                                            <div>
                                                P.eCPM
                                                ($) {!! \App\Models\Helper::getValueInFilterReuquest('p_ecpm') == "" ? '<i class="fa-solid fa-sort"></i>' : (\App\Models\Helper::getValueInFilterReuquest('p_ecpm') != "desc" ? '<i class="fa-solid fa-arrow-up-a-z text-success"></i>' : '<i class="fa-solid fa-arrow-down-z-a text-danger"></i>') !!}
                                            </div>
                                        </th>
                                    @endcan
                                    @can('reports-list-p_revenue')
                                        <th onclick='onSortSearch(`p_revenue`, `{{ \App\Models\Helper::getValueInFilterReuquest('p_revenue') == "" ? "asc" : (\App\Models\Helper::getValueInFilterReuquest('p_revenue') != "desc" ? "desc" : "") }}`)'>
                                            <div>
                                                P.Revenue
                                                ($) {!! \App\Models\Helper::getValueInFilterReuquest('p_revenue') == "" ? '<i class="fa-solid fa-sort"></i>' : (\App\Models\Helper::getValueInFilterReuquest('p_revenue') != "desc" ? '<i class="fa-solid fa-arrow-up-a-z text-success"></i>' : '<i class="fa-solid fa-arrow-down-z-a text-danger"></i>') !!}
                                            </div>
                                        </th>
                                    @endcan
                                    @can('reports-list-profit')
                                        <th onclick='onSortSearch(`profit`, `{{ \App\Models\Helper::getValueInFilterReuquest('profit') == "" ? "asc" : (\App\Models\Helper::getValueInFilterReuquest('profit') != "desc" ? "desc" : "") }}`)'>
                                            <div>
                                                Profit {!! \App\Models\Helper::getValueInFilterReuquest('profit') == "" ? '<i class="fa-solid fa-sort"></i>' : (\App\Models\Helper::getValueInFilterReuquest('profit') != "desc" ? '<i class="fa-solid fa-arrow-up-a-z text-success"></i>' : '<i class="fa-solid fa-arrow-down-z-a text-danger"></i>') !!}
                                            </div>
                                        </th>
                                    @endcan

                                    @can('reports-list-status')
                                        <th onclick='onSortSearch(`report_status_id`, `{{ \App\Models\Helper::getValueInFilterReuquest('report_status_id') == "" ? "asc" : (\App\Models\Helper::getValueInFilterReuquest('report_status_id') != "desc" ? "desc" : "") }}`)'>
                                            <div>
                                                Status {!! \App\Models\Helper::getValueInFilterReuquest('report_status_id') == "" ? '<i class="fa-solid fa-sort"></i>' : (\App\Models\Helper::getValueInFilterReuquest('report_status_id') != "desc" ? '<i class="fa-solid fa-arrow-up-a-z text-success"></i>' : '<i class="fa-solid fa-arrow-down-z-a text-danger"></i>') !!}
                                            </div>
                                        </th>
                                    @endcan
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

    {{--    <script>--}}
    {{--        const checkboxes = document.querySelectorAll('.form-check-input');--}}

    {{--        const selectAllBtn = document.getElementById('filter_btn_select_all');--}}


    {{--        // Toggle Select All / Clear All--}}
    {{--        selectAllBtn.addEventListener('click', () => {--}}
    {{--            const allChecked = Array.from(checkboxes).every(cb => cb.checked);--}}
    {{--            checkboxes.forEach(cb => cb.checked = !allChecked);--}}
    {{--            selectAllBtn.textContent = allChecked ? 'Select All' : 'Clear All';--}}
    {{--        });--}}

    {{--        function onResearch() {--}}
    {{--            const checked = document.querySelectorAll('.items-research:checked');--}}

    {{--            // Convert NodeList to array of values--}}
    {{--            const values = Array.from(checked).map(cb => cb.value);--}}

    {{--            addUrlParameter("show_colums", values)--}}
    {{--        }--}}
    {{--    </script>--}}
@endsection


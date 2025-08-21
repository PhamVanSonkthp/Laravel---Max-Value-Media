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
                                    <th>
                                        <div class="dropdown">
                                            <button
                                                class="btn btn-outline-secondary dropdown-toggle d-flex align-items-center gap-2"
                                                type="button" data-bs-toggle="dropdown" data-bs-auto-close="outside"
                                                aria-expanded="false">
                                                <i class="fa fa-filter"></i>
                                            </button>
                                            <ul class="dropdown-menu p-3">
                                                <li class="mb-2">
                                                    <button class="btn btn-sm btn-primary w-100"
                                                            id="filter_btn_select_all">Select All
                                                    </button>
                                                </li>
                                                <li>
                                                    <hr class="dropdown-divider">
                                                </li>

                                                @foreach($modelColums as $modelColum)
                                                    <li>
                                                        <div class="form-check">
                                                            <input class="form-check-input items-research"
                                                                   type="checkbox" value="{{$modelColum}}"
                                                                   id="item{{$modelColum}}" {{in_array($modelColum, $showColums) ? 'checked' : ''}} >
                                                            <label class="form-check-label"
                                                                   for="item{{$modelColum}}">{{$modelColum}}</label>
                                                        </div>
                                                    </li>
                                                @endforeach
                                                <li>
                                                    <button class="btn btn-outline-primary mt-2" onclick="onResearch()"
                                                            type="button"><i class="fa-solid fa-magnifying-glass"></i>Research
                                                    </button>
                                                </li>
                                            </ul>

                                        </div>
                                    </th>

                                    <th colspan="{{count($showColums) + 4}}">
                                        Sumary
                                    </th>
                                    @if(in_array("d_request",$modelColums))
                                        <th>
                                            {{\App\Models\Formatter::formatNumber($sumary->d_request)}}
                                        </th>
                                    @endif
                                    @if(in_array("d_impression",$modelColums))
                                        <th>
                                            {{\App\Models\Formatter::formatNumber($sumary->d_impression)}}
                                        </th>
                                    @endif
                                    @if(in_array("d_ecpm",$modelColums))
                                        <th>
                                            {{\App\Models\Formatter::formatNumber(round($sumary->d_ecpm, 2),2)}}
                                        </th>
                                    @endif
                                    @if(in_array("d_revenue",$modelColums))
                                        <th>
                                            {{\App\Models\Formatter::formatNumber(round($sumary->d_revenue,2), 2)}}
                                        </th>
                                    @endif
                                    @if(in_array("count",$modelColums))
                                        <th>
                                            {{round($sumary->count,2)}}
                                        </th>
                                    @endif
                                    @if(in_array("share",$modelColums))
                                        <th>
                                            {{round($sumary->share,2)}}
                                        </th>
                                    @endif
                                    @if(in_array("p_impression",$modelColums))
                                        <th>
                                            {{\App\Models\Formatter::formatNumber(round($sumary->p_impression))}}
                                        </th>
                                    @endif
                                    @if(in_array("p_ecpm",$modelColums))
                                        <th>
                                            {{round($sumary->p_ecpm,2)}}
                                        </th>
                                    @endif
                                    @if(in_array("p_revenue",$modelColums))
                                        <th>
                                            {{\App\Models\Formatter::formatNumber(round($sumary->p_revenue,2),2)}}
                                        </th>
                                    @endif
                                    @if(in_array("profit",$modelColums))
                                        <th>
                                            {{\App\Models\Formatter::formatNumber(round($sumary->profit,2),2)}}
                                        </th>
                                    @endif
                                </tr>

                                <tr>
                                    @foreach($showColums as $showColum)
                                        <th onclick='onSortSearch($showColum, `{{ \App\Models\Helper::getValueInFilterReuquest($showColum) == "" ? "asc" : (\App\Models\Helper::getValueInFilterReuquest($showColum) != "desc" ? "desc" : "") }}`)'>
                                            <div>
                                                {{$showColum}} {!! \App\Models\Helper::getValueInFilterReuquest($showColum) == "" ? '<i class="fa-solid fa-sort"></i>' : (\App\Models\Helper::getValueInFilterReuquest($showColum) != "desc" ? '<i class="fa-solid fa-arrow-up-a-z text-success"></i>' : '<i class="fa-solid fa-arrow-down-z-a text-danger"></i>') !!}
                                            </div>
                                        </th>
                                    @endforeach

                                    @if(in_array("date",$modelColums))
                                        <th onclick='onSortSearch(`date`, `{{ \App\Models\Helper::getValueInFilterReuquest('date') == "" ? "asc" : (\App\Models\Helper::getValueInFilterReuquest('date') != "desc" ? "desc" : "") }}`)'>
                                            <div>
                                                Date {!! \App\Models\Helper::getValueInFilterReuquest('date') == "" ? '<i class="fa-solid fa-sort"></i>' : (\App\Models\Helper::getValueInFilterReuquest('date') != "desc" ? '<i class="fa-solid fa-arrow-up-a-z text-success"></i>' : '<i class="fa-solid fa-arrow-down-z-a text-danger"></i>') !!}
                                            </div>
                                        </th>
                                    @endif
                                    @if(in_array("demand_id",$modelColums))
                                        <th onclick='onSortSearch(`demand_id`, `{{ \App\Models\Helper::getValueInFilterReuquest('demand_id') == "" ? "asc" : (\App\Models\Helper::getValueInFilterReuquest('demand_id') != "desc" ? "desc" : "") }}`)'>
                                            <div>
                                                Demand {!! \App\Models\Helper::getValueInFilterReuquest('demand_id') == "" ? '<i class="fa-solid fa-sort"></i>' : (\App\Models\Helper::getValueInFilterReuquest('demand_id') != "desc" ? '<i class="fa-solid fa-arrow-up-a-z text-success"></i>' : '<i class="fa-solid fa-arrow-down-z-a text-danger"></i>') !!}
                                            </div>
                                        </th>
                                    @endif
                                    @if(in_array("demand_id",$modelColums))
                                        <th onclick='onSortSearch(`website_id`, `{{ \App\Models\Helper::getValueInFilterReuquest('website_id') == "" ? "asc" : (\App\Models\Helper::getValueInFilterReuquest('website_id') != "desc" ? "desc" : "") }}`)'>
                                            <div>
                                                Site {!! \App\Models\Helper::getValueInFilterReuquest('website_id') == "" ? '<i class="fa-solid fa-sort"></i>' : (\App\Models\Helper::getValueInFilterReuquest('website_id') != "desc" ? '<i class="fa-solid fa-arrow-up-a-z text-success"></i>' : '<i class="fa-solid fa-arrow-down-z-a text-danger"></i>') !!}
                                            </div>
                                        </th>
                                    @endif
                                    @if(in_array("zone_website_id",$modelColums))
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
                                    @endif

                                    @if(in_array("d_request",$modelColums))
                                        <th onclick='onSortSearch(`d_request`, `{{ \App\Models\Helper::getValueInFilterReuquest('d_request') == "" ? "asc" : (\App\Models\Helper::getValueInFilterReuquest('d_request') != "desc" ? "desc" : "") }}`)'>
                                            <div>
                                                D.Request {!! \App\Models\Helper::getValueInFilterReuquest('d_request') == "" ? '<i class="fa-solid fa-sort"></i>' : (\App\Models\Helper::getValueInFilterReuquest('d_request') != "desc" ? '<i class="fa-solid fa-arrow-up-a-z text-success"></i>' : '<i class="fa-solid fa-arrow-down-z-a text-danger"></i>') !!}
                                            </div>
                                        </th>
                                    @endif
                                    @if(in_array("d_impression",$modelColums))
                                        <th onclick='onSortSearch(`d_impression`, `{{ \App\Models\Helper::getValueInFilterReuquest('d_impression') == "" ? "asc" : (\App\Models\Helper::getValueInFilterReuquest('d_impression') != "desc" ? "desc" : "") }}`)'>
                                            <div>
                                                D.Impression {!! \App\Models\Helper::getValueInFilterReuquest('d_impression') == "" ? '<i class="fa-solid fa-sort"></i>' : (\App\Models\Helper::getValueInFilterReuquest('d_impression') != "desc" ? '<i class="fa-solid fa-arrow-up-a-z text-success"></i>' : '<i class="fa-solid fa-arrow-down-z-a text-danger"></i>') !!}
                                            </div>
                                        </th>
                                    @endif
                                    @if(in_array("d_ecpm",$modelColums))
                                        <th onclick='onSortSearch(`d_ecpm`, `{{ \App\Models\Helper::getValueInFilterReuquest('d_ecpm') == "" ? "asc" : (\App\Models\Helper::getValueInFilterReuquest('d_ecpm') != "desc" ? "desc" : "") }}`)'>
                                            <div>
                                                D.eCPM
                                                ($) {!! \App\Models\Helper::getValueInFilterReuquest('d_ecpm') == "" ? '<i class="fa-solid fa-sort"></i>' : (\App\Models\Helper::getValueInFilterReuquest('d_ecpm') != "desc" ? '<i class="fa-solid fa-arrow-up-a-z text-success"></i>' : '<i class="fa-solid fa-arrow-down-z-a text-danger"></i>') !!}
                                            </div>
                                        </th>
                                    @endif
                                    @if(in_array("d_revenue",$modelColums))
                                        <th onclick='onSortSearch(`d_revenue`, `{{ \App\Models\Helper::getValueInFilterReuquest('d_revenue') == "" ? "asc" : (\App\Models\Helper::getValueInFilterReuquest('d_revenue') != "desc" ? "desc" : "") }}`)'>
                                            <div>
                                                D.Revenue
                                                ($) {!! \App\Models\Helper::getValueInFilterReuquest('d_revenue') == "" ? '<i class="fa-solid fa-sort"></i>' : (\App\Models\Helper::getValueInFilterReuquest('d_revenue') != "desc" ? '<i class="fa-solid fa-arrow-up-a-z text-success"></i>' : '<i class="fa-solid fa-arrow-down-z-a text-danger"></i>') !!}
                                            </div>
                                        </th>
                                    @endif
                                    @if(in_array("count",$modelColums))
                                        <th onclick='onSortSearch(`count`, `{{ \App\Models\Helper::getValueInFilterReuquest('count') == "" ? "asc" : (\App\Models\Helper::getValueInFilterReuquest('count') != "desc" ? "desc" : "") }}`)'>
                                            <div>
                                                -Count
                                                (%)- {!! \App\Models\Helper::getValueInFilterReuquest('count') == "" ? '<i class="fa-solid fa-sort"></i>' : (\App\Models\Helper::getValueInFilterReuquest('count') != "desc" ? '<i class="fa-solid fa-arrow-up-a-z text-success"></i>' : '<i class="fa-solid fa-arrow-down-z-a text-danger"></i>') !!}
                                            </div>
                                        </th>
                                    @endif
                                    @if(in_array("share",$modelColums))
                                        <th onclick='onSortSearch(`share`, `{{ \App\Models\Helper::getValueInFilterReuquest('share') == "" ? "asc" : (\App\Models\Helper::getValueInFilterReuquest('share') != "desc" ? "desc" : "") }}`)'>
                                            <div>
                                                -Share
                                                (%)- {!! \App\Models\Helper::getValueInFilterReuquest('share') == "" ? '<i class="fa-solid fa-sort"></i>' : (\App\Models\Helper::getValueInFilterReuquest('share') != "desc" ? '<i class="fa-solid fa-arrow-up-a-z text-success"></i>' : '<i class="fa-solid fa-arrow-down-z-a text-danger"></i>') !!}
                                            </div>
                                        </th>
                                    @endif
                                    @if(in_array("p_impression",$modelColums))
                                        <th onclick='onSortSearch(`p_impression`, `{{ \App\Models\Helper::getValueInFilterReuquest('p_impression') == "" ? "asc" : (\App\Models\Helper::getValueInFilterReuquest('p_impression') != "desc" ? "desc" : "") }}`)'>
                                            <div>
                                                P.impression {!! \App\Models\Helper::getValueInFilterReuquest('p_impression') == "" ? '<i class="fa-solid fa-sort"></i>' : (\App\Models\Helper::getValueInFilterReuquest('p_impression') != "desc" ? '<i class="fa-solid fa-arrow-up-a-z text-success"></i>' : '<i class="fa-solid fa-arrow-down-z-a text-danger"></i>') !!}
                                            </div>
                                        </th>
                                    @endif
                                    @if(in_array("p_ecpm",$modelColums))
                                        <th onclick='onSortSearch(`p_ecpm`, `{{ \App\Models\Helper::getValueInFilterReuquest('p_ecpm') == "" ? "asc" : (\App\Models\Helper::getValueInFilterReuquest('p_ecpm') != "desc" ? "desc" : "") }}`)'>
                                            <div>
                                                P.eCPM
                                                ($) {!! \App\Models\Helper::getValueInFilterReuquest('p_ecpm') == "" ? '<i class="fa-solid fa-sort"></i>' : (\App\Models\Helper::getValueInFilterReuquest('p_ecpm') != "desc" ? '<i class="fa-solid fa-arrow-up-a-z text-success"></i>' : '<i class="fa-solid fa-arrow-down-z-a text-danger"></i>') !!}
                                            </div>
                                        </th>
                                    @endif
                                    @if(in_array("p_revenue",$modelColums))
                                        <th onclick='onSortSearch(`p_revenue`, `{{ \App\Models\Helper::getValueInFilterReuquest('p_revenue') == "" ? "asc" : (\App\Models\Helper::getValueInFilterReuquest('p_revenue') != "desc" ? "desc" : "") }}`)'>
                                            <div>
                                                P.Revenue
                                                ($) {!! \App\Models\Helper::getValueInFilterReuquest('p_revenue') == "" ? '<i class="fa-solid fa-sort"></i>' : (\App\Models\Helper::getValueInFilterReuquest('p_revenue') != "desc" ? '<i class="fa-solid fa-arrow-up-a-z text-success"></i>' : '<i class="fa-solid fa-arrow-down-z-a text-danger"></i>') !!}
                                            </div>
                                        </th>
                                    @endif
                                    @if(in_array("profit",$modelColums))
                                        <th onclick='onSortSearch(`profit`, `{{ \App\Models\Helper::getValueInFilterReuquest('profit') == "" ? "asc" : (\App\Models\Helper::getValueInFilterReuquest('profit') != "desc" ? "desc" : "") }}`)'>
                                            <div>
                                                Profit {!! \App\Models\Helper::getValueInFilterReuquest('profit') == "" ? '<i class="fa-solid fa-sort"></i>' : (\App\Models\Helper::getValueInFilterReuquest('profit') != "desc" ? '<i class="fa-solid fa-arrow-up-a-z text-success"></i>' : '<i class="fa-solid fa-arrow-down-z-a text-danger"></i>') !!}
                                            </div>
                                        </th>
                                    @endif
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

                                    @if(in_array("date",$modelColums))
                                        <th onclick='onSortSearch(`date`, `{{ \App\Models\Helper::getValueInFilterReuquest('date') == "" ? "asc" : (\App\Models\Helper::getValueInFilterReuquest('date') != "desc" ? "desc" : "") }}`)'>
                                            <div>
                                                Date {!! \App\Models\Helper::getValueInFilterReuquest('date') == "" ? '<i class="fa-solid fa-sort"></i>' : (\App\Models\Helper::getValueInFilterReuquest('date') != "desc" ? '<i class="fa-solid fa-arrow-up-a-z text-success"></i>' : '<i class="fa-solid fa-arrow-down-z-a text-danger"></i>') !!}
                                            </div>
                                        </th>
                                    @endif
                                    @if(in_array("demand_id",$modelColums))
                                        <th onclick='onSortSearch(`demand_id`, `{{ \App\Models\Helper::getValueInFilterReuquest('demand_id') == "" ? "asc" : (\App\Models\Helper::getValueInFilterReuquest('demand_id') != "desc" ? "desc" : "") }}`)'>
                                            <div>
                                                Demand {!! \App\Models\Helper::getValueInFilterReuquest('demand_id') == "" ? '<i class="fa-solid fa-sort"></i>' : (\App\Models\Helper::getValueInFilterReuquest('demand_id') != "desc" ? '<i class="fa-solid fa-arrow-up-a-z text-success"></i>' : '<i class="fa-solid fa-arrow-down-z-a text-danger"></i>') !!}
                                            </div>
                                        </th>
                                    @endif
                                    @if(in_array("demand_id",$modelColums))
                                        <th onclick='onSortSearch(`website_id`, `{{ \App\Models\Helper::getValueInFilterReuquest('website_id') == "" ? "asc" : (\App\Models\Helper::getValueInFilterReuquest('website_id') != "desc" ? "desc" : "") }}`)'>
                                            <div>
                                                Site {!! \App\Models\Helper::getValueInFilterReuquest('website_id') == "" ? '<i class="fa-solid fa-sort"></i>' : (\App\Models\Helper::getValueInFilterReuquest('website_id') != "desc" ? '<i class="fa-solid fa-arrow-up-a-z text-success"></i>' : '<i class="fa-solid fa-arrow-down-z-a text-danger"></i>') !!}
                                            </div>
                                        </th>
                                    @endif
                                    @if(in_array("zone_website_id",$modelColums))
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
                                    @endif

                                    @if(in_array("d_request",$modelColums))
                                        <th onclick='onSortSearch(`d_request`, `{{ \App\Models\Helper::getValueInFilterReuquest('d_request') == "" ? "asc" : (\App\Models\Helper::getValueInFilterReuquest('d_request') != "desc" ? "desc" : "") }}`)'>
                                            <div>
                                                D.Request {!! \App\Models\Helper::getValueInFilterReuquest('d_request') == "" ? '<i class="fa-solid fa-sort"></i>' : (\App\Models\Helper::getValueInFilterReuquest('d_request') != "desc" ? '<i class="fa-solid fa-arrow-up-a-z text-success"></i>' : '<i class="fa-solid fa-arrow-down-z-a text-danger"></i>') !!}
                                            </div>
                                        </th>
                                    @endif
                                    @if(in_array("d_impression",$modelColums))
                                        <th onclick='onSortSearch(`d_impression`, `{{ \App\Models\Helper::getValueInFilterReuquest('d_impression') == "" ? "asc" : (\App\Models\Helper::getValueInFilterReuquest('d_impression') != "desc" ? "desc" : "") }}`)'>
                                            <div>
                                                D.Impression {!! \App\Models\Helper::getValueInFilterReuquest('d_impression') == "" ? '<i class="fa-solid fa-sort"></i>' : (\App\Models\Helper::getValueInFilterReuquest('d_impression') != "desc" ? '<i class="fa-solid fa-arrow-up-a-z text-success"></i>' : '<i class="fa-solid fa-arrow-down-z-a text-danger"></i>') !!}
                                            </div>
                                        </th>
                                    @endif
                                    @if(in_array("d_ecpm",$modelColums))
                                        <th onclick='onSortSearch(`d_ecpm`, `{{ \App\Models\Helper::getValueInFilterReuquest('d_ecpm') == "" ? "asc" : (\App\Models\Helper::getValueInFilterReuquest('d_ecpm') != "desc" ? "desc" : "") }}`)'>
                                            <div>
                                                D.eCPM
                                                ($) {!! \App\Models\Helper::getValueInFilterReuquest('d_ecpm') == "" ? '<i class="fa-solid fa-sort"></i>' : (\App\Models\Helper::getValueInFilterReuquest('d_ecpm') != "desc" ? '<i class="fa-solid fa-arrow-up-a-z text-success"></i>' : '<i class="fa-solid fa-arrow-down-z-a text-danger"></i>') !!}
                                            </div>
                                        </th>
                                    @endif
                                    @if(in_array("d_revenue",$modelColums))
                                        <th onclick='onSortSearch(`d_revenue`, `{{ \App\Models\Helper::getValueInFilterReuquest('d_revenue') == "" ? "asc" : (\App\Models\Helper::getValueInFilterReuquest('d_revenue') != "desc" ? "desc" : "") }}`)'>
                                            <div>
                                                D.Revenue
                                                ($) {!! \App\Models\Helper::getValueInFilterReuquest('d_revenue') == "" ? '<i class="fa-solid fa-sort"></i>' : (\App\Models\Helper::getValueInFilterReuquest('d_revenue') != "desc" ? '<i class="fa-solid fa-arrow-up-a-z text-success"></i>' : '<i class="fa-solid fa-arrow-down-z-a text-danger"></i>') !!}
                                            </div>
                                        </th>
                                    @endif
                                    @if(in_array("count",$modelColums))
                                        <th onclick='onSortSearch(`count`, `{{ \App\Models\Helper::getValueInFilterReuquest('count') == "" ? "asc" : (\App\Models\Helper::getValueInFilterReuquest('count') != "desc" ? "desc" : "") }}`)'>
                                            <div>
                                                -Count
                                                (%)- {!! \App\Models\Helper::getValueInFilterReuquest('count') == "" ? '<i class="fa-solid fa-sort"></i>' : (\App\Models\Helper::getValueInFilterReuquest('count') != "desc" ? '<i class="fa-solid fa-arrow-up-a-z text-success"></i>' : '<i class="fa-solid fa-arrow-down-z-a text-danger"></i>') !!}
                                            </div>
                                        </th>
                                    @endif
                                    @if(in_array("share",$modelColums))
                                        <th onclick='onSortSearch(`share`, `{{ \App\Models\Helper::getValueInFilterReuquest('share') == "" ? "asc" : (\App\Models\Helper::getValueInFilterReuquest('share') != "desc" ? "desc" : "") }}`)'>
                                            <div>
                                                -Share
                                                (%)- {!! \App\Models\Helper::getValueInFilterReuquest('share') == "" ? '<i class="fa-solid fa-sort"></i>' : (\App\Models\Helper::getValueInFilterReuquest('share') != "desc" ? '<i class="fa-solid fa-arrow-up-a-z text-success"></i>' : '<i class="fa-solid fa-arrow-down-z-a text-danger"></i>') !!}
                                            </div>
                                        </th>
                                    @endif
                                    @if(in_array("p_impression",$modelColums))
                                        <th onclick='onSortSearch(`p_impression`, `{{ \App\Models\Helper::getValueInFilterReuquest('p_impression') == "" ? "asc" : (\App\Models\Helper::getValueInFilterReuquest('p_impression') != "desc" ? "desc" : "") }}`)'>
                                            <div>
                                                P.impression {!! \App\Models\Helper::getValueInFilterReuquest('p_impression') == "" ? '<i class="fa-solid fa-sort"></i>' : (\App\Models\Helper::getValueInFilterReuquest('p_impression') != "desc" ? '<i class="fa-solid fa-arrow-up-a-z text-success"></i>' : '<i class="fa-solid fa-arrow-down-z-a text-danger"></i>') !!}
                                            </div>
                                        </th>
                                    @endif
                                    @if(in_array("p_ecpm",$modelColums))
                                        <th onclick='onSortSearch(`p_ecpm`, `{{ \App\Models\Helper::getValueInFilterReuquest('p_ecpm') == "" ? "asc" : (\App\Models\Helper::getValueInFilterReuquest('p_ecpm') != "desc" ? "desc" : "") }}`)'>
                                            <div>
                                                P.eCPM
                                                ($) {!! \App\Models\Helper::getValueInFilterReuquest('p_ecpm') == "" ? '<i class="fa-solid fa-sort"></i>' : (\App\Models\Helper::getValueInFilterReuquest('p_ecpm') != "desc" ? '<i class="fa-solid fa-arrow-up-a-z text-success"></i>' : '<i class="fa-solid fa-arrow-down-z-a text-danger"></i>') !!}
                                            </div>
                                        </th>
                                    @endif
                                    @if(in_array("p_revenue",$modelColums))
                                        <th onclick='onSortSearch(`p_revenue`, `{{ \App\Models\Helper::getValueInFilterReuquest('p_revenue') == "" ? "asc" : (\App\Models\Helper::getValueInFilterReuquest('p_revenue') != "desc" ? "desc" : "") }}`)'>
                                            <div>
                                                P.Revenue
                                                ($) {!! \App\Models\Helper::getValueInFilterReuquest('p_revenue') == "" ? '<i class="fa-solid fa-sort"></i>' : (\App\Models\Helper::getValueInFilterReuquest('p_revenue') != "desc" ? '<i class="fa-solid fa-arrow-up-a-z text-success"></i>' : '<i class="fa-solid fa-arrow-down-z-a text-danger"></i>') !!}
                                            </div>
                                        </th>
                                    @endif
                                    @if(in_array("profit",$modelColums))
                                        <th onclick='onSortSearch(`profit`, `{{ \App\Models\Helper::getValueInFilterReuquest('profit') == "" ? "asc" : (\App\Models\Helper::getValueInFilterReuquest('profit') != "desc" ? "desc" : "") }}`)'>
                                            <div>
                                                Profit {!! \App\Models\Helper::getValueInFilterReuquest('profit') == "" ? '<i class="fa-solid fa-sort"></i>' : (\App\Models\Helper::getValueInFilterReuquest('profit') != "desc" ? '<i class="fa-solid fa-arrow-up-a-z text-success"></i>' : '<i class="fa-solid fa-arrow-down-z-a text-danger"></i>') !!}
                                            </div>
                                        </th>
                                    @endif
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
        const checkboxes = document.querySelectorAll('.form-check-input');

        const selectAllBtn = document.getElementById('filter_btn_select_all');


        // Toggle Select All / Clear All
        selectAllBtn.addEventListener('click', () => {
            const allChecked = Array.from(checkboxes).every(cb => cb.checked);
            checkboxes.forEach(cb => cb.checked = !allChecked);
            selectAllBtn.textContent = allChecked ? 'Select All' : 'Clear All';
        });

        function onResearch() {
            const checked = document.querySelectorAll('.items-research:checked');

            // Convert NodeList to array of values
            const values = Array.from(checked).map(cb => cb.value);

            addUrlParameter("show_colums", values)
        }
    </script>
@endsection


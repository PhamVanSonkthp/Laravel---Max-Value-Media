@extends('user.layouts.master')

@section('title')

    <meta name="keyword" content="{{env('APP_NAME')}}">
    <meta name="promotion" content="{{env('APP_NAME')}}">
    <meta name="Description" content="{{env('APP_NAME')}}">

    <meta property="og:url" content="{{env('APP_URL')}}"/>
    <meta property="og:type" content="website"/>
    <meta property="og:title" content="{{env('APP_NAME')}}"/>
    <meta property="og:description" content="{{env('APP_NAME')}}"/>
    <meta property="og:image" content="{{env('APP_URL') . \App\Models\Helper::logoImagePath() }}"/>

@endsection

@section('name')

@endsection

@section('css')

@endsection

@section('content')

    <div class="container-fluid list-products">
        <div class="row">
            <div class="col-12">

                <div class="card">

                    <div class="card-header">

                        @include('user.report.search')

                    </div>

                    <div class="card-body">

                        <div class="table-responsive product-table">
                            <table class="table table-hover table-bordered">
                                <thead>
                                <tr>
                                    <th colspan="3">
                                        <strong>
                                            Sumary
                                        </strong>
                                    </th>
                                    <th>
                                        <strong>
                                            {{\App\Models\Formatter::formatNumber($summary->p_impression)}}
                                        </strong>
                                    </th>
                                    <th>
                                        <strong>
                                            ${{\App\Models\Formatter::formatNumber($summary->p_ecpm, 2)}}
                                        </strong>
                                    </th>
                                    <th>
                                        <strong>
                                            ${{\App\Models\Formatter::formatNumber($summary->p_revenue, 2)}}
                                        </strong>
                                    </th>
                                    <th>

                                    </th>
                                </tr>
                                <tr>
                                    <th onclick='onSortSearch(`date`, `{{ \App\Models\Helper::getValueInFilterReuquest('date') == "" ? "asc" : (\App\Models\Helper::getValueInFilterReuquest('date') != "desc" ? "desc" : "") }}`)'>
                                        <div>
                                            Date {!! \App\Models\Helper::getValueInFilterReuquest('date') == "" ? '<i class="fa-solid fa-sort"></i>' : (\App\Models\Helper::getValueInFilterReuquest('date') != "desc" ? '<i class="fa-solid fa-arrow-up-a-z text-success"></i>' : '<i class="fa-solid fa-arrow-down-z-a text-danger"></i>') !!}
                                        </div>
                                    </th>

                                    <th onclick='onSortSearch(`website_id`, `{{ \App\Models\Helper::getValueInFilterReuquest('website_id') == "" ? "asc" : (\App\Models\Helper::getValueInFilterReuquest('website_id') != "desc" ? "desc" : "") }}`)'>
                                        <div>
                                            Website {!! \App\Models\Helper::getValueInFilterReuquest('website_id') == "" ? '<i class="fa-solid fa-sort"></i>' : (\App\Models\Helper::getValueInFilterReuquest('website_id') != "desc" ? '<i class="fa-solid fa-arrow-up-a-z text-success"></i>' : '<i class="fa-solid fa-arrow-down-z-a text-danger"></i>') !!}
                                        </div>
                                    </th>
                                    <th onclick='onSortSearch(`zone_id`, `{{ \App\Models\Helper::getValueInFilterReuquest('zone_id') == "" ? "asc" : (\App\Models\Helper::getValueInFilterReuquest('zone_id') != "desc" ? "desc" : "") }}`)'>
                                        <div>
                                            Zone {!! \App\Models\Helper::getValueInFilterReuquest('zone_id') == "" ? '<i class="fa-solid fa-sort"></i>' : (\App\Models\Helper::getValueInFilterReuquest('zone_id') != "desc" ? '<i class="fa-solid fa-arrow-up-a-z text-success"></i>' : '<i class="fa-solid fa-arrow-down-z-a text-danger"></i>') !!}
                                        </div>
                                    </th>

                                    <th onclick='onSortSearch(`p_impression`, `{{ \App\Models\Helper::getValueInFilterReuquest('p_impression') == "" ? "asc" : (\App\Models\Helper::getValueInFilterReuquest('p_impression') != "desc" ? "desc" : "") }}`)'>
                                        <div>
                                            Impressions {!! \App\Models\Helper::getValueInFilterReuquest('p_impression') == "" ? '<i class="fa-solid fa-sort"></i>' : (\App\Models\Helper::getValueInFilterReuquest('p_impression') != "desc" ? '<i class="fa-solid fa-arrow-up-a-z text-success"></i>' : '<i class="fa-solid fa-arrow-down-z-a text-danger"></i>') !!}
                                        </div>
                                    </th>

                                    <th onclick='onSortSearch(`p_ecpm`, `{{ \App\Models\Helper::getValueInFilterReuquest('p_ecpm') == "" ? "asc" : (\App\Models\Helper::getValueInFilterReuquest('p_ecpm') != "desc" ? "desc" : "") }}`)'>
                                        <div>
                                            eCPM($) {!! \App\Models\Helper::getValueInFilterReuquest('p_ecpm') == "" ? '<i class="fa-solid fa-sort"></i>' : (\App\Models\Helper::getValueInFilterReuquest('p_ecpm') != "desc" ? '<i class="fa-solid fa-arrow-up-a-z text-success"></i>' : '<i class="fa-solid fa-arrow-down-z-a text-danger"></i>') !!}
                                        </div>
                                    </th>

                                    <th onclick='onSortSearch(`p_revenue`, `{{ \App\Models\Helper::getValueInFilterReuquest('p_revenue') == "" ? "asc" : (\App\Models\Helper::getValueInFilterReuquest('p_revenue') != "desc" ? "desc" : "") }}`)'>
                                        <div>
                                            Revenue($) {!! \App\Models\Helper::getValueInFilterReuquest('p_revenue') == "" ? '<i class="fa-solid fa-sort"></i>' : (\App\Models\Helper::getValueInFilterReuquest('p_revenue') != "desc" ? '<i class="fa-solid fa-arrow-up-a-z text-success"></i>' : '<i class="fa-solid fa-arrow-down-z-a text-danger"></i>') !!}
                                        </div>
                                    </th>

                                    <th onclick='onSortSearch(`report_status_id`, `{{ \App\Models\Helper::getValueInFilterReuquest('report_status_id') == "" ? "asc" : (\App\Models\Helper::getValueInFilterReuquest('report_status_id') != "desc" ? "desc" : "") }}`)'>
                                        <div>
                                            Status {!! \App\Models\Helper::getValueInFilterReuquest('report_status_id') == "" ? '<i class="fa-solid fa-sort"></i>' : (\App\Models\Helper::getValueInFilterReuquest('report_status_id') != "desc" ? '<i class="fa-solid fa-arrow-up-a-z text-success"></i>' : '<i class="fa-solid fa-arrow-down-z-a text-danger"></i>') !!}
                                        </div>
                                    </th>
                                </tr>
                                </thead>
                                <tbody class="" id="body_container_item">
                                @foreach($items as $index => $item)
                                    @include('user.report.row', ['item' => $item, 'index' => $index])
                                @endforeach

                                </tbody>

                                <tfoot>

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
    <div class="modal fade" id="modal_craete_website" tabindex="-1" aria-labelledby="modal_craete_websiteLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal_craete_websiteLabel">Create new Website</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @include('user.website.modal_create')
                </div>
            </div>
        </div>
    </div>

    <!-- Modal get ad zone website -->
    <div class="modal fade" id="ad_zone_website_modal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Verify site ownership
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="container_ad_zone_website_modal">

                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')

@endsection

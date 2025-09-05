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
    <!-- Daterangepicker CSS -->
    <link href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" rel="stylesheet" />
@endsection

@section('content')

    <!-- Main Content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">

                    <div class="card">

                        <div class="card-body">

                            @include('user.report.search')

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
    </section>

@endsection

@section('js')

    <!-- Moment.js -->
    <script src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <!-- Daterangepicker JS -->
    <script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

    <script>

        let from_search = "{{request('from')}}";
        let to_search = "{{request('to')}}";

        $('#select_websites_search').select2({
            placeholder: 'Select websites',
            tags: true,
            tokenSeparators: [',', ';'],
            width: '100%' // force full width
        });

        $('#select_zone_websites_search').select2({
            placeholder: 'Select zones',
            tags: true,
            tokenSeparators: [',', ';'],
            width: '100%' // force full width
        });

        // Date range picker
        $('#daterange').daterangepicker({
            opens: 'right',
            autoUpdateInput: false,
            maxDate: moment(),
            locale: {
                cancelLabel: 'Clear',
                format: 'YYYY-MM-DD'
            }
        });

        $('#daterange').on('apply.daterangepicker', function(ev, picker) {
            $(this).val(picker.startDate.format('YYYY-MM-DD') + ' → ' + picker.endDate.format('YYYY-MM-DD'));

            from_search = picker.startDate.format('YYYY-MM-DD');
            to_search   = picker.endDate.format('YYYY-MM-DD');

        });

        $('#daterange').on('cancel.daterangepicker', function(ev, picker) {
            $(this).val('');
        });

        $('#daterange').val('{{request('from') . ' → ' . request('to')}}');

        function onSearch() {
            addUrlParameterObjects([
                {
                    name: 'website_ids',
                    value: $('#select_websites_search').val(),
                },
                {
                    name: 'zone_website_ids',
                    value: $('#select_zone_websites_search').val(),
                },
                {
                    name: 'from',
                    value: from_search,
                },
                {
                    name: 'to',
                    value: to_search,
                }
            ]);
        }
    </script>
@endsection

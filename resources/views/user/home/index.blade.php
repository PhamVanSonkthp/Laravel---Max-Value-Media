@extends('user.layouts.master')

@section('title')
    <title>{{ isset($title) ? $title : config('app.name', 'Laravel')}}</title>

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
    <h4 class="page-title">{{ isset($title) ? $title : config('app.name', 'Laravel')}}</h4>
@endsection

@section('css')
    <!-- Google Charts -->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
@endsection

@section('content')

    <!-- Main Content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2><strong>Estimated earning</strong></h2>
                        </div>

                        <div class="body">
                            <div class="row">
                                <div class="col-lg-3 col-md-6 col-sm-12">
                                    <div class="card info-box-2">
                                        <div class="body">
                                            <div class="content">
                                                <div class="text">Today sofar</div>
                                                <div class="number"><span class="number">${{\App\Models\Formatter::formatMoney($revenueNow, 2)}}</span></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6 col-sm-12">
                                    <div class="card info-box-2">
                                        <div class="body">
                                            <div class="content">
                                                <div class="text">Yestoday</div>
                                                <div class="number">{{\App\Models\Formatter::formatMoney($revenueYesterday, 2)}}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6 col-sm-12">
                                    <div class="card info-box-2">
                                        <div class="body">
                                            <div class="content">
                                                <div class="text">This month</div>
                                                <div class="number">$<span class="number">{{\App\Models\Formatter::formatMoney($revenueThisMonth, 2)}}</span></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6 col-sm-12">
                                    <div class="card info-box-2">
                                        <div class="body">
                                            <div class="content">
                                                <div class="text">Last month</div>
                                                <div class="number">$<span class="number">{{\App\Models\Formatter::formatMoney($revenueLastMonth, 2)}}</span></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="row clearfix">
                <div class="col-xl-8 col-lg-12 col-md-12">
                    <div class="card">
                        <div class="header">
                            <div class="row">
                                <div class="col-6">
                                    <h2><strong>Site</strong> Report</h2>
                                </div>
                                <div class="col-6">
                                    <div class="dropdown d-inline-block float-right">
                                        <button class="btn btn-filter dropdown-toggle" type="button" id="filterMenu" data-toggle="dropdown">
                                            {{request('f') ?? 'Week'}}
                                            @if(request('f') == "Custom")
                                            {{request('c_f')}} → {{request('c_t')}}
                                            @endif
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="filterMenu">
                                            <li style="cursor: pointer;" class="dropdown-item" data-filter="Week">Week</li>
                                            <li style="cursor: pointer;" class="dropdown-item" data-filter="This Month">This Month</li>
                                            <li style="cursor: pointer;" class="dropdown-item" data-filter="Last Month">Last Month</li>
                                            <li style="cursor: pointer;" class="dropdown-item" data-filter="Custom">Custom Range</li>
                                        </ul>
                                    </div>
                                    <!-- Custom date input -->
                                    <div>
                                        <input type="text" id="customRange" class="form-control mx-auto" style="max-width:300px; display:none;opacity: 0;">
                                    </div>
                                </div>
                            </div>


                        </div>
                        <div class="body">

                            @include('user.home.site_chart')
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6 col-md-12">
                    <div class="card">
                        <div class="body">
                            @include('user.home.geo_chart')
                        </div>
                    </div>
                    <div class="card">
                        <div class="body">

                            @include('user.home.device_chart')


                        </div>
                    </div>

                    <div class="card">
                        <div class="body">
                            @include('user.home.traffic_source')

                        </div>
                    </div>

                </div>

            </div>

            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">

                        <div class="header">
                            <h2><strong>Performance</strong></h2>
                        </div>

                        <div class="body block-header">
                            <div>
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                        <tr>
                                            <th>Site</th>
                                            <th>Pageviews</th>
                                            <th>RPM</th>
                                            <th>Impression</th>
                                            <th>Revenue</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        @foreach($performanceSites as $performanceSite)
                                            <tr>
                                                <td>{{$performanceSite['name']}}</td>
                                                <td>{{\App\Models\Formatter::formatNumber($performanceSite['page_view'])}}</td>
                                                <td>${{\App\Models\Formatter::formatMoney($performanceSite['revenue'] / max(1, $performanceSite['page_view']) * 1000, 2)}}</td>
                                                <td>{{\App\Models\Formatter::formatNumber($performanceSite['impressions'])}}</td>
                                                <td>${{\App\Models\Formatter::formatMoney($performanceSite['revenue'], 2)}}</td>
                                            </tr>
                                        @endforeach

                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

@endsection

@section('js')
    <!-- Jquery Core Js -->

    <script
        src="{{asset('user/assets/light/assets/bundles/morrisscripts.bundle.js')}}"></script> <!-- Morris Plugin Js -->


    <script>
        $(document).ready(function() {
            function updateButton(text) {
                $("#filterMenu").text(text);
            }

            $(".dropdown-item").on("click", function() {
                let filter = $(this).data("filter");

                if(filter == "{{request('f')}}" || (filter == "Week" && "{{request('f')}}" == "")) return;

                if (filter === "Custom") {
                    $("#customRange").show().focus();
                } else {
                    updateButton($(this).text());
                    $("#customRange").hide().val('');
                    addUrlParameter('f', filter);
                }
            });

            // Daterangepicker
            $('#customRange').daterangepicker({
                autoUpdateInput: false,
                maxDate: moment(),
                locale: { cancelLabel: 'Clear', format: 'YYYY-MM-DD' }
            });

            $('#customRange').on('apply.daterangepicker', function(ev, picker) {
                let rangeText = picker.startDate.format('YYYY-MM-DD') + ' → ' + picker.endDate.format('YYYY-MM-DD');
                $(this).val(rangeText);
                updateButton("Custom Range (" + rangeText + ")");
                $(this).data('daterangepicker').hide();
                $(this).hide();
                addUrlParameterObjects([
                    {
                        name: 'f',
                        value: "Custom",
                    },
                    {
                        name: 'c_f',
                        value: picker.startDate.format('YYYY-MM-DD'),
                    },
                    {
                        name: 'c_t',
                        value: picker.endDate.format('YYYY-MM-DD'),
                    }
                ]);
            });

            $('#customRange').on('cancel.daterangepicker', function() {
                $(this).val('');
                updateButton("Filter by Date");
                $(this).data('daterangepicker').hide();
                $(this).hide();
            });
        });
    </script>

@endsection

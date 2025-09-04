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
                            <h2><strong>Site</strong> Report</h2>
                            <ul class="header-dropdown">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown"
                                       role="button" aria-haspopup="true" aria-expanded="false">
                                        1 Week
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-right float-right">
                                        <li><a href="javascript:void(0);">1 Week</a></li>
                                        <li><a href="javascript:void(0);">This month</a></li>
                                        <li><a href="javascript:void(0);">Custom</a></li>
                                    </ul>
                                </li>
                            </ul>
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

                <div class="col-xl-8 col-lg-12 col-md-12 d-none">
                    <div class="card">
                        <div class="header">
                            <h2><strong>Visitors</strong> Statistics</h2>
                            <ul class="header-dropdown">
                                <li class="dropdown"><a href="javascript:void(0);" class="dropdown-toggle"
                                                        data-toggle="dropdown" role="button" aria-haspopup="true"
                                                        aria-expanded="false"> <i class="zmdi zmdi-more"></i> </a>
                                    <ul class="dropdown-menu dropdown-menu-right">
                                        <li><a href="javascript:void(0);">Action</a></li>
                                        <li><a href="javascript:void(0);">Another action</a></li>
                                        <li><a href="javascript:void(0);">Something else</a></li>
                                    </ul>
                                </li>
                                <li class="remove">
                                    <a role="button" class="boxs-close"><i class="zmdi zmdi-close"></i></a>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <div class="row">
                                <div class="col-lg-6 col-md-12 visitors-chart">
                                    <div id="donut_chart" class="donut_chart"></div>
                                    <span><i class="zmdi zmdi-desktop-mac"></i>Desktops</span>
                                    <span><i class="zmdi zmdi-tablet-mac"></i>Tablet</span>
                                    <span><i class="zmdi zmdi-smartphone"></i>Mobile</span>
                                </div>
                                <div class="col-lg-6 col-md-12 text-center">
                                    <div id="world-map-markers" style="height: 260px;"></div>
                                    <div class="row">
                                        <div class="col-6">
                                            <small>Page Views</small>
                                            <h5 class="m-b-0">32,211,536</h5>
                                        </div>
                                        <div class="col-6">
                                            <small>Site Visitors</small>
                                            <h5 class="m-b-0">23,516</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
                                                <td></td>
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


@endsection

@extends('administrator.layouts.master')

@section('title')
    <title>Home page</title>
@endsection

@section('name')
    <h4 class="page-title">Tổng quan</h4>
@endsection

@section('css')

@endsection

@section('content')

    @can('dashboard-list')
        <div>

            <div class="row g-3 justify-content-center">
                <div class="col-md-6 col-xl-3">
                    <div class="card card-one">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-7">
                                    <h3 class="card-value mb-1">{{\App\Models\Formatter::formatNumber($totalUser)}}</h3>
                                    <label class="card-title fw-medium text-dark mb-1">Total Publisher</label>
                                </div>
                                <div class="col-5">
                                    <div id="apexChart1"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-3">
                    <div class="card card-one">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-7">
                                    <h3 class="card-value mb-1">{{\App\Models\Formatter::formatNumber($totalWebsite)}}</h3>
                                    <label class="card-title fw-medium text-dark mb-1">Total Websites</label>
                                </div>
                                <div class="col-5">
                                    <div id="apexChart2"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-3">
                    <div class="card card-one">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-7">
                                    <h3 class="card-value mb-1">{{\App\Models\Formatter::formatNumber($totalZone)}}</h3>
                                    <label class="card-title fw-medium text-dark mb-1">Total Zones</label>
                                </div>
                                <div class="col-5">
                                    <div id="apexChart3"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-3">
                    <div class="card card-one">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-7">
                                    <h3 class="card-value mb-1">{{\App\Models\Formatter::formatNumber($totalZonePending)}}</h3>
                                    <label class="card-title fw-medium text-dark mb-1">Pending Zones</label>
                                </div>
                                <div class="col-5">
                                    <div id="apexChart03"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-3">
                    <div class="card card-one">
                        <div class="card-body">
                            <div class="card-container">
                                <div>
                                    <label class="card-title fs-sm fw-medium mb-1">D.Requests</label>
                                    <h3 class="card-value mb-1">{{\App\Models\Formatter::formatNumber($sumary->d_request)}}</h3>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-xl-3">
                    <div class="card card-one">
                        <div class="card-body">
                            <div class="card-container">
                                <div>
                                    <label class="card-title fs-sm fw-medium mb-1">D.Impressions</label>
                                    <h3 class="card-value mb-1">{{\App\Models\Formatter::formatNumber($sumary->d_impression)}}</h3>
                                </div>
                                <div class="card-content">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-3">
                    <div class="card card-one">
                        <div class="card-body">
                            <div class="card-container">
                                <div>
                                    <label class="card-title fs-sm fw-medium mb-1">D.CPM</label>
                                    <h3 class="card-value mb-1"><i class="ri-numbers-line"></i>
                                        ${{\App\Models\Formatter::formatNumber($sumary->d_ecpm, 2)}}</h3>
                                </div>
                                <div class="card-content">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-3">
                    <div class="card card-one">
                        <div class="card-body">
                            <div class="card-container">
                                <div>
                                    <label class="card-title fs-sm fw-medium mb-1">D.Revenue</label>
                                    <h3 class="card-value mb-1"><i class="ri-money-dollar-box-line"></i>
                                        ${{\App\Models\Formatter::formatNumber($sumary->d_revenue, 2)}}</h3>
                                </div>
                                <div class="card-content">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    @else
        Bạn không có quyền truy cập Dashboard
    @endcan

@endsection

@section('js')

@endsection

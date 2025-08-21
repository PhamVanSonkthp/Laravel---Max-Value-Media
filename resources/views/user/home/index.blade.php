@extends('user.layouts.master')

@php
    $title = config('app.name', 'Laravel');
@endphp

@section('title')
    <title>{{$title}}</title>

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
    <h4 class="page-title">{{$title}}</h4>
@endsection

@section('css')

@endsection

@section('content')

    <div>

        <div class="row g-3 justify-content-center">
            <div class="col-md-6 col-xl-3">
                <div class="card card-one">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-7">
                                <h3 class="card-value mb-1">{{\App\Models\Formatter::formatNumber(0)}}</h3>
                                <label class="card-title fw-medium text-dark mb-1">Now</label>
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
                                <h3 class="card-value mb-1">{{\App\Models\Formatter::formatNumber(0)}}</h3>
                                <label class="card-title fw-medium text-dark mb-1">Yesterday</label>
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
                                <h3 class="card-value mb-1">{{\App\Models\Formatter::formatNumber(0)}}</h3>
                                <label class="card-title fw-medium text-dark mb-1">This Month</label>
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
                                <h3 class="card-value mb-1">{{\App\Models\Formatter::formatNumber(0)}}</h3>
                                <label class="card-title fw-medium text-dark mb-1">Total Earning</label>
                            </div>
                            <div class="col-5">
                                <div id="apexChart03"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

@endsection

@section('js')

@endsection

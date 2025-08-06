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

    <div class="main-wrapper">
        <div class="page-wrapper full-page">
            <div class="page-content d-flex align-items-center justify-content-center">

                <div class="row w-100 mx-0 auth-page">
                    <div class="col-md-8 col-xl-6 mx-auto d-flex flex-column align-items-center">
                        <img src="{{asset('/assets/images/404.svg')}}" class="img-fluid mb-2" alt="404">
                        <h1 class="fw-bolder mb-22 mt-2 tx-80 text-muted">404</h1>
                        <h4 class="mb-2">Page Not Found</h4>
                        <h6 class="text-muted mb-3 text-center">Oopps!! Trang này không có sẵn.</h6>
                        <a href="{{route('user.index')}}">Trở về Trang Chủ</a>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection

@section('js')

@endsection

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

    <!-- Begin: Content -->
    <main class="home">
        <!-- Begin: Banner -->
        <section class="banner"
                 style="background-image: url('{{asset('/assets/user/assets/images/Backgroud/BG-home-page.png')}}');">
            <div class="container-xl">
                <div class="banner-content justify-content-center">
                    <div class="banner-content__cover">

                        <p class="banner-content__title text-center">Có lỗi hệ thông, chúng tôi đang khắc phục!</p>

                    </div>

                </div>
            </div>
        </section>
        <!-- End: Banner -->


    </main>
    <!-- End: Content -->

@endsection

@section('js')

@endsection

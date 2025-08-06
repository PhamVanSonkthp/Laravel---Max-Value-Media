@extends('user.layouts.master')

@php
    $title = config('app.name', 'Laravel');
@endphp

@section('title')
    <title>{{$title}}</title>

    <meta name="keyword" content="{{env('APP_NAME')}}">
    <meta name="promotion" content="{{env('APP_NAME')}}">
    <meta name="Description" content="{{env('APP_NAME')}}">

    <meta property="og:url" content="{{route('user.download_app')}}"/>
    <meta property="og:type" content="website"/>
    <meta property="og:title" content="Tải App {{env('APP_NAME')}}"/>
    <meta property="og:description" content="Ứng dụng uy tín hàng đầu Việt Nam"/>
    <meta property="og:image" content="{{asset('/assets/images/more/banner_ref.jpg') }}"/>

@endsection

@section('name')
    <h4 class="page-title">{{$title}}</h4>
@endsection

@section('css')

@endsection

@section('content')


@endsection

@section('js')
    <script>
        function onOpenApp() {

            if (navigator.userAgent.toLowerCase().indexOf("android") > -1) {
                window.location.href = 'http://play.google.com/store/apps/details?id=com.infinity.sen_vang';
            }else {
                window.location.href = 'http://itunes.apple.com/lb/app/id6451108015';
            }
        }

        onOpenApp();
    </script>
@endsection

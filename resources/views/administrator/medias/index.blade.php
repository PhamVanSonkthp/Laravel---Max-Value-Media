@extends('administrator.layouts.master')

@include('administrator.'.$prefixView.'.header')

@section('css')

@endsection

@section('content')

    <iframe src="{{ url('filemanager') }}" style="width: 100%; height: 81vh; overflow: hidden; border: none;"></iframe>


@endsection

@section('js')

@endsection

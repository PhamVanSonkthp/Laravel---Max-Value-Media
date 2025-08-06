@extends('administrator.layouts.master')

@include('administrator.'.$prefixView.'.header')

@section('css')

@endsection

@section('content')

<form action="{{route('administrator.'.$prefixView.'.store')}}" method="post" enctype="multipart/form-data">
    @csrf

    <div class="container-fluid list-products">
        <div class="row">
            <div class="col-xxl-6">
                <div class="card">
                    <div class="card-body">

                        @include('administrator.'.$prefixView.'.content' , ['item' => isset($item) ? $item : null])

                    </div>
                </div>
            </div>
        </div>

    </div>
</form>
@endsection

@section('js')

@endsection


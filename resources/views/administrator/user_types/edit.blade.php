@extends('administrator.layouts.master')

@include('administrator.'.$prefixView.'.header')

@section('css')

@endsection

@section('content')

    <div class="container-fluid list-products">
        <div class="row">

            <form action="{{route('administrator.'.$prefixView.'.update', ['id'=> $item->id]) }}" method="post"
                  enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="col-md-6">

                    @include('administrator.'.$prefixView.'.content' , ['item' => isset($item) ? $item : null])

                </div>
            </form>

        </div>
    </div>
@endsection

@section('js')

@endsection

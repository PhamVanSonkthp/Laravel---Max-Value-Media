@extends('administrator.layouts.master')

@include('administrator.password.header')

@section('css')

@endsection

@section('content')

    <div class="container-fluid list-products">
        <div class="row">
            <!-- Individual column searching (text inputs) Starts-->
            <form action="{{route('administrator.profile.update') }}" method="post"
                  enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="col-md-6">

                    <div class="card">
                        <div class="card-body">

                            <div class="mt-3">
                                <label>Timezone @include('administrator.components.lable_require') </label>
                                <select style="width: 100%;"  name="timezone" class="form-control select2_init">
                                    @foreach($timezones as $timezone)
                                        <option value="{{$timezone}}" {{$item->timezone == $timezone ? 'selected' : ''}}>{{$timezone}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary mt-3">Lưu thay đổi</button>

                </div>
            </form>

        </div>
    </div>

@endsection

@section('js')

@endsection

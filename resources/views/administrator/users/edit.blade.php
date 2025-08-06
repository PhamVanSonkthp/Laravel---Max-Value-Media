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
                <div class="col-md-12">

                    <div class="row">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">

                                    <div class="col-md-3">
                                        @include('administrator.components.require_input_text', ['name' => 'name', 'label' => 'Tên'])

                                        @include('administrator.components.require_input_text_email', ['name' => 'email', 'label' => 'Email'])

                                        @include('administrator.components.require_input_text', ['name' => 'address', 'label' => 'Địa chỉ'])

                                    </div>

                                    <div class="col-md-3">
                                        @include('administrator.components.require_input_text_phone', ['name' => 'phone', 'label' => 'Số điện thoại'])

                                        @include('administrator.components.input_text_password', ['name' => 'password', 'label' => 'Mật khẩu','value' => ""])

                                        @include('administrator.components.require_input_date', ['name' => 'date_of_birth', 'label' => 'Ngày sịnh'])

                                    </div>

                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-4">
                                                @include('administrator.components.input_image', ['name' => 'portrait_image_path', 'label' => 'Ảnh chân dung'])
                                            </div>

                                            <div class="col-md-4">
                                                @include('administrator.components.input_image', ['name' => 'front_id_image_path', 'label' => 'Ảnh CCCD mặt trước'])

                                            </div>

                                            <div class="col-md-4">
                                                @include('administrator.components.input_image', ['name' => 'back_id_image_path', 'label' => 'Ảnh CCCD mặt sau'])

                                            </div>
                                        </div>

                                    </div>

                                </div>

                                @include('administrator.components.button_save')
                            </div>
                        </div>
                    </div>
                </div>
            </form>

        </div>
    </div>

@endsection

@section('js')

@endsection

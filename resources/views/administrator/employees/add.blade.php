@extends('administrator.layouts.master')

@include('administrator.'.$prefixView.'.header')

@section('css')


@endsection

@section('content')

    <div class="container-fluid">
        <div class="row">

            <form action="{{route('administrator.'.$prefixView.'.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="col-xxl-6">
                    <div class="card">
                        <div class="card-body">

                            <input type="text" name="is_admin" style="display: none;" value="1">

                            <div class="row">

                                <div class="col-md-3">

                                    @include('administrator.components.require_input_text' , ['name' => 'name' , 'label' => 'Tên'])

                                </div>

                                <div class="col-md-3">
                                    @include('administrator.components.require_input_text' , ['name' => 'phone' , 'label' => 'Số điện thoại'])

                                </div>
                                <div class="col-md-3">
                                    @include('administrator.components.require_input_text' , ['name' => 'email' , 'label' => 'Email (dùng làm tên đăng nhập)'])

                                </div>
                                <div class="col-md-3">
                                    @include('administrator.components.input_text_password' , ['name' => 'password' , 'label' => 'Mật khẩu'])

                                </div>

                                <div class="col-md-3">
                                    <div class="form-group mt-3">
                                        <label>Chọn vai trò</label>
                                        <select name="role_ids[]" class="form-control select2_init" multiple>
                                            <option value=""></option>
                                            @foreach($roles as $roleItem)
                                                <option value="{{$roleItem->id}}">{{$roleItem->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    @include('administrator.components.require_input_date', ['label' => "Ngày sinh", 'name' => "date_of_birth"])
                                </div>


                                <div class="col-md-3">
                                    @include('administrator.components.require_select2', ['label' => "Giới tính", 'name' => "gender_id", "select2Items" => \App\Models\GenderUser::all()])
                                </div>


                            </div>

                            @if($isSingleImage)
                                <div class="mt-3 mb-3">
                                    @include('administrator.components.upload_image', ['post_api' => $imagePostUrl, 'table' => $table, 'image' => $imagePathSingple , 'relate_id' => $relateImageTableId])
                                </div>
                            @endif

                            @if($isMultipleImages)
                                <div class="mt-3 mb-3">
                                    @include('administrator.components.upload_multiple_images', ['post_api' => $imageMultiplePostUrl, 'delete_api' => $imageMultipleDeleteUrl , 'sort_api' => $imageMultipleSortUrl, 'table' => $table , 'images' => $imagesPath,'relate_id' => $relateImageTableId])
                                </div>
                            @endif

                            <button type="submit" class="btn btn-primary mt-3">Thêm mới</button>

                        </div>
                    </div>
                </div>
            </form>


        </div>

    </div>

@endsection

@section('js')


@endsection


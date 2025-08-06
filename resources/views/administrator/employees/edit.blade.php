@extends('administrator.layouts.master')

@include('administrator.'.$prefixView.'.header')

@section('css')

@endsection

@section('content')

    <div class="container-fluid">
        <div class="row">

            <form action="{{route('administrator.'.$prefixView.'.update', ['id'=> $item->id]) }}" method="post"
                  enctype="multipart/form-data">
                @method('PUT')
                @csrf

                <div class="col-xxl-9">
                    <div class="card">
                        <div class="card-body">
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
                                                <option
                                                    {{$rolesOfUser->contains($roleItem->id) ? 'selected' : ''}}
                                                    value="{{$roleItem->id}}">{{$roleItem->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>


                                <div class="col-md-3">
                                    @include('administrator.components.require_input_date', ['label' => "Ngày sinh", 'name' => "date_of_birth"])
                                </div>


                                <div class="col-md-3">
                                    @include('administrator.components.require_select2', ['label' => "Giới tính",'value' => $item->gender_id, 'name' => "gender_id", "select2Items" => \App\Models\GenderUser::all()])
                                </div>

                            </div>

                            <div class="mt-3">
                                @include('administrator.components.upload_image', ['post_api' => route('ajax,administrator.upload_image.store'), 'relate_id' => $item->id , 'table' => 'users', 'image' => $item->avatar("original")])
                            </div>

                            <button type="submit" class="btn btn-primary mt-3">Lưu</button>

                        </div>
                    </div>
                </div>
            </form>

        </div>
    </div>
@endsection

@section('js')

@endsection

@extends('administrator.layouts.master')

@include('administrator.'.$prefixView.'.header')

@section('css')

@endsection

@section('content')

    <div class="container-fluid list-products">

        <!-- Individual column searching (text inputs) Starts-->

        <form action="{{route('administrator.'.$prefixView.'.update', ['id'=> $item->id]) }}" method="post"
              enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="row">
                <div class="col-xl-6">

                    <div class="card">
                        <div class="card-body">

                            <div>
                                <h2>
                                    Chung
                                </h2>
                            </div>

                            <div class="row align-items-end">
                                <div class="col-5">
                                    @include('administrator.components.require_input_number', ['label' => 'Quy đổi điểm' , 'name' => 'point'])
                                </div>

                                <div class="col-2">
                                    <div class="text-center">
                                        =>
                                    </div>
                                </div>
                                <div class="col-5">
                                    @include('administrator.components.require_input_number', ['label' => 'Quy đổi số tiền' , 'name' => 'amount'])
                                </div>
                            </div>

                            <div class="row align-items-end d-none">
                                <div class="col-6">
                                    @include('administrator.components.require_input_text', ['label' => 'Tên tài khoản nạp tiền' , 'name' => 'bank_name'])
                                </div>

                                <div class="col-6">
                                    @include('administrator.components.require_input_text', ['label' => 'Số tài khoản nạp tiền' , 'name' => 'bank_number'])
                                </div>

                            </div>

                            <div class="row align-items-end">
                                <div class="col-6">
                                    @include('administrator.components.require_input_text', ['label' => 'Số điện thoại liên hệ' , 'name' => 'phone_contact'])
                                </div>

                                <div class="col-6">
                                    @include('administrator.components.require_input_text', ['label' => 'Thông tin' , 'name' => 'about_contact'])
                                </div>

                                <div class="col-6">
                                    @include('administrator.components.require_input_text', ['label' => 'Địa chỉ' , 'name' => 'address_contact'])
                                </div>

                                <div class="col-6">
                                    @include('administrator.components.require_input_text_email', ['label' => 'Email' , 'name' => 'email_contact'])
                                </div>

                                <div class="col-6">
                                    @include('administrator.components.input_text', ['label' => 'Fanpage FB link' , 'name' => 'facebook_link'])
                                </div>

                                <div class="col-6">
                                    @include('administrator.components.require_input_number', ['label' => 'Số điểm khi giới thiệu thành công / người đăng ký mới' , 'name' => 'number_point_refer_success'])
                                </div>

                                <div class="col-6">
                                    @include('administrator.components.require_input_number', ['label' => 'Số điểm khi nhập mã giới thiệu' , 'name' => 'number_point_taken_refer_success'])
                                </div>

                            </div>


                            @include('administrator.components.button_save')
                        </div>
                    </div>

                </div>

                <div class="col-xl-6">

                    <div class="card">
                        <div class="card-body">

                            <div>
                                <h2>
                                    Chat (Pusher)
                                </h2>
                            </div>

                            <div>
                                @include('administrator.components.input_text', ['label' => 'PUSHER_APP_ID' , 'name' => 'pusher_app_id'])
                            </div>

                            <div>
                                @include('administrator.components.input_text', ['label' => 'PUSHER_APP_KEY' , 'name' => 'pusher_app_key'])
                            </div>

                            <div>
                                @include('administrator.components.input_text', ['label' => 'PUSHER_APP_SECRET' , 'name' => 'pusher_app_secret'])
                            </div>

                            <div>
                                @include('administrator.components.input_text', ['label' => 'PUSHER_APP_CLUSTER' , 'name' => 'pusher_app_cluster'])
                            </div>

                        </div>
                    </div>

                </div>

                <div class="col-xl-6">

                    <div class="card">
                        <div class="card-body">

                            <div>
                                <h2>
                                    Email SMTP
                                </h2>
                            </div>

                            <div class="row">

                                <div class="col-6">
                                    @include('administrator.components.input_text', ['label' => 'MAIL_HOST' , 'name' => 'mail_host'])
                                </div>

                                <div class="col-6">
                                    @include('administrator.components.input_text', ['label' => 'MAIL_PORT' , 'name' => 'mail_port'])
                                </div>

                                <div class="col-6">
                                    @include('administrator.components.input_text', ['label' => 'MAIL_USERNAME' , 'name' => 'mail_username'])
                                </div>

                                <div class="col-6">
                                    @include('administrator.components.input_text', ['label' => 'MAIL_PASSWORD' , 'name' => 'mail_password'])
                                </div>

                                <div class="col-6">
                                    @include('administrator.components.input_text', ['label' => 'MAIL_ENCRYPTION' , 'name' => 'mail_encryption'])
                                </div>

                                <div class="col-6">
                                    @include('administrator.components.input_text', ['label' => 'MAIL_FROM_ADDRESS' , 'name' => 'mail_from_address'])
                                </div>

                                <div class="col-6">
                                    @include('administrator.components.input_text', ['label' => 'MAIL_FROM_NAME' , 'name' => 'mail_from_name'])
                                </div>

                                <div class="col-6">
                                    <div class="form-group mt-3">
                                        <label>Test mail</label><span class="text-danger">*</span>
                                        <input id="input_test_email" type="email" autocomplete="off" class="form-control " placeholder="Nhập mail nhận">
                                    </div>

                                    <div>
                                        <span id="lable_test_email" class="text-danger"></span>
                                    </div>

                                    <button type="button" class="btn btn-primary mt-3" onclick="onSendTestMail()">Gửi</button>

                                </div>

                            </div>


                            @include('administrator.components.button_save')
                        </div>
                    </div>

                </div>

                <div class="col-xl-6">

                    <div class="card">
                        <div class="card-body">

                            <div>
                                <h2>
                                    Vận chuyển
                                </h2>
                            </div>

                            <div class="row">

                                <div class="col-6">
                                    @include('administrator.components.require_input_number', ['label' => 'Phí vận chuyển mặc định' , 'name' => 'default_shipping_fee'])
                                </div>

                            </div>


                            @include('administrator.components.button_save')
                        </div>
                    </div>

                </div>

                <div class="col-xl-6">

                    <div class="card">
                        <div class="card-body">

                            <div>
                                <h2>
                                    Thời tiết
                                </h2>
                            </div>

                            <div class="row">

                                <div class="col-6">
                                    @include('administrator.components.input_text', ['label' => 'API key thời tiết' , 'name' => 'api_key_weather'])
                                </div>

                            </div>


                            @include('administrator.components.button_save')
                        </div>
                    </div>

                </div>

                <div class="col-xl-6">

                    <div class="card">
                        <div class="card-body">

                            <div>
                                <h2>
                                    Sử dụng AI
                                </h2>
                            </div>

                            <div class="row">

                                <div class="col-12 mt-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="type_ai_id" id="flexRadioDefault1" {{$item->type_ai_id == 1 ? 'checked' : ''}} value="1">
                                        <label class="form-check-label" for="flexRadioDefault1">
                                            Gemini
                                        </label>
                                    </div>

                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="type_ai_id" id="flexRadioDefault2" {{$item->type_ai_id == 2 ? 'checked' : ''}} value="2">
                                        <label class="form-check-label" for="flexRadioDefault2">
                                            Chat GPT
                                        </label>
                                    </div>

                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="type_ai_id" id="flexRadioDefault3" {{$item->type_ai_id == 3 ? 'checked' : ''}} value="3">
                                        <label class="form-check-label" for="flexRadioDefault3">
                                            Bing
                                        </label>
                                    </div>

                                </div>

                            </div>

                            <div class="row">

                                <div class="col-6">
                                    @include('administrator.components.input_text', ['label' => 'Token' , 'name' => 'token_chat'])
                                </div>

                            </div>

                            @include('administrator.components.button_save')
                        </div>
                    </div>

                </div>

                <div class="col-xl-6">

                    <div class="card">
                        <div class="card-body">

                            <div>
                                <h2>
                                    Nâng cao
                                </h2>
                            </div>

                            <div class="row">

                                <div class="col-6">
                                    @include('administrator.components.require_check_box', ['label' => 'Người dùng chỉ được phép sử dụng trên 1 thiết bị?' , 'name' => 'is_login_only_one_device'])
                                </div>

                            </div>


                            @include('administrator.components.button_save')
                        </div>
                    </div>

                </div>

                <div class="col-xl-6">

                    <div class="card">
                        <div class="card-body">

                            <div>
                                <h2>
                                    Chính sách & Điều khoản
                                </h2>
                            </div>

                            <div>
                                @include('administrator.components.require_textarea_description', ['name' => 'privacy_policy_html' , 'label' => 'Chính sách quyền riêng tư'])
                            </div>

                            <div>
                                @include('administrator.components.require_textarea_description', ['name' => 'terms_of_use_html' , 'label' => 'Điều khoản sử dụng'])
                            </div>


                            @include('administrator.components.button_save')
                        </div>
                    </div>

                </div>


                <div class="col-xl-6">

                    <div class="card">
                        <div class="card-body">

                            <div>
                                <h2>
                                    CSS
                                </h2>
                            </div>

                            @include('administrator.components.textarea', ['label' => 'Custom css' , 'name' => 'custom_css'])

                            @include('administrator.components.button_save')
                        </div>
                    </div>

                </div>

            </div>

        </form>
    </div>
@endsection

@section('js')
    <script>
        function onSendTestMail() {
            let value = $('#input_test_email').val()

            if (value.length) {

                if (!validateEmail(value)){
                    $('#lable_test_email').html("Email không đúng định dạng")
                }

                callAjax(
                    "POST",
                    "{{route('ajax.administrator.email.send_test_email')}}",
                    {
                        'email': value,
                    },
                    (response) => {
                        $('#lable_test_email').html(response.message)
                    },
                    (error) => {
                        $('#lable_test_email').html("Lỗi")
                    },
                    true,
                )

            } else {
                $('#lable_test_email').html("Vui lòng điền email")
            }
        }
    </script>
@endsection

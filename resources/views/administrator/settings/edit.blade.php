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

                                <div class="col-6">
                                    @include('administrator.components.input_text', ['label' => 'Token API Adserver' , 'name' => 'token_api_adserver'])
                                </div>

                            </div>

                            <div class="row align-items-end">

                                <div class="col-6">
                                    @include('administrator.components.input_text', ['label' => 'Token API AdScore' , 'name' => 'token_api_adscore'])
                                </div>

                                <div class="col-6">
                                    @include('administrator.components.input_text', ['label' => 'Account ID Adscore' , 'name' => 'account_id_adscore'])
                                </div>

                                <div class="col-6">
                                    @include('administrator.components.input_text', ['label' => 'Email contact' , 'name' => 'email_contact'])
                                </div>

                                <div class="col-6">
                                    @include('administrator.components.input_text', ['label' => 'Phone contact' , 'name' => 'phone_contact'])
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




{{--                <div class="col-xl-6">--}}

{{--                    <div class="card">--}}
{{--                        <div class="card-body">--}}

{{--                            <div>--}}
{{--                                <h2>--}}
{{--                                    Nâng cao--}}
{{--                                </h2>--}}
{{--                            </div>--}}

{{--                            <div class="row">--}}

{{--                                <div class="col-6">--}}
{{--                                    @include('administrator.components.require_check_box', ['label' => 'Người dùng chỉ được phép sử dụng trên 1 thiết bị?' , 'name' => 'is_login_only_one_device'])--}}
{{--                                </div>--}}

{{--                            </div>--}}


{{--                            @include('administrator.components.button_save')--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                </div>--}}

{{--                <div class="col-xl-6">--}}

{{--                    <div class="card">--}}
{{--                        <div class="card-body">--}}

{{--                            <div>--}}
{{--                                <h2>--}}
{{--                                    Chính sách & Điều khoản--}}
{{--                                </h2>--}}
{{--                            </div>--}}

{{--                            <div>--}}
{{--                                @include('administrator.components.require_textarea_description', ['name' => 'privacy_policy_html' , 'label' => 'Chính sách quyền riêng tư'])--}}
{{--                            </div>--}}

{{--                            <div>--}}
{{--                                @include('administrator.components.require_textarea_description', ['name' => 'terms_of_use_html' , 'label' => 'Điều khoản sử dụng'])--}}
{{--                            </div>--}}


{{--                            @include('administrator.components.button_save')--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                </div>--}}


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

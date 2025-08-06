<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <title>Admin {{env('APP_NAME')}}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Admin Infinity Ltd" name="description">
    <meta content="Pham Son" name="author">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- App favicon -->

    <link rel="shortcut icon" href="{{ \App\Models\Helper::logoImagePath() }}">

@yield('title')

<!-- Google font-->
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="{{asset('/assets/administrator/css/vendors/jquery-ui.css')}}">

    <link rel="stylesheet" href="{{asset('/assets/administrator/NobleUI/assets/fonts/feather-font/css/iconfont.css')}}">
    <link rel="stylesheet"
          href="{{asset('/assets/administrator/NobleUI/assets/vendors/flag-icon-css/css/flag-icon.min.css')}}">

    <link rel="stylesheet" href="{{asset('/assets/administrator/NobleUI/assets/vendors/core/core.css')}}">
    <link rel="stylesheet" href="{{asset('/assets/administrator/NobleUI/assets/css/demo1/style.css')}}">

    <link rel="stylesheet" href="{{asset('/assets/administrator/NobleUI/assets/vendors/flatpickr/flatpickr.min.css')}}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
          integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <link rel="stylesheet" type="text/css" media="all" href="{{asset('vendor/datetimepicker/daterangepicker.css')}}"/>
    <link rel="stylesheet" type="text/css" media="all" href="{{asset('vendor/select2/select2.min.css')}}"/>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    <script src="{{asset('/assets/administrator/NobleUI/assets/vendors/core/core.js')}}"></script>

    <script src="{{asset('/assets/administrator/js/jquery-3.5.1.min.js')}}"></script>
    <script src="{{asset('/assets/administrator/js/jquery.ui.min.js')}}"></script>
    {{--    <script src="{{asset('/vendor/jquery-ui-1.13.2/jquery-ui.js')}}"></script>--}}
    <script type='text/javascript'
            src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.1.60/inputmask/jquery.inputmask.js"></script>

    <script src="{{asset('/vendor/masknumber/jquery.masknumber.js')}}"></script>


    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

    @include('administrator.components.helper')

    <link rel="stylesheet" type="text/css" href="{{'/assets/administrator/css/master.css'}}">

    @yield('css')

    <style>

        @if(request('trash') == true)

        .container-fluid > div > div > div {
            background-color: #dbdbdb;
        }

        @endif

        {!! optional(\App\Models\Setting::first())->custom_css !!}
    </style>

</head>

<body>

<!-- Loader starts-->
<div class="main-wrapper">


@include('administrator.components.slidebars')

<!-- page-wrapper Start-->
    <div class="page-wrapper">

    @include('administrator.components.header')

    <!-- Page Body Start-->
        <div class="page-content">
            <!-- Page Sidebar Start-->

            @yield('content')

            <div id="container_action_multiple_item" class="text-start border" style="display: none;position: fixed;bottom: 0;right: 37px;width: 1045px;background-color: aliceblue;padding: 20px;z-index: 90;">
                <span class="me-3">
                    <span id="label_number_action_multiple_item">1</span> mục đã được chọn
                </span>
                <button class="btn btn-danger" onclick="onDeleteItemByCheckbox()">
                    Xóa
                </button>

                <button class="btn btn-success {{request('trash') == true ? '' : 'd-none'}}" onclick="onRestoreItemByCheckbox()">
                    Khôi phục
                </button>
            </div>

        </div>

        <!-- footer start-->

        @include('administrator.components.footer')
    </div>


    <div class="container-search-method" id="bg"
         style="top: 60px;position: absolute;width: 100%;height: 100%;background: #2b3d53;z-index: 999;opacity: 0.95;filter: blur(8px);-webkit-filter: blur(8px);">

    </div>

    <div class="container-search-method" id="container_search_method"
         style="left:240px;width: 80vw;height: 80vh; position: absolute; z-index: 1000;background-color: white; top: 60px;border-radius: 21px;">
        <div style="height: 100%;overflow: auto;" id="container_search_method_item">

        </div>
    </div>
</div>

<!--Modal-->

<div class="modal fade" id="modal_audit" tabindex="-1" aria-labelledby="changeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Lịch sử</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="content_modal_audit">

            </div>

        </div>
    </div>
</div>


<!-- Plugin js for this page -->
<script src="{{asset('/assets/administrator/NobleUI/assets/vendors/flatpickr/flatpickr.min.js')}}"></script>
<script src="{{asset('/assets/administrator/NobleUI/assets/vendors/apexcharts/apexcharts.min.js')}}"></script>
{{--<!-- End plugin js for this page -->--}}

{{--<!-- inject:js -->--}}
<script src="{{asset('/assets/administrator/NobleUI/assets/vendors/feather-icons/feather.min.js')}}"></script>
<script src="{{asset('/assets/administrator/NobleUI/assets/js/template.js')}}"></script>
<!-- endinject -->

<script src="{{asset('vendor/tinymce/tinymce.min.js') }}"></script>
<script src="{{asset('vendor/sweet-alert-2/sweetalert2@11.js')}}"></script>
<script src="{{asset('vendor/select2/select2.min.js')}}"></script>
<script type="text/javascript" src="{{asset('vendor/datetimepicker/moment.min.js')}}"></script>
<script type="text/javascript" src="{{asset('vendor/datetimepicker/daterangepicker.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/helper/main_helper.js')}}"></script>

<script type="text/javascript" src="{{asset('/assets/administrator/js/master.js')}}"></script>
<script src="{{asset('/vendor/sortablejs/Sortable.min.js')}}"></script>
<script src="{{asset('/assets/administrator/js/sortablejs-light.js')}}"></script>

@yield('js')

</body>


</html>

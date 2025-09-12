@extends('administrator.layouts.master')

@include('administrator.'.$prefixView.'.header')

@section('css')

    @include('administrator.websites.style')

@endsection

@section('content')

    <div class="container-fluid list-products">
        <div class="row">
            <div class="col-12">

                <div class="card">

                    <div class="card-header">

                        @include('administrator.'.$prefixView.'.search')

                    </div>

                    <div class="card-body">

                        @include('administrator.components.checkbox_delete_table')

                        <div class="table-responsive product-table">
                            <table class="table table-hover table-bordered">
                                <thead>
                                <tr>
                                    <th><input id="check_box_delete_all" type="checkbox" class="checkbox-parent"
                                               onclick="onSelectCheckboxDeleteItem()"></th>
                                    <th onclick='onSortSearch(`manager_id`, `{{ \App\Models\Helper::getValueInFilterReuquest('manager_id') == "" ? "asc" : (\App\Models\Helper::getValueInFilterReuquest('manager_id') != "desc" ? "desc" : "") }}`)'>
                                        <div>
                                            Manager {!! \App\Models\Helper::getValueInFilterReuquest('manager_id') == "" ? '<i class="fa-solid fa-sort"></i>' : (\App\Models\Helper::getValueInFilterReuquest('manager_id') != "desc" ? '<i class="fa-solid fa-arrow-up-a-z text-success"></i>' : '<i class="fa-solid fa-arrow-down-z-a text-danger"></i>') !!}
                                        </div>
                                    </th>
                                    <th onclick='onSortSearch(`cs_id`, `{{ \App\Models\Helper::getValueInFilterReuquest('cs_id') == "" ? "asc" : (\App\Models\Helper::getValueInFilterReuquest('cs_id') != "desc" ? "desc" : "") }}`)'>
                                        <div>
                                            CS {!! \App\Models\Helper::getValueInFilterReuquest('cs_id') == "" ? '<i class="fa-solid fa-sort"></i>' : (\App\Models\Helper::getValueInFilterReuquest('cs_id') != "desc" ? '<i class="fa-solid fa-arrow-up-a-z text-success"></i>' : '<i class="fa-solid fa-arrow-down-z-a text-danger"></i>') !!}
                                        </div>
                                    </th>
                                    <th onclick='onSortSearch(`url`, `{{ \App\Models\Helper::getValueInFilterReuquest('url') == "" ? "asc" : (\App\Models\Helper::getValueInFilterReuquest('url') != "desc" ? "desc" : "") }}`)'>
                                        <div>
                                            Url {!! \App\Models\Helper::getValueInFilterReuquest('url') == "" ? '<i class="fa-solid fa-sort"></i>' : (\App\Models\Helper::getValueInFilterReuquest('url') != "desc" ? '<i class="fa-solid fa-arrow-up-a-z text-success"></i>' : '<i class="fa-solid fa-arrow-down-z-a text-danger"></i>') !!}
                                        </div>
                                    </th>
                                    <th onclick='onSortSearch(`ads_status_website_id`, `{{ \App\Models\Helper::getValueInFilterReuquest('ads_status_website_id') == "" ? "asc" : (\App\Models\Helper::getValueInFilterReuquest('ads_status_website_id') != "desc" ? "desc" : "") }}`)'>
                                        <div>
                                            Ads.txt {!! \App\Models\Helper::getValueInFilterReuquest('ads_status_website_id') == "" ? '<i class="fa-solid fa-sort"></i>' : (\App\Models\Helper::getValueInFilterReuquest('ads_status_website_id') != "desc" ? '<i class="fa-solid fa-arrow-up-a-z text-success"></i>' : '<i class="fa-solid fa-arrow-down-z-a text-danger"></i>') !!}
                                        </div>
                                    </th>
                                    <th onclick='onSortSearch(`user_id`, `{{ \App\Models\Helper::getValueInFilterReuquest('user_id') == "" ? "asc" : (\App\Models\Helper::getValueInFilterReuquest('user_id') != "desc" ? "desc" : "") }}`)'>
                                        <div>
                                            Publisher {!! \App\Models\Helper::getValueInFilterReuquest('user_id') == "" ? '<i class="fa-solid fa-sort"></i>' : (\App\Models\Helper::getValueInFilterReuquest('user_id') != "desc" ? '<i class="fa-solid fa-arrow-up-a-z text-success"></i>' : '<i class="fa-solid fa-arrow-down-z-a text-danger"></i>') !!}
                                        </div>
                                    </th>
                                    <th>
                                        <div>
                                            Zones
                                        </div>
                                    </th>
                                    <th>
                                        <div>
                                            <span data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Max D.Impression One Day / Max D.Request One Day">Req <i class="fa-regular fa-circle-question"></i></span>
                                        </div>
                                    </th>
                                    <th onclick='onSortSearch(`status_website_id`, `{{ \App\Models\Helper::getValueInFilterReuquest('status_website_id') == "" ? "asc" : (\App\Models\Helper::getValueInFilterReuquest('status_website_id') != "desc" ? "desc" : "") }}`)'>
                                        <div>
                                            Status {!! \App\Models\Helper::getValueInFilterReuquest('status_website_id') == "" ? '<i class="fa-solid fa-sort"></i>' : (\App\Models\Helper::getValueInFilterReuquest('status_website_id') != "desc" ? '<i class="fa-solid fa-arrow-up-a-z text-success"></i>' : '<i class="fa-solid fa-arrow-down-z-a text-danger"></i>') !!}
                                        </div>
                                    </th>

                                    <th onclick='onSortSearch(`created_at`, `{{ \App\Models\Helper::getValueInFilterReuquest('created_at') == "" ? "asc" : (\App\Models\Helper::getValueInFilterReuquest('created_at') != "desc" ? "desc" : "") }}`)'>
                                        <div>
                                            Created
                                            at {!! \App\Models\Helper::getValueInFilterReuquest('created_at') == "" ? '<i class="fa-solid fa-sort"></i>' : (\App\Models\Helper::getValueInFilterReuquest('created_at') != "desc" ? '<i class="fa-solid fa-arrow-up-a-z text-success"></i>' : '<i class="fa-solid fa-arrow-down-z-a text-danger"></i>') !!}
                                        </div>
                                    </th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody class="" id="body_container_item">
                                @foreach($items as $index => $item)
                                    @include('administrator.'.$prefixView.'.row', ['item' => $item, 'prefixView' => $prefixView, 'index' => $index, 'statusWebsites' => $statusWebsites])
                                @endforeach

                                </tbody>

                                <tfoot>
                                <tr>
                                    <th><input id="check_box_delete_all_footer" type="checkbox" class="checkbox-parent"
                                               onclick="onSelectCheckboxDeleteItemFooter()"></th>
                                    <th onclick='onSortSearch(`manager_id`, `{{ \App\Models\Helper::getValueInFilterReuquest('manager_id') == "" ? "asc" : (\App\Models\Helper::getValueInFilterReuquest('manager_id') != "desc" ? "desc" : "") }}`)'>
                                        <div>
                                            Manager {!! \App\Models\Helper::getValueInFilterReuquest('manager_id') == "" ? '<i class="fa-solid fa-sort"></i>' : (\App\Models\Helper::getValueInFilterReuquest('manager_id') != "desc" ? '<i class="fa-solid fa-arrow-up-a-z text-success"></i>' : '<i class="fa-solid fa-arrow-down-z-a text-danger"></i>') !!}
                                        </div>
                                    </th>
                                    <th onclick='onSortSearch(`cs_id`, `{{ \App\Models\Helper::getValueInFilterReuquest('cs_id') == "" ? "asc" : (\App\Models\Helper::getValueInFilterReuquest('cs_id') != "desc" ? "desc" : "") }}`)'>
                                        <div>
                                            CS {!! \App\Models\Helper::getValueInFilterReuquest('cs_id') == "" ? '<i class="fa-solid fa-sort"></i>' : (\App\Models\Helper::getValueInFilterReuquest('cs_id') != "desc" ? '<i class="fa-solid fa-arrow-up-a-z text-success"></i>' : '<i class="fa-solid fa-arrow-down-z-a text-danger"></i>') !!}
                                        </div>
                                    </th>
                                    <th onclick='onSortSearch(`url`, `{{ \App\Models\Helper::getValueInFilterReuquest('url') == "" ? "asc" : (\App\Models\Helper::getValueInFilterReuquest('url') != "desc" ? "desc" : "") }}`)'>
                                        <div>
                                            Url {!! \App\Models\Helper::getValueInFilterReuquest('url') == "" ? '<i class="fa-solid fa-sort"></i>' : (\App\Models\Helper::getValueInFilterReuquest('url') != "desc" ? '<i class="fa-solid fa-arrow-up-a-z text-success"></i>' : '<i class="fa-solid fa-arrow-down-z-a text-danger"></i>') !!}
                                        </div>
                                    </th>
                                    <th onclick='onSortSearch(`ads_status_website_id`, `{{ \App\Models\Helper::getValueInFilterReuquest('ads_status_website_id') == "" ? "asc" : (\App\Models\Helper::getValueInFilterReuquest('ads_status_website_id') != "desc" ? "desc" : "") }}`)'>
                                        <div>
                                            Ads.txt {!! \App\Models\Helper::getValueInFilterReuquest('ads_status_website_id') == "" ? '<i class="fa-solid fa-sort"></i>' : (\App\Models\Helper::getValueInFilterReuquest('ads_status_website_id') != "desc" ? '<i class="fa-solid fa-arrow-up-a-z text-success"></i>' : '<i class="fa-solid fa-arrow-down-z-a text-danger"></i>') !!}
                                        </div>
                                    </th>
                                    <th onclick='onSortSearch(`user_id`, `{{ \App\Models\Helper::getValueInFilterReuquest('user_id') == "" ? "asc" : (\App\Models\Helper::getValueInFilterReuquest('user_id') != "desc" ? "desc" : "") }}`)'>
                                        <div>
                                            Publisher {!! \App\Models\Helper::getValueInFilterReuquest('user_id') == "" ? '<i class="fa-solid fa-sort"></i>' : (\App\Models\Helper::getValueInFilterReuquest('user_id') != "desc" ? '<i class="fa-solid fa-arrow-up-a-z text-success"></i>' : '<i class="fa-solid fa-arrow-down-z-a text-danger"></i>') !!}
                                        </div>
                                    </th>
                                    <th>
                                        <div>
                                            Zones
                                        </div>
                                    </th>
                                    <th>
                                        <div>
                                            <span data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Max D.Impression One Day / Max D.Request One Day">Req <i class="fa-regular fa-circle-question"></i></span>
                                        </div>
                                    </th>
                                    <th onclick='onSortSearch(`status_website_id`, `{{ \App\Models\Helper::getValueInFilterReuquest('status_website_id') == "" ? "asc" : (\App\Models\Helper::getValueInFilterReuquest('status_website_id') != "desc" ? "desc" : "") }}`)'>
                                        <div>
                                            Status {!! \App\Models\Helper::getValueInFilterReuquest('status_website_id') == "" ? '<i class="fa-solid fa-sort"></i>' : (\App\Models\Helper::getValueInFilterReuquest('status_website_id') != "desc" ? '<i class="fa-solid fa-arrow-up-a-z text-success"></i>' : '<i class="fa-solid fa-arrow-down-z-a text-danger"></i>') !!}
                                        </div>
                                    </th>

                                    <th onclick='onSortSearch(`created_at`, `{{ \App\Models\Helper::getValueInFilterReuquest('created_at') == "" ? "asc" : (\App\Models\Helper::getValueInFilterReuquest('created_at') != "desc" ? "desc" : "") }}`)'>
                                        <div>
                                            Created
                                            at {!! \App\Models\Helper::getValueInFilterReuquest('created_at') == "" ? '<i class="fa-solid fa-sort"></i>' : (\App\Models\Helper::getValueInFilterReuquest('created_at') != "desc" ? '<i class="fa-solid fa-arrow-up-a-z text-success"></i>' : '<i class="fa-solid fa-arrow-down-z-a text-danger"></i>') !!}
                                        </div>
                                    </th>
                                    <th>Action</th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                        <div>
                            @include('administrator.components.footer_table')
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>

    <div id="infoPanel" style="
  display: none;
  position: fixed;
  top: 0;
  right: 0;
  height: 100vh;
  width: 50%;
  background-color: #ffffff;
  box-shadow: -2px 0 8px rgba(0, 0, 0, 0.2);
  z-index: 1050;
  overflow-y: auto;
  padding: 20px;
">
        <div class="float-end">
            <a id="closePanel" title="Đóng" class="btn btn-outline-danger btn-sm">
                <i class="fa-solid fa-x"></i>
            </a>
        </div>
        <h4 id="panel_zone_label_url_website">

        </h4>
        <div id="panelContent">Loading...</div>
    </div>

    <!-- Modal create website -->
    <div class="modal fade" id="create_website_modal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Create website</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="container_modal_create_website">


                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" onclick="onSubmitCreateWebsite()" class="btn btn-success">Save</button>
                </div>

            </div>
        </div>
    </div>

    <!-- Modal get ad zone website -->
    <div class="modal fade" id="ad_zone_website_modal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="title_ad_zone_website_modal"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="container_ad_zone_website_modal">

                </div>
            </div>
        </div>
    </div>

    <!-- Modal get time zone website -->
    <div class="modal fade" id="time_zone_website_modal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="title_time_zone_website_modal"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="container_time_zone_website_modal">

                </div>
            </div>
        </div>
    </div>

    <!-- Modal view and edit website -->
    <div class="modal fade" id="view_and_edit_website_modal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <a href="#" id="title_view_and_edit_website_modal">

                        </a>
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="container_view_and_edit_website_modal">

                </div>
            </div>
        </div>
    </div>

    <!-- Modal modal_view_and_edit_ads -->
    <div class="modal fade" id="modal_view_and_edit_ads" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Infor</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="container_modal_view_and_edit_ads">

                </div>
            </div>
        </div>
    </div>

    <!-- Modal panel_zone_detail_zone -->
    <div class="modal fade" id="modal_panel_zone_detail_zone" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="title_modal_panel_zone_detail_zone"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="container_panel_zone_detail_zone">

                </div>
            </div>
        </div>
    </div>

    <!-- Modal view_all_zone -->
    <div class="modal fade" id="modal_view_all_zone" aria-hidden="true" style="z-index:1051;">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="d-flex gap-1">
                        <h5 class="modal-title" id="modal_view_all_zone_title"></h5>

                        @can('websites-add-zone')
                        <button onclick="onShowModalCreateZone()" class="btn btn-success float-end"
                                title="Create zone">Create zone <i class="fa-solid fa-plus ms-1"></i></button>
                        @endcan
                    </div>

                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="container_modal_view_all_zone">

                </div>
            </div>
        </div>
    </div>

    <!-- Modal Create zone -->
    <div class="modal fade" id="modal_create_zone" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="d-flex gap-1">
                        <h5 class="modal-title" id="title_modal_create_zone"></h5>
                    </div>

                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="container_modal_create_zone">

                </div>
            </div>
        </div>
    </div>

    <!-- Modal change status -->
    <div class="modal fade" id="modal_change_status" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal_change_status_title"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="container_modal_change_status">

                </div>
            </div>
        </div>
    </div>

    <!-- Modal check status zone online status -->
    <div class="modal fade" id="modal_check_status_zone_online" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal_check_status_zone_online_title"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="container_modal_check_status_zone_online">

                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="userModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered custom-modal">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">User View: <span id="modalUserName"></span></h5>
                </div>
                <div class="modal-body p-0">
                    <iframe id="userIframe" src="" width="100%" style="height: 80vh" frameborder="0"></iframe>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal add cs child -->
    <div class="modal fade" id="modal_add_cs_child" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="title_modal_add_cs_child"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="container_modal_add_cs_child">


                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')
    <script>

        is_show_modal_view_all_zone = true;

        $(function () {

            const time_zone_website_modal = document.querySelector('#time_zone_website_modal');
            time_zone_website_modal.addEventListener('hidden.bs.modal', function () {
                showModal('modal_view_all_zone');
            });

            const ad_zone_website_modal = document.querySelector('#ad_zone_website_modal');
            ad_zone_website_modal.addEventListener('hidden.bs.modal', function () {
                showModal('modal_view_all_zone');
            });

            const modal_panel_zone_detail_zone = document.querySelector('#modal_panel_zone_detail_zone');
            modal_panel_zone_detail_zone.addEventListener('hidden.bs.modal', function () {
                showModal('modal_view_all_zone');
            });

            const modal_create_zone = document.querySelector('#modal_create_zone');
            modal_create_zone.addEventListener('hidden.bs.modal', function () {
                if (is_show_modal_view_all_zone)
                showModal('modal_view_all_zone');
            });

            const modal_check_status_zone_online = document.querySelector('#modal_check_status_zone_online');
            modal_check_status_zone_online.addEventListener('hidden.bs.modal', function () {
                showModal('modal_view_all_zone');
            });

        });

        function onShowModalCreateWebsite() {
            callAjax(
                "GET",
                "{{route('ajax.administrator.'.$prefixView.'.create')}}",
                {
                    'modal_id': 'create_website_modal'
                },
                (response) => {
                    $('#container_modal_create_website').html(response.data.html)
                    showModal("create_website_modal")
                },
                (error) => {

                }
            )
        }

        function onSubmitCreateWebsite() {
            hideModal('create_website_modal');
            showToastLoading("Cretaing website...");
            processStoreWebsite();
        }

        function processStoreWebsite() {

            callAjax(
                "POST",
                "{{route('ajax.administrator.'.$prefixView.'.store')}}",
                {
                    'user_id': $('#modal_create_website_user_id').val(),
                    'url': $('#modal_create_website_input_name').val(),
                    'category_website_id': $('#modal_create_website_select_category_website_id').val(),
                    'status_website_id': $('#modal_create_website_select_status_website_id').val(),
                },
                (response) => {
                    if (response.code == 219) {
                        setTimeout(processStoreWebsite(), 5000);
                    } else {
                        hideAllToast()
                        if (response.is_success) {
                            showToastSuccess('Created website');
                            addRowAffterStoreWebsite(response.website_id);
                        } else {
                            showToastError('Có lỗi khởi tạo');
                        }
                    }

                },
                (error) => {

                }, false
            )
        }

        function addRowAffterStoreWebsite(website_id) {
            callAjax(
                "GET",
                "{{route('ajax.administrator.'.$prefixView.'.row')}}",
                {
                    'website_id': website_id
                },
                (response) => {
                    const row_html = response.data.html;
                    $('#body_container_item').prepend(row_html).fadeIn(1000);
                },
                (error) => {

                }, false
            )
        }

        function onShowModalCreateZone(website_id = null) {
            if (!website_id) {
                is_show_modal_view_all_zone = true;
                website_id = $('#modal_view_all_zone_title').attr("data-id");
            }else{
                is_show_modal_view_all_zone = false;
            }

            callAjax(
                "GET",
                "{{route('ajax.administrator.zone_websites.modal_create')}}",
                {
                    website_id: website_id,
                    is_hide_all_pre_modal: true,
                    modal_id: 'modal_create_zone',
                },
                (response) => {
                    showModal('modal_create_zone');
                    $('#title_modal_create_zone').html(response.data.website.name);
                    $('#container_modal_create_zone').html(response.data.html).fadeIn(1000);
                },
                (error) => {

                }
            )
        }

        function onGetAdCodeZone(zone_website_id) {
            callAjax(
                "GET",
                "{{route('ajax.administrator.zone_websites.ad_code')}}",
                {
                    zone_website_id: zone_website_id,
                    is_hide_all_pre_modal: true,
                },
                (response) => {
                    showModal('ad_zone_website_modal');
                    $('#title_ad_zone_website_modal').html(response.data.item.name + " #" + response.data.item.id);
                    $('#container_ad_zone_website_modal').html(response.data.html).fadeIn(1000);
                },
                (error) => {

                }
            )
        }

        function onGetTimeZone(zone_website_id) {
            callAjax(
                "GET",
                "{{route('ajax.administrator.zone_websites.time')}}",
                {
                    zone_website_id: zone_website_id,
                    is_hide_all_pre_modal: true,
                },
                (response) => {
                    showModal('time_zone_website_modal');
                    $('#title_time_zone_website_modal').html(response.data.item.name + " #" + response.data.item.id);
                    $('#container_time_zone_website_modal').html(response.data.html).fadeIn(1000);
                },
                (error) => {

                }
            )
        }

        function onDeleteZone(website_id, zone_website_id, message = "Are you sure?") {
            Swal.fire({
                title: message,
                text: "The action cannot be undone!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Do it!',
                cancelButtonText: 'No'
            }).then((result) => {
                if (result.isConfirmed) {
                    callAjax(
                        "DELETE",
                        "{{route('ajax.administrator.zone_websites.delete')}}",
                        {
                            'zone_website_id': zone_website_id
                        },
                        (response) => {
                            showToastSuccess("Deleted!");
                            $('#modal_view_all_zones_tr_row_' + zone_website_id).fadeOut(1000);
                            onRefreshRow(website_id);
                        },
                        (error) => {

                        }, false
                    )
                }
            })
        }

        function onViewAndEdit(website_id) {
            callAjax(
                "GET",
                "{{route('ajax.administrator.'.$prefixView.'.get')}}",
                {
                    id: website_id,
                    modal_id: 'view_and_edit_website_modal',
                },
                (response) => {
                    showModal('view_and_edit_website_modal')
                    $('#title_view_and_edit_website_modal').attr("href", response.data.item.url);
                    $('#title_view_and_edit_website_modal').html(response.data.item.name).fadeIn(1000);
                    $('#container_view_and_edit_website_modal').html(response.data.html).fadeIn(1000);
                },
                (error) => {

                }
            )
        }

        function onStoreZones(website_id) {
            showLoading("Creating Zone...");
            processStoreZone(website_id);
        }

        function processStoreZone(website_id) {

            const dimension_ids = [];
            const numbers = [];

            document.querySelectorAll("input[name='panel_zone_checkbox_dimension']:checked").forEach(cb => {
                const numberInput = cb.closest('.checkbox-item').querySelector('input[type="number"]');
                dimension_ids.push(cb.value);
                numbers.push(numberInput.value);
            });

            callAjax(
                "POST",
                "{{route('ajax.administrator.zone_websites.store')}}",
                {
                    id: website_id,
                    name: $('#panel_zone_input_zone_name').val(),
                    dimension_ids: dimension_ids,
                    numbers: numbers,
                    zone_status_id: $('#panel_zone_select_zone_status_id').val(),
                },
                (response) => {
                    if (response.code == 219) {
                        setTimeout(processStoreZone(website_id), 5000);
                    } else {
                        if (response.is_success || response.code == 200) {
                            hideLoading();
                            hideModal('modal_create_zone');
                            showToastSuccess('Created Zone');
                            onRefreshRow(website_id);
                            prependWithAnimation('#modal_view_all_zones_body_container_item', response.data.html, 'pop', false, 1500);
                            for(let i = 0; i < response.data.zone_ids.length ; i++){
                                processTakeCode(response.data.zone_ids[i]);
                            }

                        } else {
                            showToastError('Có lỗi khởi tạo');
                        }
                    }

                },
                (error) => {

                }, false
            )
        }

        function onRefreshTraffic(website_id) {
            callAjax(
                "GET",
                "{{route('ajax.administrator.'.$prefixView.'.refresh_traffic')}}",
                {
                    id: website_id,
                },
                (response) => {
                    prependWithAnimation("#container_modal_view_and_edit_website_traffics", response.data.html, "vibrate", true);
                },
                (error) => {

                }
            )

        }

        function processTakeCode(zone_id) {
            callAjax(
                "GET",
                "{{route('ajax.administrator.zone_websites.refresh_take_code')}}",
                {
                    id: zone_id,
                },
                (response) => {
                    if (response.code == 219) {
                        setTimeout(processTakeCode(zone_id), 2000);
                    } else {
                        if (response.is_success || response.code == 200) {
                            $('#modal_view_all_zones_tr_row_' + zone_id).after(response.data.html).remove();
                        } else {
                            showToastError('Có lỗi khởi tạo');
                        }
                    }
                },
                (error) => {

                },false
            )

        }

        function onUpdateWebsite(website_id) {
            callAjax(
                "PUT",
                "{{route('ajax.administrator.model.update_field')}}",
                {
                    id: website_id,
                    note: $('#modal_view_and_edit_website_input_note').val(),
                    model: 'websites',
                },
                (response) => {
                    showToastSuccess('Saved!');
                },
                (error) => {

                }
            )
        }

        function onViewAndEditAds(website_id) {
            callAjax(
                "GET",
                "{{route('ajax.administrator.'.$prefixView.'.modal_view_and_edit_ads')}}",
                {
                    id: website_id,
                },
                (response) => {
                    $('#container_modal_view_and_edit_ads').html(response.data.html);
                    showModal('modal_view_and_edit_ads')
                },
                (error) => {

                }
            )
        }

        function onUpdateAds(website_id) {
            callAjax(
                "PUT",
                "{{route('ajax.administrator.model.update_field')}}",
                {
                    id: website_id,
                    ads: $('#modal_view_and_edit_ads_input_ads').val(),
                    model: 'websites',
                },
                (response) => {
                    showToastSuccess('Saved!');
                },
                (error) => {

                }
            )
        }

        function onDetailZone(id) {
            callAjax(
                "GET",
                "{{route('ajax.administrator.zone_websites.modal_detail_zone')}}",
                {
                    id: id,
                    is_hide_all_pre_modal: true,
                },
                (response) => {
                    $('#title_modal_panel_zone_detail_zone').html(response.data.item.name + " #" + response.data.item.id);
                    $('#container_panel_zone_detail_zone').html(response.data.html).fadeIn(1000);
                    showModal('modal_panel_zone_detail_zone');
                },
                (error) => {

                }
            )
        }

        function panelZoneToggleGroup(btn) {
            const group = btn.closest('.group');
            const checkboxes = group.querySelectorAll('input[type="checkbox"]');
            const allChecked = Array.from(checkboxes).every(cb => cb.checked);
            checkboxes.forEach(cb => cb.checked = !allChecked);
            btn.textContent = allChecked ? "Select All" : "Deselect All";
        }

        function onViewAllZone(website_id) {
            callAjax(
                "GET",
                "{{route('ajax.administrator.'.$prefixView.'.view_all_zones')}}",
                {
                    id: website_id,
                    modal_id: 'view_all_website_modal',
                },
                (response) => {
                    showModal('modal_view_all_zone');
                    $('#modal_view_all_zone_title').html(response.data.website.name);
                    $('#modal_view_all_zone_title').attr("data-id", website_id);
                    $('#container_modal_view_all_zone').html(response.data.html);
                },
                (error) => {

                }
            )
        }

        function onChangeStatusWebsite(website_id) {
            callAjax(
                "GET",
                "{{route('ajax.administrator.'.$prefixView.'.modal_change_status')}}",
                {
                    id: website_id,
                    modal_id: 'modal_change_status',
                },
                (response) => {
                    showModal('modal_change_status');
                    $('#modal_change_status_title').html(response.data.website.name);
                    $('#container_modal_change_status').html(response.data.html);
                },
                (error) => {

                }
            )
        }

        function onShowModalCheckStatusZoneOnline(zone_id) {
            callAjax(
                "GET",
                "{{route('ajax.administrator.zone_websites.modal_check_status_zone_online')}}",
                {
                    id: zone_id,
                    modal_id: 'modal_check_status_zone_online',
                    is_hide_all_pre_modal: true,
                },
                (response) => {
                    showModal('modal_check_status_zone_online');
                    $('#modal_check_status_zone_online_title').html(response.data.item.name);
                    $('#container_modal_check_status_zone_online').html(response.data.html);
                },
                (error) => {

                }
            )
        }

        function onCheckStatusZoneOnline(zone_id) {
            showLoading("Checking Zone...");
            processCheckStatusZoneOnline(zone_id);
        }

        function processCheckStatusZoneOnline(zone_id) {

            callAjax(
                "POST",
                "{{route('ajax.administrator.zone_websites.check_status_zone_online')}}",
                {
                    id: zone_id,
                    url: $('#modal_check_status_zone_online_input_url').val(),
                },
                (response) => {
                    if (response.code == 219) {
                        setTimeout(processCheckStatusZoneOnline(zone_id), 5000);
                    } else {
                        if (response.is_success || response.code == 200) {
                            $('#modal_view_all_zones_tr_row_' + zone_id).after(response.data.html).remove();
                            hideLoading();
                            hideModal('modal_check_status_zone_online');
                            showToastSuccess(response.data.item.zone_website_online_status.name);
                            onRefreshRow(response.data.website.id);
                        } else {
                            showToastError();
                        }
                    }

                },
                (error) => {

                }, false
            )
        }

        function onSaveStatusWebsite(website_id) {
            callAjax(
                "PUT",
                "{{route('ajax.administrator.'.$prefixView.'.change_status')}}",
                {
                    id: website_id,
                    status_website_id: $('#modal_change_status_status_website_id').val(),
                    reason_refuse: $('#modal_change_status_textarea').val(),
                    status_website_reason_id: $('#modal_change_status_select_reason').val(),
                },
                (response) => {
                    hideModal('modal_change_status');
                    $('tr[data-id="' + website_id + '"]').after(response.data.html).remove();
                },
                (error) => {

                }
            )
        }

        function onRefreshRow(website_id) {
            callAjax(
                "GET",
                "{{route('ajax.administrator.'.$prefixView.'.row')}}",
                {
                    website_id: website_id,
                },
                (response) => {
                    $('tr[data-id="' + website_id + '"]').after(response.data.html).remove();
                },
                (error) => {

                }, false
            )
        }

        function onSaveZone(zone_id) {
            callAjax(
                "PUT",
                "{{route('ajax.administrator.zone_websites.update_time')}}",
                {
                    id: zone_id,
                    time_delay: $('#panel_zone_item_zone_input_time_delay').val(),
                    frequency_cap_impression: $('#panel_zone_item_zone_input_frequency_cap_impression').val(),
                    frequency_cap_number_time: $('#panel_zone_item_zone_input_frequency_cap_number_time').val(),
                    zone_time_type_id: $('#panel_zone_item_zone_select_time_type_id').val(),
                },
                (response) => {
                    hideModal('time_zone_website_modal');
                    showToastSuccess("Save!");
                },
                (error) => {

                }
            )
        }

        function onSaveZoneAndCampaign(zone_id) {
            callAjax(
                "PUT",
                "{{route('ajax.administrator.zone_websites.update_zone_and_campaign')}}",
                {
                    id: zone_id,
                    width: $('#panel_zone_detail_zone_input_width').val(),
                    height: $('#panel_zone_detail_zone_input_height').val(),
                    content_html: $('#panel_zone_detail_zone_input_content_html').val(),
                    generate_code: $('#panel_zone_detail_zone_input_generate_code').val(),
                },
                (response) => {
                    hideModal('modal_panel_zone_detail_zone');
                    showToastSuccess("Save!")
                },
                (error) => {

                }
            )
        }

        function onShowModalAddCSChild(website_id) {
            callAjax(
                "GET",
                "{{route('ajax.administrator.websites.modal_add_cs_child')}}",
                {
                    id: website_id,
                    modal_id: 'modal_add_cs_child',
                },
                (response) => {
                    showModal('modal_add_cs_child');
                    $('#title_modal_add_cs_child').html(response.data.user.email);
                    $('#container_modal_add_cs_child').html(response.data.html);
                },
                (error) => {

                }
            )
        }

        function onSaveCSChild(website_id) {
            callAjax(
                "PUT",
                "{{route('ajax.administrator.websites.save_cs_child')}}",
                {
                    id: website_id,
                    cs_id: $('#modal_add_cs_child_select_cs_id').val(),
                },
                (response) => {
                    hideModal('modal_add_cs_child');
                    onRefreshRow(website_id);
                    showToastSuccess('Saved!')
                },
                (error) => {

                }
            )
        }

        document.addEventListener("DOMContentLoaded", () => {
            let modal = document.getElementById('userModal');
            let iframe = document.getElementById("userIframe");

            modal.addEventListener('show.bs.modal', function (event) {
                let button = event.relatedTarget;
                let userId = button.getAttribute('data-userid');
                let userName = button.getAttribute('data-username');

                document.getElementById('modalUserName').innerText = userName;
                iframe.src = "/admin/user-view/" + userId;
            });
        });

        window.addEventListener("message", function(event) {
            if (event.data.action === "closeModal") {
                let modal = bootstrap.Modal.getInstance(document.getElementById('userModal'));
                modal.hide();
            }
        });
    </script>

@endsection


@extends('administrator.layouts.master')

@include('administrator.'.$prefixView.'.header')

@section('css')
    <style>
        .group {
            margin-bottom: 18px;
            border-left: 4px solid transparent;
            padding-left: 10px;
        }
        .group-title {
            font-size: 15px;
            font-weight: bold;
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .group-title button {
            font-size: 12px;
            padding: 4px 8px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            background: #e5e7eb;
            color: #111827;
        }
        .group-title button:hover {
            background: #d1d5db;
        }

        /* Custom checkbox */
        .checkbox-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: #f9fafb;
            padding: 10px;
            border-radius: 8px;
            margin-bottom: 6px;
            cursor: pointer;
            transition: background .2s, transform .2s;
        }
        .checkbox-item:hover {
            background: #eef2ff;
            transform: translateX(2px);
        }
        .checkbox-item input {
            display: none;
        }
        .checkmark {
            width: 18px;
            height: 18px;
            border-radius: 5px;
            border: 2px solid #9ca3af;
            display: inline-block;
            margin-right: 10px;
            position: relative;
            transition: border .2s, background .2s;
            top: 4px;
        }
        .checkbox-item input:checked + .checkmark {
            background: var(--accent);
            border-color: var(--accent);
        }
        .checkbox-item input:checked + .checkmark::after {
            content: "✓";
            color: white;
            font-size: 12px;
            position: absolute;
            top: -2px; left: 3px;
        }
        .label-text {
            font-size: 14px;
            color: #374151;
            font-weight: 500;
        }

        .group.blue { border-color: #3b82f6; --accent: #3b82f6; }
    </style>

    <style>

        .card:hover {
            border-color: #cbd5e1; /* darker border on hover */
        }

        .name {
            font-size: 15px;
            font-weight: 600;
            margin-top: 2px;
        }


        .btn svg { width: 18px; height: 18px; }

        .btn-code { background: #3b82f6; color: white; }
        .btn-config { background: #10b981; color: white; }
        .btn-delete { background: #ef4444; color: white; }

        .checkbox-item input[type="number"] {
            width: 60px;
            padding: 4px;
            font-size: 13px;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            text-align: center;
            display: block !important;
        }


    </style>
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
                                        <div>Manager {!! \App\Models\Helper::getValueInFilterReuquest('manager_id') == "" ? '<i class="fa-solid fa-sort"></i>' : (\App\Models\Helper::getValueInFilterReuquest('manager_id') != "desc" ? '<i class="fa-solid fa-arrow-up-a-z text-success"></i>' : '<i class="fa-solid fa-arrow-down-z-a text-danger"></i>') !!}
                                        </div>
                                    </th>
                                    <th onclick='onSortSearch(`cs_id`, `{{ \App\Models\Helper::getValueInFilterReuquest('cs_id') == "" ? "asc" : (\App\Models\Helper::getValueInFilterReuquest('cs_id') != "desc" ? "desc" : "") }}`)'>
                                        <div>CS {!! \App\Models\Helper::getValueInFilterReuquest('cs_id') == "" ? '<i class="fa-solid fa-sort"></i>' : (\App\Models\Helper::getValueInFilterReuquest('cs_id') != "desc" ? '<i class="fa-solid fa-arrow-up-a-z text-success"></i>' : '<i class="fa-solid fa-arrow-down-z-a text-danger"></i>') !!}
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
                                            Req
                                        </div>
                                    </th>
                                    <th onclick='onSortSearch(`status_website_id`, `{{ \App\Models\Helper::getValueInFilterReuquest('status_website_id') == "" ? "asc" : (\App\Models\Helper::getValueInFilterReuquest('status_website_id') != "desc" ? "desc" : "") }}`)'>
                                        <div>
                                            Status {!! \App\Models\Helper::getValueInFilterReuquest('status_website_id') == "" ? '<i class="fa-solid fa-sort"></i>' : (\App\Models\Helper::getValueInFilterReuquest('status_website_id') != "desc" ? '<i class="fa-solid fa-arrow-up-a-z text-success"></i>' : '<i class="fa-solid fa-arrow-down-z-a text-danger"></i>') !!}
                                        </div>
                                    </th>

                                    <th onclick='onSortSearch(`created_at`, `{{ \App\Models\Helper::getValueInFilterReuquest('created_at') == "" ? "asc" : (\App\Models\Helper::getValueInFilterReuquest('created_at') != "desc" ? "desc" : "") }}`)'>
                                        <div>
                                            Created at {!! \App\Models\Helper::getValueInFilterReuquest('created_at') == "" ? '<i class="fa-solid fa-sort"></i>' : (\App\Models\Helper::getValueInFilterReuquest('created_at') != "desc" ? '<i class="fa-solid fa-arrow-up-a-z text-success"></i>' : '<i class="fa-solid fa-arrow-down-z-a text-danger"></i>') !!}
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
                                        <div>Manager {!! \App\Models\Helper::getValueInFilterReuquest('manager_id') == "" ? '<i class="fa-solid fa-sort"></i>' : (\App\Models\Helper::getValueInFilterReuquest('manager_id') != "desc" ? '<i class="fa-solid fa-arrow-up-a-z text-success"></i>' : '<i class="fa-solid fa-arrow-down-z-a text-danger"></i>') !!}
                                        </div>
                                    </th>
                                    <th onclick='onSortSearch(`cs_id`, `{{ \App\Models\Helper::getValueInFilterReuquest('cs_id') == "" ? "asc" : (\App\Models\Helper::getValueInFilterReuquest('cs_id') != "desc" ? "desc" : "") }}`)'>
                                        <div>CS {!! \App\Models\Helper::getValueInFilterReuquest('cs_id') == "" ? '<i class="fa-solid fa-sort"></i>' : (\App\Models\Helper::getValueInFilterReuquest('cs_id') != "desc" ? '<i class="fa-solid fa-arrow-up-a-z text-success"></i>' : '<i class="fa-solid fa-arrow-down-z-a text-danger"></i>') !!}
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
                                            Req
                                        </div>
                                    </th>
                                    <th onclick='onSortSearch(`status_website_id`, `{{ \App\Models\Helper::getValueInFilterReuquest('status_website_id') == "" ? "asc" : (\App\Models\Helper::getValueInFilterReuquest('status_website_id') != "desc" ? "desc" : "") }}`)'>
                                        <div>
                                            Status {!! \App\Models\Helper::getValueInFilterReuquest('status_website_id') == "" ? '<i class="fa-solid fa-sort"></i>' : (\App\Models\Helper::getValueInFilterReuquest('status_website_id') != "desc" ? '<i class="fa-solid fa-arrow-up-a-z text-success"></i>' : '<i class="fa-solid fa-arrow-down-z-a text-danger"></i>') !!}
                                        </div>
                                    </th>

                                    <th onclick='onSortSearch(`created_at`, `{{ \App\Models\Helper::getValueInFilterReuquest('created_at') == "" ? "asc" : (\App\Models\Helper::getValueInFilterReuquest('created_at') != "desc" ? "desc" : "") }}`)'>
                                        <div>
                                            Created at {!! \App\Models\Helper::getValueInFilterReuquest('created_at') == "" ? '<i class="fa-solid fa-sort"></i>' : (\App\Models\Helper::getValueInFilterReuquest('created_at') != "desc" ? '<i class="fa-solid fa-arrow-up-a-z text-success"></i>' : '<i class="fa-solid fa-arrow-down-z-a text-danger"></i>') !!}
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
                    <h5 class="modal-title">Ad code</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="container_ad_zone_website_modal">

                </div>
            </div>
        </div>
    </div>

    <!-- Modal view and edit website -->
    <div class="modal fade" id="view_and_edit_website_modal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Infor</h5>
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
                    <h5 class="modal-title">Infor</h5>
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
                    <h5 class="modal-title" id="modal_view_all_zone_title">Infor</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="container_modal_view_all_zone">

                </div>
            </div>
        </div>
    </div>

    <!-- Modal change status -->
    <div class="modal fade" id="modal_change_status" aria-hidden="true" style="z-index:1051;">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal_change_status_title">Infor</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="container_modal_change_status">

                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')
    <script>
        $(function () {

            $(document).on('click','#body_container_item > tr > td > *', function (ev) {
                ev.stopPropagation();
            });
            // Click on row
            $(document).on('click','#body_container_item tr', function () {
                // onViewAndEdit(this.getAttribute('data-id'))
            });

            // Close button
            $('#closePanel').on('click', function () {
                $('#infoPanel').fadeOut(200);
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

        function onCreateZone(website_id) {
            if ($('.modal:visible').length) {
                // Modal is open, ignore this click
                return;
            }

            const id = $(this).data('id');

            $('#panelContent').html("<div class=\"spinner-border text-primary\" role=\"status\">\n" +
                "  <span class=\"visually-hidden\">Loading...</span>\n" +
                "</div>")

            callAjax(
                "GET",
                "{{route('ajax.administrator.'.$prefixView.'.panel_zone')}}",
                {
                    'website_id': website_id
                },
                (response) => {
                    $('#panel_zone_label_url_website').html(response.data.website.url);
                    $('#panelContent').html(response.data.html);
                },
                (error) => {

                },false
            )

            $('#infoPanel').hide().show("slide", { direction: "right" }, 500);
        }

        function onGetAdCodeZone(zone_website_id) {
            callAjax(
                "GET",
                "{{route('ajax.administrator.zone_websites.ad_code')}}",
                {
                    'zone_website_id': zone_website_id
                },
                (response) => {
                    showModal('ad_zone_website_modal')
                    $('#container_ad_zone_website_modal').html(response.data.html).fadeIn(1000);
                },
                (error) => {

                }
            )
        }

        function onDeleteZone(website_id, zone_website_id) {
            Swal.fire({
                title: 'Bạn có chắc?',
                text: "Tác vụ sẽ không thể hoàn tác!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Vâng, xóa nó!',
                cancelButtonText: 'Không'
            }).then((result) => {
                if (result.isConfirmed) {
                    callAjax(
                        "DELETE",
                        "{{route('ajax.administrator.zone_websites.delete')}}",
                        {
                            'zone_website_id': zone_website_id
                        },
                        (response) => {
                            showToastSuccess("Deleted Zone");
                            $('#container_zone_website_' + zone_website_id).fadeOut(200);
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
                    $('#container_view_and_edit_website_modal').html(response.data.html).fadeIn(1000);
                },
                (error) => {

                }
            )
        }

        function onStoreZones(website_id) {
            $('#panel_zone_collapse').collapse('hide');
            showToastLoading("Creating Zone...");
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
                        hideAllToast()
                        if (response.is_success || response.code == 200) {
                            showToastSuccess('Created Zone');
                            prependWithAnimation("#panel_zone_container_zones", response.data.html);
                            onRefreshRow(website_id);

                            $(".panel_zone_checkbox_dimension").prop("checked", false).trigger("change");
                            $(".panel_zone_input_number_dimension").val(1);


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
                },
                (response) => {

                    $('#container_panel_zone_detail_zone').html(response.data.html)
                    showModal('modal_panel_zone_detail_zone')
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
                    modal_id: 'view_all_website_modal',
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
                    $('tr[data-id="'+website_id+'"]').after(response.data.html).remove();
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
                    $('tr[data-id="'+website_id+'"]').after(response.data.html).remove();
                },
                (error) => {

                },false
            )
        }


    </script>
@endsection


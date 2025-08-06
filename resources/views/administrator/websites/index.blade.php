@extends('administrator.layouts.master')

@include('administrator.'.$prefixView.'.header')

@section('css')

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
                                    <th onclick='onSortSearch(`id`, `{{ \App\Models\Helper::getValueInFilterReuquest('id') == "" ? "asc" : (\App\Models\Helper::getValueInFilterReuquest('id') != "desc" ? "desc" : "") }}`)'>
                                        <div>
                                            # {!! \App\Models\Helper::getValueInFilterReuquest('id') == "" ? '<i class="fa-solid fa-sort"></i>' : (\App\Models\Helper::getValueInFilterReuquest('id') != "desc" ? '<i class="fa-solid fa-arrow-up-a-z text-success"></i>' : '<i class="fa-solid fa-arrow-down-z-a text-danger"></i>') !!}
                                        </div>
                                    </th>
                                    <th onclick='onSortSearch(`manager_id`, `{{ \App\Models\Helper::getValueInFilterReuquest('manager_id') == "" ? "asc" : (\App\Models\Helper::getValueInFilterReuquest('manager_id') != "desc" ? "desc" : "") }}`)'>
                                        <div>
                                            Account
                                            Manager {!! \App\Models\Helper::getValueInFilterReuquest('manager_id') == "" ? '<i class="fa-solid fa-sort"></i>' : (\App\Models\Helper::getValueInFilterReuquest('manager_id') != "desc" ? '<i class="fa-solid fa-arrow-up-a-z text-success"></i>' : '<i class="fa-solid fa-arrow-down-z-a text-danger"></i>') !!}
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
                                            Thời gian
                                            tạo {!! \App\Models\Helper::getValueInFilterReuquest('created_at') == "" ? '<i class="fa-solid fa-sort"></i>' : (\App\Models\Helper::getValueInFilterReuquest('created_at') != "desc" ? '<i class="fa-solid fa-arrow-up-a-z text-success"></i>' : '<i class="fa-solid fa-arrow-down-z-a text-danger"></i>') !!}
                                        </div>
                                    </th>
                                    <th>Hành động</th>
                                </tr>
                                </thead>
                                <tbody class="" id="body_container_item">
                                @foreach($items as $index => $item)
                                    @include('administrator.'.$prefixView.'.row', ['item' => $item, 'prefixView' => $prefixView, 'index' => $index])
                                @endforeach

                                </tbody>

                                <tfoot>
                                <tr>
                                    <th><input id="check_box_delete_all_footer" type="checkbox" class="checkbox-parent"
                                               onclick="onSelectCheckboxDeleteItemFooter()"></th>
                                    <th onclick='onSortSearch(`id`, `{{ \App\Models\Helper::getValueInFilterReuquest('id') == "" ? "asc" : (\App\Models\Helper::getValueInFilterReuquest('id') != "desc" ? "desc" : "") }}`)'>
                                        <div>
                                            # {!! \App\Models\Helper::getValueInFilterReuquest('id') == "" ? '<i class="fa-solid fa-sort"></i>' : (\App\Models\Helper::getValueInFilterReuquest('id') != "desc" ? '<i class="fa-solid fa-arrow-up-a-z text-success"></i>' : '<i class="fa-solid fa-arrow-down-z-a text-danger"></i>') !!}
                                        </div>
                                    </th>
                                    <th onclick='onSortSearch(`manager_id`, `{{ \App\Models\Helper::getValueInFilterReuquest('manager_id') == "" ? "asc" : (\App\Models\Helper::getValueInFilterReuquest('manager_id') != "desc" ? "desc" : "") }}`)'>
                                        <div>
                                            Account
                                            Manager {!! \App\Models\Helper::getValueInFilterReuquest('manager_id') == "" ? '<i class="fa-solid fa-sort"></i>' : (\App\Models\Helper::getValueInFilterReuquest('manager_id') != "desc" ? '<i class="fa-solid fa-arrow-up-a-z text-success"></i>' : '<i class="fa-solid fa-arrow-down-z-a text-danger"></i>') !!}
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
                                            Thời gian
                                            tạo {!! \App\Models\Helper::getValueInFilterReuquest('created_at') == "" ? '<i class="fa-solid fa-sort"></i>' : (\App\Models\Helper::getValueInFilterReuquest('created_at') != "desc" ? '<i class="fa-solid fa-arrow-up-a-z text-success"></i>' : '<i class="fa-solid fa-arrow-down-z-a text-danger"></i>') !!}
                                        </div>
                                    </th>
                                    <th>Hành động</th>
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
            <a id="closePanel" href="#" title="Đóng" class="btn btn-outline-danger btn-sm">
                <i class="fa-solid fa-x"></i>
            </a>
        </div>
        <h4>Zones</h4>
        <div id="panelContent">Loading...</div>
    </div>

    <!-- Modal create website -->
    <div class="modal fade" id="create_website_modal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tạo 1 website mới</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="container_modal_create_website">


                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="button" onclick="onSubmitCreateWebsite()" class="btn btn-success">Xác nhận</button>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(function () {
            // Click on row
            $(document).on('click','tr', function () {
                const id = $(this).data('id');

                $('#panelContent').html("<div class=\"spinner-border text-primary\" role=\"status\">\n" +
                    "  <span class=\"visually-hidden\">Loading...</span>\n" +
                    "</div>")

                callAjax(
                    "GET",
                    "{{route('ajax.administrator.'.$prefixView.'.panel_zone')}}",
                    {
                        'website_id': id
                    },
                    (response) => {
                        $('#panelContent').html(response.data.html)
                    },
                    (error) => {

                    },false
                )

                $('#infoPanel').hide().show("slide", { direction: "right" }, 500);
            });

            // Close button
            $('#closePanel').on('click', function () {
                $('#infoPanel').fadeOut(200);
            });

            // Hide when clicking outside the panel
            // $(document).on('mousedown', function (e) {
            //     const panel = $('#infoPanel');
            //     if (panel.is(':visible') && !panel.is(e.target) && panel.has(e.target).length === 0) {
            //         panel.fadeOut(200);
            //     }
            // });

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
            hideModal('create_website_modal')
            showToastLoading("Đang khởi tạo website...")
            processStoreWebsite();
        }

        function processStoreWebsite() {

            callAjax(
                "POST",
                "{{route('ajax.administrator.'.$prefixView.'.store')}}",
                {
                    'user_id': $('select[name="user_id"]').val(),
                    'url': $('input[name="url"]').val(),
                    'category_website_id': $('select[name="category_website_id"]').val(),
                    'status_website_id': $('select[name="status_website_id"]').val(),
                },
                (response) => {
                    if (response.code == 219) {
                        setTimeout(processStoreWebsite(), 5000);
                    } else {
                        hideAllToast()
                        if (response.is_success) {
                            showToastSuccess('Đã tạo website');
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

        }

        function onDeleteZone(zone_website_id) {
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
                            showToastSuccess("Đã xóa Zone")
                            $('#container_zone_website_' + zone_website_id).fadeOut(200);
                        },
                        (error) => {

                        }, false
                    )
                }
            })
        }

    </script>
@endsection


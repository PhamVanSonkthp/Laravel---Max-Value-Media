@extends('user.layouts.master')

@section('title')

    <meta name="keyword" content="{{env('APP_NAME')}}">
    <meta name="promotion" content="{{env('APP_NAME')}}">
    <meta name="Description" content="{{env('APP_NAME')}}">

    <meta property="og:url" content="{{env('APP_URL')}}"/>
    <meta property="og:type" content="website"/>
    <meta property="og:title" content="{{env('APP_NAME')}}"/>
    <meta property="og:description" content="{{env('APP_NAME')}}"/>
    <meta property="og:image" content="{{env('APP_URL') . \App\Models\Helper::logoImagePath() }}"/>

@endsection

@section('name')

@endsection

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
            top: -2px;
            left: 3px;
        }

        .label-text {
            font-size: 14px;
            color: #374151;
            font-weight: 500;
        }

        .group.blue {
            border-color: #3b82f6;
            --accent: #3b82f6;
        }

        .card:hover {
            border-color: #cbd5e1; /* darker border on hover */
        }

        .name {
            font-size: 15px;
            font-weight: 600;
            margin-top: 2px;
        }


        .btn svg {
            width: 18px;
            height: 18px;
        }

        .btn-code {
            background: #3b82f6;
            color: white;
        }

        .btn-config {
            background: #10b981;
            color: white;
        }

        .btn-delete {
            background: #ef4444;
            color: white;
        }

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
                        <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                data-bs-target="#modal_craete_website">
                            Create new website <i class="fa-solid fa-plus"></i>
                        </button>
                    </div>

                    <div class="card-body">

                        <div class="table-responsive bg-white pb-5 p-3">
                            <div class="accordion-item">
                            </div>
                            <div class="accordion-item">
                            </div>
                            <table class="table table-hover m-0">
                                <thead>
                                <tr>
                                    <th class="border-0 fw-bold text-start">
                                        <span>Website</span>
                                    </th>
                                    <th class="border-0 fw-bold text-center">
                                        <span>Status</span>
                                    </th>
                                    <th class="border-0 fw-bold text-center">
                                        <span>Ads.txt</span>
                                    </th>
                                    <th class="border-0 fw-bold text-center">
                                        <span>Zone(s)</span>
                                    </th>
                                    <th class="border-0 fw-bold text-center">
                                        <span>Actions</span>
                                    </th>

                                </tr>
                                </thead>
                                <tbody class="accordion table-list-website" id="container_row_website">
                                @foreach($items as $item)
                                    @include('user.website.row', ['item' => $item])
                                @endforeach
                                </tbody>
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

    <!-- Modal -->
    <div class="modal fade" id="modal_craete_website" tabindex="-1" aria-labelledby="modal_craete_websiteLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal_craete_websiteLabel">Create new Website</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @include('user.website.modal_create')
                </div>
            </div>
        </div>
    </div>

    <!-- Modal get ad zone website -->
    <div class="modal fade" id="ad_zone_website_modal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Verify site ownership
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="container_ad_zone_website_modal">

                </div>
            </div>
        </div>
    </div>

    <!-- Modal get ad zone website -->
    <div class="modal fade" id="create_zone_website_modal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Create zone
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="container_create_zone_website_modal">

                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')
    <script>
        function onStoreWebsite() {
            _LoaderOrverlay.show("Creating your website...");
            processStoreWebsite();
        }

        function processStoreWebsite() {
            callAjax(
                "POST",
                "{{route('ajax.user.website.store')}}",
                {
                    'url': $('#require_input_ajax_checking_input').val(),
                },
                (response) => {
                    if (response.code == 219) {
                        setTimeout(processStoreWebsite(), 5000);
                    } else {
                        if (response.is_success) {
                            hideModal('modal_craete_website');
                            _LoaderOrverlay.hide();
                            showToastSuccess('created');
                            addRowAffterStoreWebsite(response.website_id);
                            onShowModalAdCode(response.zone_ids[0]);
                        } else {
                            showToastError('Error');
                        }
                    }

                },
                (error) => {
                    _LoaderOrverlay.hide();
                }, false
            )
        }

        function showModalAddZone(e, website_id) {
            e.stopPropagation();

            _LoaderOrverlay.show();
            callAjax(
                "GET",
                "{{route('ajax.user.zone_website.modal_create')}}",
                {
                    'website_id': website_id
                },
                (response) => {
                    _LoaderOrverlay.hide();
                    $('#container_create_zone_website_modal').html(response.data.html);
                    showModal('create_zone_website_modal');
                },
                (error) => {
                    _LoaderOrverlay.hide();
                }, false
            )
        }

        function onStoreZones(website_id) {
            _LoaderOrverlay.show("Creating zone");
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
                "{{route('ajax.user.zone_website.store')}}",
                {
                    id: website_id,
                    dimension_ids: dimension_ids,
                    numbers: numbers,
                },
                (response) => {
                    if (response.code == 219) {
                        setTimeout(processStoreZone(website_id), 5000);
                    } else {
                        _LoaderOrverlay.hide();
                        hideAllToast();
                        if (response.is_success || response.code == 200) {
                            showToastSuccess('Created!');
                            hideModal('create_zone_website_modal');
                            $('#row_website_id_' + website_id).remove();
                            $('#row_zone_website_id_' + website_id).remove();
                            addRowAffterStoreWebsite(website_id, true);
                        } else {
                            showToastError('Error');
                        }
                    }

                },
                (error) => {

                }, false
            )
        }

        function addRowAffterStoreWebsite(website_id, is_show_zone = false) {
            callAjax(
                "GET",
                "{{route('ajax.user.website.row')}}",
                {
                    'website_id': website_id
                },
                (response) => {
                    const row_html = response.data.html;
                    prependWithAnimation("#container_row_website", row_html);
                    if(is_show_zone) {
                        $('#collapse' + website_id).removeClass('collapse').addClass('show');
                    }
                },
                (error) => {

                }, false
            )
        }

        function onShowModalAdCode(zone_id) {

            _LoaderOrverlay.show();

            callAjax(
                "GET",
                "{{route('ajax.user.zone_website.ad_code')}}",
                {
                    'zone_website_id': zone_id
                },
                (response) => {
                    _LoaderOrverlay.hide();
                    $('#container_ad_zone_website_modal').html(response.data.html);
                    showModal('ad_zone_website_modal');
                },
                (error) => {
                    _LoaderOrverlay.hide();
                }, false
            )

        }

        function onVerifyZone(zone_id) {
            _LoaderOrverlay.show();
            processVerifyZone(zone_id);
        }

        function processVerifyZone(zone_id) {
            callAjax(
                "GET",
                "{{route('ajax.user.zone_website.verify')}}",
                {
                    id: zone_id
                },
                (response) => {
                    if (response.code == 219) {
                        setTimeout(processVerifyZone(zone_id), 5000);
                    } else {
                        if (response.is_success) {
                            _LoaderOrverlay.hide();
                            if (response.is_verified) {
                                $('#modal_ad_zone_website_label_verified').show();
                                $('#modal_ad_zone_website_label_not_verified').hide();

                                const website_id = response.website_id;
                                callAjax(
                                    "GET",
                                    "{{route('ajax.user.website.row')}}",
                                    {
                                        'website_id': website_id
                                    },
                                    (response) => {
                                        console.log(response);

                                        $('#row_zone_website_id_' + website_id).remove();
                                        $('#row_website_id_' + website_id).after(response.data.html).remove();
                                    },
                                    (error) => {

                                    }, false
                                )

                            } else {
                                $('#modal_ad_zone_website_label_not_verified').show();
                                $('#modal_ad_zone_website_label_verified').hide();
                            }
                        } else {
                            showToastError('Error');
                        }
                    }
                },
                (error) => {
                    _LoaderOrverlay.hide();
                }, false
            )
        }


        function panelZoneToggleGroup(btn) {
            const group = btn.closest('.group');
            const checkboxes = group.querySelectorAll('input[type="checkbox"]');
            const allChecked = Array.from(checkboxes).every(cb => cb.checked);
            checkboxes.forEach(cb => cb.checked = !allChecked);
            btn.textContent = allChecked ? "Select All" : "Deselect All";
            onStatusButtonCreateZone();
        }

        $(document).on('change', 'input[name="panel_zone_checkbox_dimension"]', function () {
            onStatusButtonCreateZone();
        });

        function onStatusButtonCreateZone() {
            const checkboxesChecked = document.querySelectorAll('input[name="panel_zone_checkbox_dimension"]:checked');
            $('#modal_create_zone_btn_create').prop('disabled', checkboxesChecked.length == 0);
        }
    </script>
@endsection

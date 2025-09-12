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


        .input-wrapper-search {
            position: relative;
            max-width: 250px;
            width: 100%;
        }

        .filter-input {
            border-radius: 50px !important;
            padding-left: 40px !important;
            padding-right: 35px !important;
            box-shadow: 0 2px 4px rgba(0,0,0,.05);
            border: 1px solid #ddd;
            transition: all .2s ease;
        }
        .filter-input:focus {
            border-color: #4b8bff;
            box-shadow: 0 0 0 .2rem rgba(75,139,255,.2);
        }

        .filter-icon, .clear-icon {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            color: #888;
            cursor: pointer;
        }
        .filter-icon { left: 15px; }
        .clear-icon { right: 12px; display: none; }
    </style>
@endsection

@section('content')

    <!-- Main Content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">

                    <div class="card">

                        <div class="card-body">
                            <div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <!-- Right: Input -->
                                            <div class="input-wrapper-search">
                                                <i class="fa fa-search filter-icon" id="searchIcon"></i>
                                                <input type="text" id="filterInput" class="form-control filter-input" placeholder="Filter websites...">
                                                <i style="z-index: 10000;" class="fa fa-times clear-icon" id="clearIcon"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="text-right">
                                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-toggle="modal"
                                                    data-target="#modal_create_website"
                                                    data-bs-target="#modal_create_website">
                                                Create new <i class="fa-solid fa-plus"></i>
                                            </button>
                                        </div>

                                    </div>
                                </div>
                            </div>
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
    </section>

    <!-- Modal -->
    <div class="modal fade" id="modal_create_website" tabindex="-1" aria-labelledby="modal_create_websiteLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal_create_websiteLabel">Create new Website</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i class="fa-solid fa-x"></i>
                    </button>
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
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i class="fa-solid fa-x"></i>
                    </button>
                </div>
                <div class="modal-body" id="container_ad_zone_website_modal">

                </div>
            </div>
        </div>
    </div>

    <!-- Modal get ads website -->
    <div class="modal fade" id="ads_website_modal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Ads
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i class="fa-solid fa-x"></i>
                    </button>
                </div>
                <div class="modal-body" id="container_ads_website_modal">

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
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i class="fa-solid fa-x"></i>
                    </button>
                </div>
                <div class="modal-body" id="container_create_zone_website_modal">

                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')

    <script>
        const filterInput = document.getElementById("filterInput");
        const clearIcon = document.getElementById("clearIcon");

        filterInput.addEventListener("input", function() {
            clearIcon.style.display = this.value.length > 0 ? "block" : "none";
            filterList(this.value);
        });

        clearIcon.addEventListener("click", function() {
            filterInput.value = "";
            clearIcon.style.display = "none";
            filterList("");
        });

        let typingTimerFilter;
        const delayTimerFilter = 200;

        function filterList(value) {

            $('#container_row_website').html(`<tr id="row_website_id_6793" onclick=" " class="accordion-header website-reject collapsed" data-toggle="collapse" data-target="#collapse6793" aria-expanded="false" aria-controls="collapse6793" style="cursor: pointer;">

    <td colspan="5">
       <div class="d-flex justify-content-center align-items-center" style="height: 200px;">
  <div class="spinner-border text-primary" role="status">
    <span class="sr-only">Loading...</span>
  </div>
</div>
    </td>
</tr>`)
            clearTimeout(typingTimerFilter);

            typingTimerFilter = setTimeout(() => {
                callAjax(
                    "GET",
                    "{{route('ajax.user.website.search')}}",
                    {
                        search_query: value,
                    },
                    (response) => {
                        if (response.data.search_query == value || (response.data.search_query == null && value == '')) {
                            $('#container_row_website').html(response.data.html).fadeIn(500);
                        }
                    },
                    (error) => {

                    }, false, false
                )
            }, delayTimerFilter);
        }
    </script>

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
                            hideModal('modal_create_website');
                            _LoaderOrverlay.hide();
                            showToastSuccess('created');
                            addRowAffterStoreWebsite(response.website_id);
                            onShowModalAdCode(response.zone_ids[0]);
                            $('#require_input_ajax_checking_input').val("").trigger('input');
                            $("#button_create_website").prop("disabled", true);
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
                    if (is_show_zone) {
                        $('#collapse' + website_id).removeClass('collapse').addClass('show');
                    }
                },
                (error) => {

                }, false
            )
        }

        function onShowModalAdCode(zone_id) {

            if (!zone_id) return;
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

        function showModalAds(e, website_id) {
            e.stopPropagation();

            _LoaderOrverlay.show();
            callAjax(
                "GET",
                "{{route('ajax.user.website.ads')}}",
                {
                    website_id: website_id
                },
                (response) => {
                    _LoaderOrverlay.hide();
                    $('#container_ads_website_modal').html(response.data.html);
                    showModal('ads_website_modal');
                },
                (error) => {
                    _LoaderOrverlay.hide();
                }
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

                                onRefreshRow(response.website_id);

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

        function onRefreshRow(website_id) {
            callAjax(
                "GET",
                "{{route('ajax.user.website.row')}}",
                {
                    'website_id': website_id
                },
                (response) => {
                    $('#row_zone_website_id_' + website_id).remove();
                    $('#row_website_id_' + website_id).after(response.data.html).remove();
                },
                (error) => {

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

        function downloadAds(textarea_code_ads) {
            const content = $('#' + textarea_code_ads).val();

            // Tạo file dạng text
            const blob = new Blob([content], { type: "text/plain" });

            // Tạo link download ảo
            const link = document.createElement("a");
            link.href = URL.createObjectURL(blob);
            link.download = "ads.txt"; // tên file tải về
            link.click();

            // Giải phóng bộ nhớ
            URL.revokeObjectURL(link.href);
        }

        function onCheckAds(website_id) {
            _LoaderOrverlay.show();
            processCheckAds(website_id);
        }

        function processCheckAds(website_id) {
            callAjax(
                "GET",
                "{{route('ajax.user.website.check_ads')}}",
                {
                    id: website_id
                },
                (response) => {
                    if (response.code == 219) {
                        setTimeout(processCheckAds(website_id), 5000);
                    } else {
                        if (response.is_success) {
                            _LoaderOrverlay.hide();
                            onRefreshRow(response.website_id);

                            if (response.website.ads_status_website_id == 1) {
                                $('#modal_ads_website_alert_empty').show();
                            }else if (response.website.ads_status_website_id == 2) {
                                $('#modal_ads_website_alert_accept').show();
                            } else {
                                $('#modal_ads_website_alert_not_update').show();
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

    </script>
@endsection

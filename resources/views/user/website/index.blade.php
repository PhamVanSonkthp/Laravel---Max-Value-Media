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
    <div class="modal fade" id="modal_craete_website" tabindex="-1" aria-labelledby="modal_craete_websiteLabel" aria-hidden="true">
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

        function showModalAddZone(website_id) {

        }

        function processStoreZone(website_id) {

        }

        function addRowAffterStoreWebsite(website_id) {
            callAjax(
                "GET",
                "{{route('ajax.user.website.row')}}",
                {
                    'website_id': website_id
                },
                (response) => {
                    const row_html = response.data.html;
                    prependWithAnimation("#container_row_website", row_html)
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
                            if(response.is_verified){
                                $('#modal_ad_zone_website_label_verified').show();
                                $('#modal_ad_zone_website_label_not_verified').hide();

                                callAjax(
                                    "GET",
                                    "{{route('ajax.user.website.row')}}",
                                    {
                                        'website_id': response.website_id
                                    },
                                    (response) => {
                                        $('#row_website_id_' + response.website_id).html(response.data.html)
                                    },
                                    (error) => {

                                    }, false
                                )

                            }else{
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

    </script>
@endsection

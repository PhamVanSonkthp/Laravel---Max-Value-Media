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
                                data-bs-target="#mediumModal">
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
                                    <th class="border-0 fw-bold">
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
                                <tbody class="accordion table-list-website">
                                @foreach($items as $index => $item)
                                    @include('user.website.row', ['item' => $item,  'index' => $index])
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
    <div class="modal fade" id="mediumModal" tabindex="-1" aria-labelledby="mediumModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="mediumModalLabel">Medium Modal</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @include('user.website.modal_create')
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')
    <script>
        function onStoreWebsite() {





            _LoaderOrverlay.show("Checking url...")
        }
    </script>
@endsection

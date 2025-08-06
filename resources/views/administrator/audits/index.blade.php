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
                        <div class="table-responsive product-table">
                            <table class="table table-hover table-bordered">
                                <thead>
                                <tr>
                                    <th>IP Address</th>
                                    <th>Người tác động</th>
                                    <th>Event</th>
                                    <th>Dữ liệu cũ</th>
                                    <th>Dữ liệu mới</th>
                                    <th>Ngày tạo</th>
                                    <th>Agent</th>
                                    <th>Url</th>
                                    <th>Model</th>
                                    <th>Type</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($items as $item)
                                    @include('administrator.'.$prefixView.'.row', ['item' => $item, 'prefixView' => $prefixView])
                                @endforeach

                                </tbody>

                                <tfoot>
                                <tr>
                                    <th>IP Address</th>
                                    <th>Người tác động</th>
                                    <th>Event</th>
                                    <th>Dữ liệu cũ</th>
                                    <th>Dữ liệu mới</th>
                                    <th>Ngày tạo</th>
                                    <th>Agent</th>
                                    <th>Url</th>
                                    <th>Model</th>
                                    <th>Type</th>
                                </tr>
                                </tfoot>
                            </table>

                            <div style="padding: 20px;">
                                {{ $items->links('pagination::bootstrap-4') }}
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('js')

@endsection

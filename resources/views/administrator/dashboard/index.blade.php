@extends('administrator.layouts.master')

@section('title')
    <title>Home page</title>
@endsection

@section('name')
    <h4 class="page-title">Tổng quan</h4>
@endsection

@section('css')

@endsection

@section('content')

    @can('dashboard-list')
        <div>

            <div>
                <div class="card">
                    <div class="card-body">
                        <div>
                            <strong>
                                Danh sách hồ sơ
                            </strong>
                        </div>

                        <div class="row mt-3">
                            <div class="d-flex">

                                @foreach(\App\Models\OrderStatus::all() as $order)

                                    <div class="flex-grow-1">
                                        <a href="{{route('administrator.orders.index', ['order_status_id' => $order->id])}}">
                                            <div class="text-center" style="font-size: 20px;">
                                                <strong>
                                                    {{\App\Models\Formatter::formatNumber(\App\Models\Order::where('order_status_id', $order->id)->count())}}
                                                </strong>
                                            </div>

                                            <div class="text-center text-dark">
                                                {{$order->name}}
                                            </div>
                                        </a>

                                    </div>

                                @endforeach

                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div>
                <div class="card">
                    <div class="card-body">
                        <div>
                            <strong>
                                Phân tích bán hàng
                            </strong>
                        </div>

                        <div class="row mt-3">
                            <div class="d-flex">

                                <div class="flex-grow-1">
                                    <div>
                                        Doanh số
                                    </div>

                                    <div>
                                        <strong style="font-size: 20px;">
                                            {{\App\Models\Formatter::formatNumber($revenue)}}đ
                                        </strong>
                                    </div>
                                </div>

                                <div class="flex-grow-1">

                                    <div class="d-flex">
                                        <div class="flex-grow-1">
                                            <div>
                                                Lượt truy cập
                                            </div>

                                            <div>
                                                <strong style="font-size: 20px;">
                                                    0
                                                </strong>
                                            </div>
                                        </div>

                                        <div class="flex-grow-1">
                                            <div>
                                                Lượt xem
                                            </div>
                                            <div>
                                                <strong style="font-size: 20px;">
                                                    0
                                                </strong>
                                            </div>
                                        </div>
                                    </div>

                                </div>


                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div>
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-baseline mb-2">
                            <h6 class="card-title mb-0">Thông báo của InFi</h6>


                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead>
                                <tr>
                                    <th class="pt-0">#</th>
                                    <th class="pt-0">Nội dung</th>
                                    <th class="pt-0">Ngày</th>
                                    <th class="pt-0">Tạo bởi</th>
                                </tr>
                                </thead>
                                <tbody>

                                <tr>
                                    <td class="border-bottom">1</td>
                                    <td class="border-bottom">Cảm ơn bạn đã sử dụng dịch vụ của InFi</td>
                                    <td class="border-bottom">01/05/2022</td>
                                    <td class="border-bottom">Jensen Combs</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        Bạn không có quyền truy cập Dashboard
    @endcan

@endsection

@section('js')

@endsection

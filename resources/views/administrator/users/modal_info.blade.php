<div class="row">

    <div class="col-md-4">
        <div>
            <h3>
                Danh sách chuyến bay
            </h3>

        </div>
        <div class="table-responsive product-table ">
            <table class="table table-hover table-bordered">
                <thead>
                <tr>

                    <th>Mã đặt chỗ</th>
                    <th>Tình trạng</th>
                    <th>Tổng giá</th>
                </tr>
                </thead>
                <tbody>

                    @foreach($user_flight as $item)
                        <tr>

                            <td>{{$item->booking_code}}</td>
                            <td>{{optional($item->status)->name}}</td>

                            <td>@if(!empty($item->returnFlight))
                                    {{\App\Models\Formatter::formatMoney($item->amount + $item->returnFlight->amount)}}
                                    đ
                                @else
                                    {{\App\Models\Formatter::formatMoney($item->amount)}} đ
                                @endif</td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>

    <div class="col-md-4">
        <div>
            <h3>
                Danh sách khách sạn
            </h3>

        </div>
        <div class="table-responsive product-table">
            <table class="table table-hover table-bordered">
                <thead>
                <tr>
                    <th>Tên khách sạn</th>
                    <th>Tình trạng</th>
                    <th>Tổng tiền</th>


                </tr>
                </thead>
                <tbody id="container_hotels">
                @foreach($user_hotel as $item)
                    <tr id="container_td_{{$item->id}}">
                        <td>
                            {{ optional($item->hotel)->name}}
                        </td>

                        <td>
                            {{ optional($item->userHotelStatus)->name}}
                        </td>
                        <td>
                            {{\App\Models\Formatter::formatMoney($item->cost)}}
                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>

    </div>

    <div class="col-md-4">
        <div>
            <h3>
               Combo vé
            </h3>

        </div>
        <div class="table-responsive product-table">
            <table class="table table-hover table-bordered">
                <thead>
                <tr>
                    <th>PNR</th>
                    <th>Tên khách sạn</th>
                    <th>Tình trạng</th>
                    <th>Tổng tiền</th>
                </tr>
                </thead>
                <tbody id="container_hotels">
                @foreach($userCombos as $item)
                    <tr>
                        <td>
                            {{ optional($item->userFlight)->booking_code}}
                        </td>
                        <td>
                            {{ optional($item->hotel)->name}}
                        </td>
                        <td>
                            {{ optional($item->status)->name}}
                        </td>
                        <td>
                            {{\App\Models\Formatter::formatMoney($item->totalCash())}}
                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>
    </div>

</div>

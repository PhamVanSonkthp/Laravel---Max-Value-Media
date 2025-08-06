<div class="row">
    <div class="col-12">
        <div>
            <h3>
                Ghi chú
                <button onclick="onInsertNote()" class="btn-success rounded-circle"
                        style="border: 0;width: 25px;height: 25px;">+
                </button>
            </h3>

            <div>
                <ul>
                    @foreach($item->notes as $itemNote)
                        <li>
                            {{$itemNote->description}}
                        </li>
                    @endforeach
                </ul>
            </div>

            <div>
                <ul>
                    @foreach($item->notes as $itemNote)
                        <li>
                            {{$itemNote->description}}
                        </li>
                    @endforeach

                </ul>
            </div>

            <div>
                <div class="row">
                    <div class="col-4">
                        <div class="row" style="align-items: center;">
                            <div class="col-4">
                                <div class="text-center p-3">
                                    <img width="100%" src="{{$item->imageAirline()}}">
                                </div>
                            </div>

                            <div class="col-8">
                                <div class="text-center">
                                    {{$item->nameAirline()}}
                                </div>
                                <div class="text-center">
                                    {{$item->flight_number}}
                                </div>

                                <div class="text-center">
                                    {{$item->classFlight()}}
                                </div>
                            </div>
                        </div>


                    </div>

                    <div class="col-8">
                        <div style="min-width: 250px; padding-left: 20px;"><p
                                class="MuiTypography-root MuiTypography-body2">{{\App\Models\Formatter::getDayOfWeek($item->flightDateStart())}}
                                , &nbsp;{{\App\Models\Formatter::getOnlyDate($item->flightDateStart())}}</p>
                            <div style="display: flex; justify-content: space-between;">
                                <div style="display: flex; flex-direction: column;"><h6
                                        class="MuiTypography-root MuiTypography-subtitle1"
                                        style="font-weight: bold;font-size: 18px;">{{$item->start_point}}</h6>
                                    <p class="MuiTypography-root MuiTypography-body2">{{\App\Models\Formatter::getOnlyTime($item->flightDateStart())}}</p>
                                </div>
                                <div
                                    style="display: flex; flex-direction: column; flex: 1 1 0%; align-items: center;">
                                    <div
                                        style="display: flex; align-items: center; width: 100%; height: 35px;">
                                        <div style="flex: 1 1 0%;">
                                            <div
                                                style="border-bottom: 2px solid rgb(189, 189, 189); margin: 0px 8px;"></div>
                                        </div>
                                        <img
                                            src="https://tripipartner.vn/static/media/ic_flight_itinerary_airplane.03a3f828.svg"
                                            alt="">
                                        <div style="flex: 1 1 0%;">
                                            <div
                                                style="border-bottom: 2px solid rgb(189, 189, 189); margin: 0px 8px;"></div>
                                        </div>
                                    </div>
                                    <p class="MuiTypography-root MuiTypography-body2 MuiTypography-colorTextSecondary">{{$item->textDuration()}}</p>
                                </div>
                                <div style="display: flex; flex-direction: column;"><h6
                                        class="MuiTypography-root MuiTypography-subtitle1"
                                        style="font-weight: bold;font-size: 18px;">{{$item->end_point}}</h6>
                                    <p class="MuiTypography-root MuiTypography-body2">{{\App\Models\Formatter::getOnlyTime($item->flightDateEnd())}}
                                        <span
                                            style="opacity: 0;"><span>&nbsp;(+0d)</span></span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <ul>

                    @foreach($item->rulesTicket() as $itemrulesTicket)
                        <li>
                            {{$itemrulesTicket}}
                        </li>
                    @endforeach
                </ul>
            </div>

            @if(!empty($item->return_flight))
                <div class="row">
                    <div class="col-4">
                        <div class="row" style="align-items: center;">
                            <div class="col-4">
                                <div class="text-center p-3">
                                    <img width="100%" src="{{$item->return_flight->imageAirline()}}">
                                </div>
                            </div>

                            <div class="col-8">
                                <div class="text-center">
                                    {{$item->return_flight->nameAirline()}}
                                </div>
                                <div class="text-center">
                                    {{$item->return_flight->flight_number}}
                                </div>

                                <div class="text-center">
                                    {{$item->return_flight->classFlight()}}
                                </div>
                            </div>
                        </div>


                    </div>

                    <div class="col-8">
                        <div style="min-width: 250px; padding-left: 20px;"><p
                                class="MuiTypography-root MuiTypography-body2">{{\App\Models\Formatter::getDayOfWeek($item->return_flight->flightDateStart())}}
                                , &nbsp;{{\App\Models\Formatter::getOnlyDate($item->return_flight->flightDateStart())}}</p>
                            <div style="display: flex; justify-content: space-between;">
                                <div style="display: flex; flex-direction: column;"><h6
                                        class="MuiTypography-root MuiTypography-subtitle1"
                                        style="font-weight: bold;font-size: 18px;">{{$item->return_flight->start_point}}</h6>
                                    <p class="MuiTypography-root MuiTypography-body2">{{\App\Models\Formatter::getOnlyTime($item->return_flight->flightDateStart())}}</p>
                                </div>
                                <div
                                    style="display: flex; flex-direction: column; flex: 1 1 0%; align-items: center;">
                                    <div
                                        style="display: flex; align-items: center; width: 100%; height: 35px;">
                                        <div style="flex: 1 1 0%;">
                                            <div
                                                style="border-bottom: 2px solid rgb(189, 189, 189); margin: 0px 8px;"></div>
                                        </div>
                                        <img
                                            src="https://tripipartner.vn/static/media/ic_flight_itinerary_airplane.03a3f828.svg"
                                            alt="">
                                        <div style="flex: 1 1 0%;">
                                            <div
                                                style="border-bottom: 2px solid rgb(189, 189, 189); margin: 0px 8px;"></div>
                                        </div>
                                    </div>
                                    <p class="MuiTypography-root MuiTypography-body2 MuiTypography-colorTextSecondary">{{$item->return_flight->textDuration()}}</p>
                                </div>
                                <div style="display: flex; flex-direction: column;"><h6
                                        class="MuiTypography-root MuiTypography-subtitle1"
                                        style="font-weight: bold;font-size: 18px;">{{$item->return_flight->end_point}}</h6>
                                    <p class="MuiTypography-root MuiTypography-body2">{{\App\Models\Formatter::getOnlyTime($item->return_flight->flightDateEnd())}}
                                        <span
                                            style="opacity: 0;"><span>&nbsp;(+0d)</span></span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <ul>

                    @foreach($item->return_flight->rulesTicket() as $itemrulesTicket)
                        <li>
                            {{$itemrulesTicket}}
                        </li>
                    @endforeach
                </ul>
            @endif

            <div class="mt-5 border p-3">

                <div class="row">

                    <div class="col-6">
                        <h4>
                            Thông tin vé
                        </h4>
                        <div class="mt-3">
                            <span>Trạng thái:</span> <span
                                style="color: {{\App\Models\UserFlightStatus::textColorStatus(optional($item->status)->name)}};">{{optional($item->status)->name}}</span>
                        </div>

                        <div class="mt-3">
                            <span>Mã đơn:</span> <span>{{$item->id}}</span>
                        </div>

                        @if(!empty($item->return_flight))
                            <div class="mt-3">
                                <span>Mã đặt chỗ chiều đi:</span> <span
                                    class="text-primary">{{$item->booking_code}}</span>
                            </div>
                            <div class="mt-3">
                                <span>Mã đặt chỗ chiều về:</span> <span
                                    class="text-primary">{{$item->return_flight->booking_code}}</span>
                            </div>
                        @else
                            <div class="mt-3">
                                <span>Mã đặt chỗ:</span> <span
                                    class="text-primary">{{$item->booking_code}}</span>
                            </div>
                        @endif


                        <div class="mt-3">
                            <span>Ngày đặt:</span> {{\App\Models\Formatter::getDateTime($item->created_at)}}
                        </div>

                    </div>
                    <div class="col-6">
                        <h4>
                            Chi tiết thanh toán
                        </h4>

                        <div class="row mt-3">
                            <div class="col-6">
                                Tổng tiền thanh toán
                            </div>

                            <div class="col-6">
                                <div class="text-end" style="color: #ff6a39;font-size: 20px;font-weight: bold;">
                                    @if(!empty($item->return_flight))
                                        {{\App\Models\Formatter::formatMoney($item->amount + $item->return_flight->amount)}} đ
                                    @else
                                        {{\App\Models\Formatter::formatMoney($item->amount)}} đ
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-6">
                                Tiền vé máy bay
                            </div>

                            <div class="col-6">
                                <div class="text-end" style="font-weight: bold;">
                                    @if(!empty($item->return_flight))
                                        {{\App\Models\Formatter::formatMoney($item->ticket_price + $item->return_flight->ticket_price)}} đ
                                    @else
                                        {{\App\Models\Formatter::formatMoney($item->ticket_price)}} đ
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-6">
                                Tiền hành lý
                            </div>

                            <div class="col-6">
                                <div class="text-end" style="font-weight: bold;">
                                    {{\App\Models\Formatter::formatMoney($item->baggage_price)}} đ
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-6">
                        <h4 class="mt-2 mb-2">
                            Thông tin liên hệ
                        </h4>
                        <div class="mt-3">
                            <span>Họ tên:</span>
                            <span>{{ optional($item->contact)->first_name . " " . optional($item->contact)->last_name}} {!! optional($item->contact)->gender == 1 ? '<i class="fa-solid fa-mars" style="color: cornflowerblue;"></i>' : '<i class="fa-solid fa-venus" style="color: deeppink;"></i>' !!}</span>
                        </div>

                        <div class="mt-3">
                            <span>Số điện thoại:</span> <span>{{optional($item->contact)->phone}}</span>
                        </div>

                        <div class="mt-3">
                            <span>Địa chỉ:</span> <span>{{optional($item->contact)->address}}</span>
                        </div>

                    </div>

                    <div class="col-6">
                        <h4>
                            Danh sách hành khấch
                        </h4>

                        <div class="table-responsive scroller">
                            <table class="table table-border-vertical">
                                <thead>
                                <tr>
                                    <th scope="col">Tên</th>
                                    <th scope="col">Loại</th>
                                    <th scope="col">Ngày sinh</th>
                                    <th scope="col">Hành lý</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($item->passengers as $itemPassenger)
                                    <tr>
                                        <td>
                                            <span class="bold">{{$itemPassenger->first_name}} {{$itemPassenger->last_name}} {!! $itemPassenger->gender == 1 ? '<i class="fa-solid fa-mars" style="color: cornflowerblue;"></i>' : '<i class="fa-solid fa-venus" style="color: deeppink;"></i>' !!}</span>
                                        </td>
                                        <td>
                                            <span style="color: #747474;">{{$itemPassenger->typeText()}}</span>
                                        </td>
                                        <td>
                                            <span style="color: #747474;">{{$itemPassenger->birthday}}</span>
                                        </td>
                                        <td>
                                            @if(!empty($itemPassenger->baggage))
                                                {{$itemPassenger->baggage->name}} ({{$itemPassenger->baggage->code}}) {{$itemPassenger->baggage->value}} - {{$itemPassenger->baggage->price}}{{$itemPassenger->baggage->currency}}
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                        @if(!empty($item->return_flight))
                            <h4 class="mt-3">
                                Danh sách hành khấch (Chiều về)
                            </h4>

                            <div class="table-responsive scroller">
                                <table class="table table-border-vertical">
                                    <thead>
                                    <tr>
                                        <th scope="col">Tên</th>
                                        <th scope="col">Loại</th>
                                        <th scope="col">Ngày sinh</th>
                                        <th scope="col">Hành lý</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($item->return_flight->passengers as $itemPassenger)
                                        <tr>
                                            <td>
                                                <span class="bold">{{$itemPassenger->first_name}} {{$itemPassenger->last_name}} {!! $itemPassenger->gender == 1 ? '<i class="fa-solid fa-mars" style="color: cornflowerblue;"></i>' : '<i class="fa-solid fa-venus" style="color: deeppink;"></i>' !!}</span>
                                            </td>
                                            <td>
                                                <span style="color: #747474;">{{$itemPassenger->typeText()}}</span>
                                            </td>
                                            <td>
                                                <span style="color: #747474;">{{$itemPassenger->birthday}}</span>
                                            </td>
                                            <td>
                                                @if(!empty($itemPassenger->baggage))
                                                    {{$itemPassenger->baggage->name}} ({{$itemPassenger->baggage->code}}) {{$itemPassenger->baggage->value}} - {{$itemPassenger->baggage->price}}{{$itemPassenger->baggage->currency}}
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif


                        <div>
                            @if($item->numberADT() > 1)
                                <button onclick="onDivCode()"
                                        data-bs-toggle="modal" data-bs-target="#codeModal"
                                    class="mt-3 MuiButtonBase-root MuiButton-root MuiButton-contained MuiButton-disableElevation"
                                    tabindex="0" type="button"
                                    style="min-width: 155px; background-color: rgb(255, 255, 255); border: 1px solid rgb(178, 184, 185); padding: 4px 20px; border-radius: 99px;">
                                <span class="MuiButton-label"><div
                                        style="position: relative; display: flex; align-items: center; justify-content: center;"><div
                                            style="opacity: 1;"><div class="sc-iybRtq eqLMAi"><svg width="20"
                                                                                                   height="20"
                                                                                                   viewBox="0 0 20 20"
                                                                                                   fill="none"
                                                                                                   style="margin-right: 6px;"><rect
                                                        x="7.41602" y="1.5835" width="5.16667" height="5.16667"
                                                        rx="1.25" stroke="#FF6A39" stroke-width="1.5"></rect><rect
                                                        x="0.833984" y="13.3335" width="5.83333" height="5.83333" rx="2"
                                                        fill="#FF6A39"></rect><rect x="13.334" y="13.3335"
                                                                                    width="5.83333" height="5.83333"
                                                                                    rx="2" fill="#FF6A39"></rect><path
                                                        d="M10.0007 7.5L5.83398 11.6667" stroke="#FF6A39"
                                                        stroke-width="1.5" stroke-linecap="round"></path><path
                                                        d="M5.41602 10V12.0833H7.49935" stroke="#FF6A39"
                                                        stroke-width="1.5" stroke-linecap="round"
                                                        stroke-linejoin="round"></path><path
                                                        d="M9.99935 7.5L14.166 11.6667" stroke="#FF6A39"
                                                        stroke-width="1.5" stroke-linecap="round"></path><path
                                                        d="M14.584 10V12.0833H12.5007" stroke="#FF6A39"
                                                        stroke-width="1.5" stroke-linecap="round"
                                                        stroke-linejoin="round"></path></svg><p
                                                    class="mb-0 MuiTypography-root MuiTypography-body2">Tách hành khách</p></div></div></div></span><span
                                        class="MuiTouchRipple-root"></span></button>
                            @endif

                        </div>
                    </div>

                </div>


            </div>

            @if($item->user_flight_status_id == 1)
                <div class="mt-3">
                    <button type="button" class="btn btn-info" onclick="onExportTicket()">Xuất vé</button>
                    <div class="mt-1">
                        <i>(*) Khi xuất vé sẽ tự động chuyển trạng thái vé thành công và trừ tiền khách</i>
                    </div>

                </div>
            @endif

        </div>
    </div>

</div>

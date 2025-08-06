<html>
<head>
    <meta charset="utf-8"/>
    <title>Phiếu bán hàng</title>
    {{--    <link rel="shortcut icon" href="./../../images/logo.png" />--}}
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>

    {{--    <meta name="author" content="Infinity ltd" />--}}
    {{--    <meta name="keyword" content="Phiếu xét nghiệm covid PK An Bình" />--}}
    {{--    <meta name="promotion" content="Phiếu xét nghiệm covid PK An Bình | Phòng khám đa khoa An Bình" />--}}
    {{--    <meta name="Description" content="Phiếu xét nghiệm covid PK An Bình | Phòng khám đa khoa An Bình" />--}}

    {{--    <meta property="og:type" content="website" />--}}
    {{--    <meta property="og:title" content="Phiếu xét nghiệm covid PK An Bình" />--}}
    {{--    <meta property="og:description" content="Phiếu xét nghiệm covid PK An Bình | Phòng khám đa khoa An Bình" />--}}
    {{--    <meta property="og:image" content="https://tracuu.phongkhamdakhoaanbinh.vn/images/logo.png" />--}}

    <script type="text/javascript" src="{{asset('vendor/qrcode/qrcode.min.js')}}"></script>
    <script src="{{asset('assets/administrator/assets/libs/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('vendor/helper/helper.js')}}"></script>

    <!-- <style>
    @media print {
        @page {
            margin-left: 5mm;
            margin-right: 5mm;
            margin-top: 0;
            margin-bottom: 0;
        }
    }
</style> -->

    <style>
        table, tr, td, th {
            border-collapse: collapse;
            border: 1px solid;
        }

        td, th {
            padding: 5px;
        }
    </style>
</head>

<body style="font-size: 4.8mm; margin: 0">
<div style="width: 210mm; padding: 15mm; position: relative">
    <div>

        <div style="display: flex; gap: 10px">
            <div style="flex: 1">
                <img style="width: 80px;height: 80px;" id="imgIcon" src="{{\App\Models\Helper::logoImagePath()}}"/>
            </div>

            <div
                style="flex: 5; justify-content: center; flex: 5; display: flex; align-items: start; flex-direction: column">
                <div style="font-weight: bold; font-size: 5mm; line-height: 21px; text-align: center;">Công Ty
                    TNHH {{env('APP_NAME')}}
                </div>
                <div style="font-size: 4mm; text-align: center; margin-top: 1mm">Địa
                    chỉ: {{ optional(\App\Models\Setting::first())->address_contact}}
                </div>
                <div style="font-size: 4mm; text-align: center; margin-top: 1mm">Số điện thoại:
                    {{ optional(\App\Models\Setting::first())->phone_contact}}
                </div>
                <div style="font-size: 4mm; text-align: center; margin-top: 1mm">
                    Email: {{ optional(\App\Models\Setting::first())->email_contact}}
                </div>
            </div>

            <div style="flex: 1">
                <div id="id_qrcode" style="width: 80px;height: 80px;"></div>
            </div>
        </div>

    </div>

    <div>

        <div style="font-weight: bold; font-size: 7mm; line-height: 21px; text-align: center; margin-top: 9mm">Hóa đơn
            bán hàng
        </div>

        <div style="text-align: center;margin-top: 10px;">
            <span>
                Ngày {{\App\Models\Formatter::getOnlyDate($item->created_at,'d')}}
            </span>
            <span>

            </span>

            <span>
                tháng {{\App\Models\Formatter::getOnlyDate($item->created_at,'m')}}
            </span>
            <span>

            </span>

            <span>
                năm {{\App\Models\Formatter::getOnlyDate($item->created_at,'Y')}}
            </span>
            <span>

            </span>
        </div>

    </div>

    <div style="margin-top: 10px;">
        <div>
            Khách hàng: {{ $item->user_name}}
        </div>
        <div>
            Địa chỉ: {{ $item->user_address}}
        </div>
        <div>
            Điện thoại: {{ $item->user_phone}}
        </div>
    </div>

    <div style="margin-top: 10px;">
        <table style="width: 100%;">
            <thead>
            <tr>
                <th>STT</th>
                <th>Mã hàng</th>
                <th>Tên hàng hóa</th>
                <th>Số lượng</th>
                <th>Đơn giá</th>
                <th>Thành tiền</th>
            </tr>
            </thead>

            <tbody>
            @foreach($item->products as $index => $product)
                <tr>
                    <td style="text-align: center">{{$index + 1}}</td>
                    <td style="text-align: center">
                        {{$product->id}}
                    </td>
                    <td>{{\App\Models\Formatter::getShortDescriptionAttribute($product->name,30)}}</td>
                    <td style="text-align: center">{{ \App\Models\Formatter::formatNumber($product->quantity) }}</td>
                    <td style="text-align: center">{{ \App\Models\Formatter::formatMoney($product->price) }}</td>
                    <td style="text-align: center">{{ \App\Models\Formatter::formatMoney($product->price * $product->quantity) }}</td>
                </tr>
            @endforeach

            </tbody>

            <tfoot>

            @if($item->voucher)
                <tr>
                    <td colspan="2" style="text-align: center;">
                        <strong>
                            Mã giảm giá
                        </strong>
                    </td>
                    <td colspan="1" style="text-align: center;">

                        <div>
                            <strong>{{$item->voucher->name}}</strong>
                        </div>
                        <div>
                            <strong>{{$item->voucher->code}}</strong>
                        </div>

                    </td>
                    <td colspan="3" style="text-align: center;">
                        <strong>
                            {{number_format($item->amount_voucher)}}
                        </strong>
                    </td>
                </tr>
            @endif

            <tr>
                <td colspan="3" style="text-align: center;">
                    <strong>
                        Tổng
                    </strong>
                </td>
                <td colspan="3" style="text-align: center;">
                    <strong>
                        {{number_format($item->amount)}}
                    </strong>
                </td>
            </tr>
            </tfoot>
        </table>
    </div>

    <div style="margin-top: 20px;">
        <div style="display: flex">
            <div style="flex: 1;text-align: center;">
                <div>
                    Khách hàng
                </div>
                <div>
                    (Ký & ghi rõ họ tên)
                </div>
            </div>
            <div style="flex: 1;text-align: center;">
                <div>
                    Kế toán
                </div>
                <div>
                    (Ký & ghi rõ họ tên)
                </div>
            </div>
        </div>
    </div>

</div>

<script>
    new QRCode("id_qrcode", {
        text: "{{route('administrator.orders.print' , ['id'=> $item->id ])}}",
        width: document.getElementById("id_qrcode").offsetWidth,
        height: document.getElementById("id_qrcode").offsetWidth,
        colorDark: "#000000",
        colorLight: "#ffffff",
        correctLevel: QRCode.CorrectLevel.H,
    })

    if ("{{request('print')}}" == "true") {
        window.print()
    }

    // if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
    //     window.location.replace(window.location.href.replace("profile", "profile-mobile"))
    // }
</script>
</body>
</html>

<tr data-id="{{$item->id}}" id="row_{{$item->id}}">
    <td class="text-center">
        <input type="checkbox" class="checkbox-delete-item" value="{{$item->id}}">
    </td>
    <td>{{$item->id}}</td>
    <td>
        <div>
            {{$item->user_name}}
        </div>

        <div>
            {{$item->user_phone}}
        </div>
        <div>
            {{$item->user_address}}
        </div>
    </td>
    <td>
        @foreach($item->products as $productItem)
            <div class="mt-1 d-flex">
                <img class="rounded-circle"
                     src="{{$productItem->product_image}}" alt="">

                <div class="ms-1" style="border-bottom: solid 1px aliceblue;border-top: solid 1px aliceblue;">
                    <div>
                        {{\App\Models\Formatter::getShortDescriptionAttribute($productItem->name)}}
                    </div>

                    @if(optional($productItem->productSKU)->sku)
                    <div>
                        <p>
                            [{{ optional($productItem->productSKU)->sku}}]
                        </p>
                    </div>
                        @endif
                </div>

                <div class="ms-2" style="border-bottom: solid 1px aliceblue;border-top: solid 1px aliceblue;">
                    x{{\App\Models\Formatter::formatNumber($productItem->quantity)}}
                </div>
            </div>
        @endforeach
    </td>
    <td>
        @if($item->voucher)
            <div>
                <strong>
                    {{ optional($item->voucher)->code}}
                </strong>
            </div>
            <div>
                -{{\App\Models\Formatter::formatMoney($item->amount_voucher)}}
            </div>
        @endif

    </td>

    <td>
        {{ optional($item->shippingMethod)->name}}
    </td>

    <td>
        {{ optional($item->paymentMethod)->name}}
    </td>

    <td>
        <div>
            <strong>
                {{\App\Models\Formatter::formatMoney($item->amount)}}
            </strong>
        </div>

        <div>
            <i class="fa-solid fa-truck" title="Phí vận chuyển">

            </i>

            <i title="Phí vận chuyển">
                ({{\App\Models\Formatter::formatMoney($item->shipping_fee)}})
            </i>

        </div>
    </td>
    <td>
        @if($item->waitingConfirm())
            <a style="color: lightskyblue;cursor: pointer;" onclick="onReadyShip('{{$item->id}}')">Chuẩn bị hàng</a>
        @else
            <strong>
                {{$item->orderStatus->name}}
            </strong>
        @endif
    </td>
    <td>
        {{ optional($item->createdBy)->name}}
    </td>
    <td>{{\App\Models\Formatter::getDateTime($item->created_at)}}</td>
    <td>

        <a class="btn btn-outline-dark btn-sm" title="In"
           data-id="{{$item->id}}" href="{{route('administrator.orders.print', ['id' => $item->id])}}" target="_blank">
            <i class="fa-solid fa-print"></i>
        </a>

        <a class="btn btn-outline-secondary btn-sm edit" title="Sửa"
           href="{{route('administrator.'.$prefixView.'.edit' , ['id'=> $item->id])}}"
           data-id="{{$item->id}}"><i class="fa-solid fa-pen"></i></a>

        <a href="{{route('administrator.'.$prefixView.'.delete' , ['id'=> $item->id])}}" title="Xóa"
           data-url="{{route('administrator.'.$prefixView.'.delete' , ['id'=> $item->id])}}"
           class="btn btn-outline-danger btn-sm delete action_delete">
            <i class="fa-solid fa-x"></i>
        </a>

        <a href="{{route('administrator.'.$prefixView.'.audit' , ['id'=> $item->id])}}" title="Lịch sử tác động"
           data-url="{{route('administrator.'.$prefixView.'.audit' , ['id'=> $item->id])}}"
           class="btn btn-outline-info btn-sm action_audit">
            <i class="fa-solid fa-circle-info"></i>
        </a>
    </td>
</tr>

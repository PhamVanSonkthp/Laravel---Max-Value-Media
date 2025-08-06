<tr class="" id="tr_container_index_{{$index}}" data-id="{{$item->id}}">

    <td class="text-center">
        <input type="checkbox" class="checkbox-delete-item" value="{{$item->id}}">
    </td>
    {{--    <td>--}}
    {{--        @include('administrator.components.sort_icon_for_table', ['prefixView' => $prefixView])--}}
    {{--    </td>--}}
    <td>
        <div class="d-flex">
            <img class="rounded-circle" src="{{$item->avatar("100x100")}}" alt="">

            <div class="ms-2">
                <h5>
                    {{\App\Models\Formatter::getShortDescriptionAttribute($item->name, 10)}}
                </h5>

                <div class="mt-1" style="color: #999;font-size: 12px;">
                    SKU sản phẩm: {{ optional($item->skus->first())->sku}}
                </div>

                <div class="mt-1" style="color: #999;font-size: 12px;">
                    ID sản phẩm: {{$item->id}}
                </div>
            </div>

        </div>
    </td>
    <td>
        {{$item->numberSell()}}
    </td>
    <td>
        <div class="child-edit" onclick="onEditPrice('{{$item->id}}')">
            <span>
                {{$item->textRangePrice()}}
            </span>
            <i class="fa-regular fa-pen-to-square child-edit-hide"></i>
        </div>
    </td>
    <td>
        <div class="child-edit" onclick="onEditInventory('{{$item->id}}')">
            <span>
                {{$item->numberInventory()}}
            </span>
            <i class="fa-regular fa-pen-to-square child-edit-hide"></i>
        </div>
    </td>

    <td>
        @include('administrator.components.action_table', ['prefixView' => $prefixView, '$item' => $item])

    </td>

</tr>

@if($item->is_variant)

    @foreach($item->skus as $indexSKU => $sku)
        <tr style="border-width: 0 0;" class="{{$indexSKU >= 3 ? 'd-none variant-' . $item->id : ''}} tr_container_index_{{$index}}">
            <td></td>
            <td style="background-color: #fafafa">
                @foreach($sku->productAttributeOptionSKUs as $productAttributeOptionSKU)
                    <span style="color: #999;font-size: 12px;">
                        {{ optional($productAttributeOptionSKU->productAttributeOption)->value}}
                    </span>
                @endforeach

                <div class="d-flex">
                    <div>
                        <div>
                        </div>
                        <div style="color: #999;font-size: 12px;">
                            SKU phân loại: {{$sku->sku}}
                        </div>
                    </div>
                </div>

            </td>
            <td style="background-color: #fafafa">
                {{\App\Models\Formatter::formatNumber($sku->sell)}}
            </td>

            <td style="background-color: #fafafa">
                <div class="child-edit" onclick="onEditPrice('{{$item->id}}')">
                    <span>
                        {{\App\Models\Formatter::formatMoney($sku->price)}}
                    </span>
                    <i class="fa-regular fa-pen-to-square child-edit-hide"></i>
                </div>
            </td>

            <td style="background-color: #fafafa">
                <div class="child-edit" onclick="onEditInventory('{{$item->id}}')">
                    <span>
                        {{\App\Models\Formatter::formatMoney($sku->inventory)}}
                    </span>
                    <i class="fa-regular fa-pen-to-square child-edit-hide"></i>
                </div>

            </td>

            <td>

            </td>
        </tr>
    @endforeach

    @if($item->skus->count() > 3)
        <tr class="tr_container_index_{{$index}}">
            <td></td>
            <td style="background-color: #fafafa" colspan="4">
                <div style="cursor: pointer;">
                    <div id="btn_show_more_{{$item->id}}" onclick="onShowMoreVariant('{{$item->id}}')">
                        Xem thêm (còn {{$item->skus->count() - 3}} phân loại)<i class="ms-1 fa-solid fa-angle-down"></i>
                    </div>
                    <div id="btn_show_less_{{$item->id}}" onclick="onShowLessVariant('{{$item->id}}')" class="d-none">
                        Đóng <i class="ms-2 fa-solid fa-angle-up"></i>
                    </div>
                </div>
            </td>
            <td></td>
        </tr>
    @endif
@endif

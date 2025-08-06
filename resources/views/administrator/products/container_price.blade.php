<div class="ps-3 pe-3">
    {{$product->name}}
</div>

<div class="mt-3 p-3" style="background-color: #fafafa">
    <div class="row" style="align-items: center;">
        <div class="col-4">
            Chỉnh sửa hàng loạt
        </div>
        <div class="col-4">
            <input id="input_set_all_price" type="text" autocomplete="off" name="price" class="form-control number " value=""
                   placeholder="Nhập..." style="">
        </div>
        <div class="col-4">
            <button type="button" class="btn btn-outline-primary" onclick="onChangePriceAllInput()">Áp dụng cho tất cả phân loại</button>
        </div>
    </div>
</div>

<div class="mt-3">
    <div class="row p-3" style="background-color: #fafafa">
        <div class="col-6">
            Phân loại hàng
        </div>
        <div class="col-6">
            Giá
        </div>
    </div>

    <div class="p-3">
        @foreach($product->skus as $sku)
            <div class="border-top mt-2">
                <div class="row" style="align-items: end;">
                    <div class="col-6">
                        <div>
                            @foreach($sku->productAttributeOptionSKUs as $productAttributeOptionSKU)
                                <span style="color: #999;font-size: 12px;">
                                    {{ optional($productAttributeOptionSKU->productAttributeOption)->value}}
                                </span>
                            @endforeach
                        </div>

                        <div>
                            SKU: {{$sku->sku}}
                        </div>
                    </div>

                    <div class="col-6">
                        <input class="d-none sku-price-ids" value="{{$sku->id}}" />
                        @include('administrator.components.input_number', ['name' => '123', 'label' => '', 'value' => $sku->price, 'class' => 'sku-price-values'])
                    </div>

                </div>
            </div>

        @endforeach
    </div>
</div>



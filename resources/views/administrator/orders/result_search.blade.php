@if(count($results) == 0)
    <div class="d-flex m-3">
        <strong>
            Không tìm thấy sản phẩm phù hợp
        </strong>
    </div>
@endif

@foreach($results as $result)

    @if($result->is_variant)
        <div class="m-3">
            <div class="d-flex">
                <img style="height: 45px;" src="{{$result->avatar()}}" class="rounded-circle">

                <div>
                    <h4 class="ms-2">
                        {{\App\Models\Formatter::getShortDescriptionAttribute($result->name)}}
                    </h4>
                </div>

            </div>

            <div class="mt-2">
                @foreach($result->skus as $key => $sku)
                    <div class="ms-3 mt-1 item-product"
                         onclick="onAddProduct('{{$sku->id}}','{{$result->name}}','{{$sku->textSKUs()}}','{{$sku->price}}')">
                        <div>
                            <span>
                                Phân loại: {{$sku->textSKUs()}}
                            </span>

                        </div>
                        <div>
                            <span>
                                <strong>{{\App\Models\Formatter::formatMoney($sku->price)}}</strong>
                            </span>

                            Kho: {{\App\Models\Formatter::formatNumber($sku->inventory)}}
                        </div>
                    </div>

                @endforeach
            </div>
        </div>

    @else

        <div class="m-2">
            <div>
                @foreach($result->skus as $key => $sku)
                    <div class="mt-1 item-product"
                         onclick="onAddProduct('{{$sku->id}}','{{$result->name}}','{{$sku->textSKUs()}}','{{$sku->price}}')">

                        <div class="d-flex">
                            <img style="height: 45px;" src="{{$result->avatar()}}" class="rounded-circle">

                            <div>
                                <h4>
                                    {{\App\Models\Formatter::getShortDescriptionAttribute($result->name)}}
                                </h4>
                            </div>

                        </div>

                        <div>
                            <span>
                                <strong>{{\App\Models\Formatter::formatMoney($sku->price)}}</strong>
                            </span>

                            Kho: {{\App\Models\Formatter::formatNumber($sku->inventory)}}
                        </div>
                    </div>

                @endforeach
            </div>

        </div>
    @endif
@endforeach

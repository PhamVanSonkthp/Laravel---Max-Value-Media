<div class="table-responsive product-table">
    <table class="table table-bordered">
        <thead style="background-color: aliceblue;">
        <tr>
            <th style="min-width: 100px;">{{$header1}}</th>
            @if($header2 && count($values2) > 0)
            <th>{{$header2}}</th>
            @endif
            <th>Giá</th>
            <th>Kho hàng</th>
            <th>SKU</th>
        </tr>
        </thead>

        <tbody>

        @foreach($values1 as $index1 => $value)

            @if($value != '')

                <tr>
                    <td rowspan="{{count($values2) > 0 ? count($values2) : 1}}">
                        <div class="text-center" style="display: flex;justify-content: center;align-items: center;flex-direction: column;">
                            <p>{{$value}}</p>

                            @include('administrator.components.input_image', ['name' => 'none'])
                        </div>
                    </td>
                    @if($header2 && count($values2) > 0)
                        <td>
                            {{$values2[0]}}
                        </td>
                    @endif
                    <td>
                        <input name="sku_ids" value="{{!empty($productSKUs[$indexSKU]) ? $productSKUs[$indexSKU]['id'] : 0}}" class="d-none" />

                        @include('administrator.components.require_input_number' , ['name' => 'prices','value' => !empty($productSKUs[$indexSKU]) ? $productSKUs[$indexSKU]['price'] : 0])
                    </td>
                    <td>
                        @include('administrator.components.require_input_number' , ['name' => 'inventories','value' => !empty($productSKUs[$indexSKU]) ? $productSKUs[$indexSKU]['inventory'] : 0 ])
                    </td>
                    <td>
                        @include('administrator.components.input_text' , ['name' => 'skus','value' => '', 'class' => 'skus','value' => !empty($productSKUs[$indexSKU]) ? $productSKUs[$indexSKU]['sku'] : ''])
                    </td>
                </tr>

                @if($header2 && count($values2) > 0)
                    @foreach($values2 as $index => $value2)

                        @if($value2 != '' && $index > 0)

                        <tr>
                            <td>
                                {{$value2}}
                            </td>
                            <td>
                                <input name="sku_ids" value="{{!empty($productSKUs[$indexSKU]) ? $productSKUs[$indexSKU]['id'] : 0}}" class="d-none" />
                                @include('administrator.components.require_input_number' , ['name' => 'prices','value' => !empty($productSKUs[$indexSKU]) ? $productSKUs[$indexSKU]['price'] : 0 ])

                            </td>
                            <td>
                                @include('administrator.components.require_input_number' , ['name' => 'inventories','value' => !empty($productSKUs[$indexSKU]) ? $productSKUs[$indexSKU]['inventory'] : 0 ])
                            </td>
                            <td>
                                @include('administrator.components.input_text' , ['name' => 'skus','value' => '', 'class' => 'skus','value' => !empty($productSKUs[$indexSKU]) ? $productSKUs[$indexSKU]['sku'] : ''])
                            </td>
                        </tr>

                        @endif
                        @php
                            $indexSKU++;
                        @endphp
                    @endforeach
                @endif

            @endif


        @endforeach


        </tbody>
    </table>
</div>

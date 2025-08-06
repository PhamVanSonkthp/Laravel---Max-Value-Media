<div class="row">
    <div class="col-md-6">
        <h3>
            @include('administrator.components.lable_require') Vấn đề yêu cầu

            <select id="select_request_support_type" class="form-control select2_init">
                <option value="AIR">Vé máy bay (AIR)</option>
                <option value="ISR">Bảo hiểm (ISR)</option>
                <option value="VISA">Visa, hộ chiếu (VISA)</option>
                <option value="HOTEL">Phòng, khách sạn (HOTEL)</option>
            </select>
        </h3>

        <div class="mt-3">
            <label>@include('administrator.components.lable_require') Chi phí phát sinh tối đa cho support (VNĐ)</label>
            <input id="input_request_support_max_price" type="text" class="form-control number" autocomplete="off" required>
        </div>

        <div class="mt-3">
            <label>@include('administrator.components.lable_require') Chi phí phát sinh tối đa cho support (VNĐ)</label>
            <input id="input_request_support_max_price" type="text" class="form-control number" autocomplete="off" required>
        </div>

        <div class="mt-3">
            <label>@include('administrator.components.lable_require') Mô tả yêu cầu (VD: Yêu cầu bổ sung hành lý)</label>
            <input id="input_request_support_title" type="text" class="form-control" autocomplete="off" required>
        </div>

        <div class="mt-3">
            <label>@include('administrator.components.lable_require') Nội dung yêu cầu (VD: Bổ sung 15kg hành lý cho chuyến đi hành khách 1)</label>
            <input id="input_request_support_content" type="text" class="form-control" autocomplete="off" required>
        </div>

        <div class="mt-3">
            <label>@include('administrator.components.lable_require') Thông tin liên hệ  (Thông tin để CSKH liên hệ lại khi cần xác nhận)</label>
            <input id="input_request_support_contact_infor" type="text" class="form-control" autocomplete="off" required>
        </div>

        <div class="mt-3 text-end">
            <button onclick="onSendRequestSupport()" class="btn btn-info-gradien">Gửi yêu cầu</button>
        </div>

    </div>

    <div class="col-md-6">
        <h3>
            Yêu cầu đã gửi
        </h3>

        <ol>
            @foreach($item->requestSupports as $itemRequestSupport)
                <li>
                    <div>
                        <div>
                            <label>@include('administrator.components.lable_require') Vấn đề:</label>
                            <strong>{{$itemRequestSupport->request_type}}</strong>
                        </div>
                        <div>
                            <label>@include('administrator.components.lable_require') Mã Support:</label>
                            <strong>{{$itemRequestSupport->request_key}}</strong>
                        </div>

                        <div>
                            <label>@include('administrator.components.lable_require') Chi phí phát sinh tối đa cho support (VNĐ):</label>
                            <strong>{{$itemRequestSupport->max_price}}</strong>
                        </div>

                        <div>
                            <label>@include('administrator.components.lable_require') Mô tả yêu cầu:</label>
                            <strong>{{$itemRequestSupport->title}}</strong>
                        </div>

                        <div>
                            <label>@include('administrator.components.lable_require') Nội dung yêu cầu:</label>
                            <strong>{{$itemRequestSupport->content}}</strong>
                        </div>

                        <div>
                            <label>@include('administrator.components.lable_require') Thông tin liên hệ:</label>
                            <strong>{{$itemRequestSupport->contact_info}}</strong>
                        </div>
                    </div>
                </li>
            @endforeach

        </ol>

    </div>

</div>

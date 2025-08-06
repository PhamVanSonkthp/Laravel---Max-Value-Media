<div class="row">
    <div class="col-md-6">
        <div>
            <h3>
                Thông tin chung
            </h3>

            @include('administrator.components.require_input_text', ['label'=>'Tên','name' => 'name', 'id' => "input_name", 'value' => $item->name])

            <div class="mt-3">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="radio_gender" value="1" {{$item->gender_id == 1 ? 'checked' : ''}}>
                    <label class="form-check-label" for="radio_gender">
                        <i class="fa-solid fa-mars" style="color: cornflowerblue;"></i>
                    </label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="radio_gender_2" value="2" {{$item->gender_id == 2 ? 'checked' : ''}}>
                    <label class="form-check-label" for="radio_gender_2">
                        <i class="fa-solid fa-venus" style="color: deeppink;"></i>
                    </label>
                </div>
            </div>

            @include('administrator.components.require_input_text', ['label'=>'Số điện thoại','name' => 'phone', 'id' => "input_phone", 'value' => $item->phone])


            <div class="mt-3">
                <label class="bold">Mật
                    khẩu: @include('administrator.components.lable_require')</label>

                @if(empty($item->password))
                    <label class="text-danger">
                        Khách hàng cần cấp mật khẩu
                    </label>
                @endif
                <input id="input_password" required type="text" class="form-control"
                       autocomplete="off">
            </div>

            @include('administrator.components.require_input_text_email', ['label'=>'Email','name' => 'email', 'id' => "input_email", 'value' => $item->email])

            @include('administrator.components.require_input_date', ['label'=>'Ngày sinh','name' => 'date_of_birth', 'id' => "input_date_of_birth", 'value' => \App\Models\Formatter::getOnlyDate($item->date_of_birth), "placeholder" => "--/--/--"])

            @include('administrator.components.input_text', ['label'=>'Địa chỉ','name' => 'address', 'id' => "input_address", 'value' => $item->address])

            <div class="mt-3 d-none">
                <label class="bold">Loại khách
                    hàng: @include('administrator.components.lable_require')</label>
                <select id="select_user_type_id" class="form-control select2_init" required>
                    @foreach($userTypes as $itemUserTypes)
                        <option value="{{$itemUserTypes->id}}" {{$item->user_type_id == $itemUserTypes->id ? 'selected' : ''}}>{{$itemUserTypes->name}}</option>
                    @endforeach
                </select>
            </div>

            <div class="mt-3 d-none">
                <label class="bold">Trạng thái: @include('administrator.components.lable_require')</label>
                <select id="select_user_status_id" class="form-control select2_init" required>
                    @foreach($userStatuses as $itemUserStatuses)
                        <option
                            value="{{$itemUserStatuses->id}}" {{$item->user_status_id == $itemUserStatuses->id ? 'selected' : ''}}>{{$itemUserStatuses->name}}</option>
                    @endforeach
                </select>
            </div>

{{--            <div class="mt-3">--}}
{{--                <label class="bold">Số tiên:</label>--}}
{{--                <strong id="lable_amount">{{\App\Models\Formatter::formatMoney($item->amount)}}</strong>--}}
{{--            </div>--}}

{{--            <div class="mt-3">--}}
{{--                <label class="bold">Điểm:</label>--}}
{{--                <strong id="lable_point">{{\App\Models\Formatter::formatNumber($item->point)}}</strong>--}}
{{--            </div>--}}

        </div>
    </div>

    <div class="col-md-6">
        <div>

            <h3>
                Ảnh chân dung
            </h3>

            <div class="mb-3 mt-3">
                <div>
                    <img style="max-height: 400px;object-fit: contain;width: 100%;" id="img_id_front" src="{{$item->portrait_image_path}}">
                </div>
            </div>

            <h3>
                Ảnh chứng minh thư
            </h3>

            <div class="row">
                <div class="col-6">
                    <div>
                        <label class="bold">Ảnh mặt trước:</label>
                        <div>
                            <img style="max-height: 400px;object-fit: contain;width: 100%;" id="img_id_front" src="{{$item->front_id_image_path}}">
                        </div>
                    </div>
                </div>

                <div class="col-6">

                    <label class="bold">Ảnh mặt sau:</label>
                    <div>
                        <img style="max-height: 400px;object-fit: contain;width: 100%;" id="img_id_back" src="{{$item->back_id_image_path}}">
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>

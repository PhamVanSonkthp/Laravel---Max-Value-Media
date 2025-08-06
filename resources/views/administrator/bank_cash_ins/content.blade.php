@include('administrator.components.require_select2' , ['name' => 'bank_id' , 'label' => 'Ngân hàng', 'select2Items' => \App\Models\Bank::all(), 'name_option' => 'vn_name'])

@include('administrator.components.require_input_text' , ['name' => 'account_name' , 'label' => 'Tên người hưởng thụ'])

@include('administrator.components.require_input_text' , ['name' => 'account_number' , 'label' => 'Số tài khoản người hưởng thụ'])

@include('administrator.components.input_text_password' , ['name' => 'account_password' , 'label' => 'Mật khẩu ngân hàng', 'value' => ''])

@include('administrator.components.input_text' , ['name' => 'account_token_web2m' , 'label' => 'Token (web2m)'])


@if($isSingleImage)
    <div class="mt-3 mb-3">
        @include('administrator.components.upload_image', ['post_api' => $imagePostUrl, 'table' => $table, 'image' => $imagePathSingple , 'relate_id' => $relateImageTableId])
    </div>
@endif

@if($isMultipleImages)
    <div class="mt-3 mb-3">
        @include('administrator.components.upload_multiple_images', ['post_api' => $imageMultiplePostUrl, 'delete_api' => $imageMultipleDeleteUrl , 'sort_api' => $imageMultipleSortUrl, 'table' => $table , 'images' => $imagesPath,'relate_id' => $relateImageTableId])
    </div>
@endif

@include('administrator.components.require_check_box' , ['name' => 'is_default' , 'label' => 'Mặc định'])

{{--                            @include('administrator.components.textarea_description', ['name' => 'description' , 'label' => 'Mô tả'])--}}

@include('administrator.components.button_save')

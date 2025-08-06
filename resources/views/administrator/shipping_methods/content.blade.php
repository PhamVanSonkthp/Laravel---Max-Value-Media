@include('administrator.components.require_input_text' , ['name' => 'name' , 'label' => 'Tên'])
@include('administrator.components.require_check_box' , ['name' => 'is_default' , 'label' => 'Mặc định?'])

@include('administrator.components.input_text' , ['name' => 'public_key' , 'label' => 'public_key'])
@include('administrator.components.input_text' , ['name' => 'private_key' , 'label' => 'private_key'])
@include('administrator.components.input_text' , ['name' => 'doc_link' , 'label' => 'Tài liệu'])

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

{{--                            @include('administrator.components.textarea_description', ['name' => 'description' , 'label' => 'Mô tả'])--}}

@include('administrator.components.button_save')

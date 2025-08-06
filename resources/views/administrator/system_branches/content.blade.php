@include('administrator.components.require_input_text' , ['name' => 'name' , 'label' => 'Tên'])

@include('administrator.components.require_input_text' , ['name' => 'description' , 'label' => 'Mô tả'])

@include('administrator.components.require_input_text' , ['name' => 'phone' , 'label' => 'Số điện thoại'])

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

@include('administrator.components.button_save')

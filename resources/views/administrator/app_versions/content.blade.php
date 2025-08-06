
<div class="mt-3">
    <label>Loại @include('administrator.components.lable_require') </label>
    <select name="type_id" class="form-control select2_init">
        <option value="1">Android</option>
        <option value="2">IOS</option>
    </select>
</div>

@include('administrator.components.require_input_text' , ['name' => 'version' , 'label' => 'Phiên bản'])

@include('administrator.components.require_check_box' , ['name' => 'is_debug' , 'label' => 'Debug'])

@include('administrator.components.require_check_box' , ['name' => 'is_update' , 'label' => 'Yêu cầu update'])

@include('administrator.components.require_check_box' , ['name' => 'is_require' , 'label' => 'Bắt buộc update'])

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

{{--@include('administrator.components.textarea_description', ['name' => 'description' , 'label' => 'Mô tả'])--}}

@include('administrator.components.button_save')

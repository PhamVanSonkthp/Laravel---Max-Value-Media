@include('administrator.components.require_input_text' , ['name' => 'title' , 'label' => 'Tiêu đề'])

@include('administrator.components.select_category' , ['name' => 'category_id' ,'html_category' => \App\Models\CategoryNew::getCategory(isset($item) ? optional($item)->category_id : ''), 'can_create' => true])

<div class="form-group mt-3">

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

    @include('administrator.components.require_textarea_description', ['name' => 'contents' , 'label' => 'Mô tả'])

    <button type="submit" class="btn btn-primary mt-3">Thêm mới</button>
</div>

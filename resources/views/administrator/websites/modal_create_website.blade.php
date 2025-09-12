<div class="mt-3">
    @include('administrator.components.require_select2_ajax' , ['id' => 'modal_create_website_user_id', 'name' => 'user_id' , 'label' => 'Publisher', 'url' => route('ajax.administrator.model.search', ['is_admin' => 0]), 'model' => 'users', 'modal_id' => $modalID, 'value' => isset($value) ? $value : ''])
</div>

<div class="mt-3">
    @include('administrator.components.require_input_text',['label' => 'Url', 'name' => 'url', 'placeholder' => 'https://example.com', 'id' => 'modal_create_website_input_name', 'value' => ''])
</div>

<div class="mt-3">
    @include('administrator.components.require_select2', ['label' => 'Category', 'name' => 'category_website_id', 'select2Items' => $categoryWebsites, 'modal_id' => $modalID, 'id' => 'modal_create_website_select_category_website_id'])
</div>

<div class="mt-3">
    @include('administrator.components.require_select2', ['label' => 'Status', 'name' => 'status_website_id', 'select2Items' => $statusWebsites, 'modal_id' => $modalID, 'id' => 'modal_create_website_select_status_website_id','value'=> 2 ])
</div>

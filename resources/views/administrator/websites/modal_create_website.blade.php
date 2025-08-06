<div class="mt-3">
    @include('administrator.components.require_select2', ['label' => 'Publisher', 'name' => 'user_id', 'select2Items' => $users, 'modal_id' => $modalID])
</div>

<div class="mt-3">
    @include('administrator.components.require_input_text',['label' => 'Url', 'name' => 'url', 'placeholder' => 'https://example.com'])
</div>

<div class="mt-3">
    @include('administrator.components.require_select2', ['label' => 'Danh mục', 'name' => 'category_website_id', 'select2Items' => $categoryWebsites, 'modal_id' => $modalID])
</div>

<div class="mt-3">
    @include('administrator.components.require_select2', ['label' => 'Trạng thái', 'name' => 'status_website_id', 'select2Items' => $statusWebsites, 'modal_id' => $modalID])
</div>

<div>
    @include('administrator.components.textarea', ['label' => "Ads", 'name' => 'ads', 'item' => $item, 'id' => 'modal_view_and_edit_ads_input_ads'])

    <div class="float-end">
        <button onclick="onUpdateAds({{$item->id}})" class="btn btn-primary mt-3">Save</button>
    </div>


</div>

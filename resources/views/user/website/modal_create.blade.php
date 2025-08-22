<div>
    @include('user.website.require_input_ajax_checking', ['id' => 'input_url_create','label' => 'URL' , 'name' => 'url', 'placeholder' => 'example.com', 'addon' => '.com/.net,...','value' => '', 'no_margin'=>true])
</div>

<div class="mt-3 text-start">
    <button id="button_create_website" class="btn btn-success" onclick="onStoreWebsite()" disabled>
        Add now
    </button>
</div>

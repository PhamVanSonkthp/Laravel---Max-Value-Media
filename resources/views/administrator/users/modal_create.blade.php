<div class="row">
    <div class="col-md-12">
        <div>

            @include('administrator.components.input_text', ['label'=>'Email','name' => 'email', 'id' => "modal_create_input_email", 'value' => ''])

            @include('administrator.components.input_text', ['label'=>'Password','name' => 'password', 'id' => "modal_create_input_password", 'value' => ''])

            @include('administrator.components.select2_allow_clear', ['label'=>'Manager','name' => 'manager_id', 'id' => "modal_create_select_manager_id", 'select2Items' => $managers, 'modal_id' => $modal_id])

            @include('administrator.components.input_text', ['label'=>'Skype','name' => 'skype', 'id' => "modal_create_input_skype"])

            @include('administrator.components.input_text', ['label'=>'Telegram','name' => 'telegram', 'id' => "modal_create_input_telegram"])

            @include('administrator.components.input_text', ['label'=>'Whats app','name' => 'whats_app', 'id' => "modal_create_input_whats_app"])


        </div>
    </div>

</div>

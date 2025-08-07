<div class="row">
    <div class="col-md-12">
        <div>

            @include('administrator.components.input_text', ['label'=>'Password','name' => 'password', 'id' => "input_password", 'value' => ''])

            @include('administrator.components.select2_allow_clear', ['label'=>'Manager','name' => 'manager_id', 'id' => "select_manager", 'select2Items' => $managers, 'modal_id' => 'editUserModal'])

            @include('administrator.components.input_text', ['label'=>'Skype','name' => 'skype', 'id' => "input_skype"])

            @include('administrator.components.input_text', ['label'=>'Telegram','name' => 'telegram', 'id' => "input_telegram"])

            @include('administrator.components.input_text', ['label'=>'Whats app','name' => 'whats_app', 'id' => "input_whats_app"])


        </div>
    </div>

</div>

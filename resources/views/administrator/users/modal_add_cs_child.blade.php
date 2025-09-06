
<div>
    @include('administrator.components.require_select2', ['name'=>'none', 'select2Items' => $csChildren, 'modal_id' => $modal_id, 'id' => 'modal_add_cs_child_select_cs_id'])

    @include('administrator.components.button_save', ['onclick' => 'onSaveCSChild('.$item->id.')'])
</div>

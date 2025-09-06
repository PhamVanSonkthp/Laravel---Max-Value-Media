@include('administrator.components.require_select2', ['label' => 'Change status', 'name' => 'payment_status_id', 'select2Items' => $select2Items, 'id' => 'modal_change_status_payment_status_id', 'modal_id' => 'modal_change_status'])

<div style="position: relative;">
    <button onclick="onSaveStatusPayment({{$item->id}})" id="{{isset($id) ? $id : \App\Models\Helper::randomString()}}" type="submit" class="btn btn-primary mt-3">Save</button>
</div>

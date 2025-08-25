@include('administrator.components.require_select2', ['label' => 'Change status', 'name' => 'status_website_id', 'select2Items' => $select2Items, 'id' => 'modal_change_status_status_website_id'])

@include('administrator.components.require_select2', ['label' => 'Reasons', 'name' => 'none', 'select2Items' => [],  'id' => 'modal_change_status_select_reason'])

@include('administrator.components.require_textarea', ['label' => 'Custom reasons', 'name' => 'reason_refuse', 'id' => 'modal_change_status_textarea'])

<div style="position: relative;">
    <button onclick="onSaveStatusWebsite({{$item->id}})" id="{{isset($id) ? $id : \App\Models\Helper::randomString()}}" type="submit" class="btn btn-primary mt-3">Save</button>
</div>

<script>
    $(document).ready(function() {



        // Hide second select and textarea initially
        $('#container_modal_change_status_select_reason').hide();
        $('#modal_change_status_select_reason').next('.select2-container').hide();
        @if(!in_array($item->status_website_id, [4,6]))
        $('#modal_change_status_textarea').hide();
        $('#container_modal_change_status_textarea').hide();
        @endif

        // Change first select
        $('#modal_change_status_status_website_id').on('change', function() {
            let value = $(this).val();
            $('#modal_change_status_textarea').hide();
            $('#container_modal_change_status_textarea').hide();

            if (value == 6) {
                $('#modal_change_status_select_reason').html(`@include('administrator.websites.modal_change_status_reason', ['items' => $statusWebsiteReasonPendings])`).val(null).trigger('change');

                $('#container_modal_change_status_select_reason').show();
                $('#modal_change_status_select_reason').next('.select2-container').show();

            } else if (value == 4) {
                $('#modal_change_status_select_reason').html(`@include('administrator.websites.modal_change_status_reason', ['items' => $statusWebsiteReasonRejects])`).val(null).trigger('change');

                $('#container_modal_change_status_select_reason').show();
                $('#modal_change_status_select_reason').next('.select2-container').show();

            } else {
                $('#modal_change_status_select_reason').val(null).trigger('change');
                $('#container_modal_change_status_select_reason').hide();
                $('#modal_change_status_select_reason').next('.select2-container').hide();
            }
        });


        $('#modal_change_status_select_reason').on('change', function() {
            if ($(this).val() === 'custom') {
                $('#modal_change_status_textarea').show();
                $('#container_modal_change_status_textarea').show();
            } else {
                $('#modal_change_status_textarea').hide();
                $('#container_modal_change_status_textarea').hide();
            }
        });
    });
</script>

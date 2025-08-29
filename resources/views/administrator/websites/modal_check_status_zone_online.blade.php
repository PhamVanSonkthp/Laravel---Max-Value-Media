<div>
    @include('administrator.components.input_text', ['label' => 'Specific url (optional)', 'name' => 'none','id' => 'modal_check_status_zone_online_input_url'])

    @include('administrator.components.button_save', ['label' => 'Check' , 'onclick' => 'onCheckStatusZoneOnline('.$item->id.')'])
</div>


<script>

    @if(isset($hideAllPreModal))
    hideAllModal();
    @endif

</script>

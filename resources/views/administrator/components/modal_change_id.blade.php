@php
    $randomID = \App\Models\Helper::randomString();
@endphp

<div>
    <a style="cursor: pointer;" onclick="onShowModalChangeID{{$randomID}}(event)" id="label_{{$randomID}}" class="text-primary">
        {{$label}}
    </a>
</div>

<!-- Modal -->
<div class="modal fade" id="model_change_id_{{$randomID}}" data-bs-keyboard="false" tabindex="-1" aria-hidden="true" role="dialog" data-backdrop="false">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Change</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <label>{{$label}} @include('administrator.components.lable_require') </label>
                <div>
                    <select style="with:100%;" id="select_change_{{$randomID}}" name="select_change_{{$randomID}}" class="form-control">
                        @foreach($select2Items as $select2Item)
                            <option value="{{$select2Item->id}}" {{$item->$field == $select2Item->id ? 'selected' : ''}}>{{($select2Item->name ?? $select2Item->title) ?? $select2Item->$field}}</option>
                        @endforeach
                    </select>
                </div>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="onChangeID{{$randomID}}()">Save</button>
            </div>
        </div>
    </div>
</div>

<script>

    function onChangeID{{$randomID}}() {
        showToastLoading("Updating status zone...");
        processUpdateStatusZone{{$randomID}}({{$item->id}});
    }

    function processUpdateStatusZone{{$randomID}}(id) {
        callAjax(
            "PUT",
            "{{route('ajax.administrator.zone_websites.update_status')}}",
            {
                'id': id,
                'zone_status_id': $('#select_change_{{$randomID}}').val(),
            },
            (response) => {
                if (response.code == 219) {
                    setTimeout(processUpdateStatusZone{{$randomID}}(id), 5000);
                } else {
                    hideAllToast()
                    if (response.is_success) {
                        $('#label_{{$randomID}}').html($('#select_change_{{$randomID}}').find(':selected').text())
                        hideModal('model_change_id_{{$randomID}}')
                        showToastSuccess('Status changed!');
                    } else {
                        showToastError(response.message);
                    }
                }
            },
            (error) => {

            },
            false
        )
    }

    function onShowModalChangeID{{$randomID}}(e){
        e.stopPropagation();
        showModal('model_change_id_{{$randomID}}')
        @if(isset($removeBackdrop))
            $('#model_change_id_{{$randomID}}').css("background", "rgb(157, 157, 157)");
            $('.modal-backdrop').removeClass("modal-backdrop");
        @endif
    }


    $(document).ready(function() {
        $("#select_change_{{$randomID}}").select2({
            width: '100%',
            dropdownParent: $("#model_change_id_{{$randomID}}")
        });
    });


</script>

@php
    $randomID = \App\Models\Helper::randomString();
@endphp

<div>
    <a id="label_{{$randomID}}" href="#" data-bs-toggle="modal" data-bs-target="#model_change_id_{{$randomID}}">
        {{$label}}
    </a>
</div>

<!-- Modal -->
<div class="modal fade" id="model_change_id_{{$randomID}}" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
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
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                <button type="button" class="btn btn-primary" onclick="onChangeID{{$randomID}}()">Cập nhật</button>
            </div>
        </div>
    </div>
</div>

<script>
    function onChangeID{{$randomID}}() {

        callAjax(
            "PUT",
            "{{route('ajax.administrator.model.update_field')}}",
            {
                'id': '{{$item->id}}',
                '{{$field}}': $('#select_change_{{$randomID}}').val(),
                'model': '{{$item->getTableName()}}',
            },
            (response) => {
                $('#label_{{$randomID}}').html($('#select_change_{{$randomID}}').find(':selected').text())
                hideModal('model_change_id_{{$randomID}}')
                showToastSuccess()
            },
            (error) => {

            },
            true,
        )

    }

    $(document).ready(function() {
        $("#select_change_{{$randomID}}").select2({
            width: '100%',
            dropdownParent: $("#model_change_id_{{$randomID}}")
        });
    });


</script>

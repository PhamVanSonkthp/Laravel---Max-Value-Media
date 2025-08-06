@php
    if(isset($item)){
        $value = $item->$name;
    }else{
        $value = old($name);
    }

    $randomId = isset($id) ? $id : (\App\Models\Helper::randomString());
@endphp

<div class="form-group mt-3">
    <label>{{$label}} @include('administrator.components.lable_require')</label>

    <div class="mb-2 mt-2">
        <label class="text-info" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#modal_{{$randomId}}" onclick="onFillSuggest{{$randomId}}()">
            Tạo nội dung bằng AI
        </label>

    </div>

    <textarea id="{{$randomId}}" style="min-height: {{isset($height) ? $height : '300'}}px;" name="{{$name}}"
              class="form-control tinymce_editor_init @error($name) is-invalid @enderror"
              rows="5">{{$value}}</textarea>
    @error($name)
    <div class="alert alert-danger">{{$message}}</div>
    @enderror
</div>


<div class="modal fade" id="modal_{{$randomId}}" tabindex="-1" aria-labelledby="changeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Mô tả về nội dung</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="content_modal_{{$randomId}}">

                <div class="form-group mt-3">
                    <label>Nhập mô tả <span class="text-danger">*</span></label>
                    <input id="input_{{$randomId}}" type="text" autocomplete="off" class="form-control" value="">
                </div>

                <div class="text-end">
                    <button type="button" class="btn btn-primary mt-3" onclick="genContentAI{{$randomId}}('{{$randomId}}')">Tạo</button>
                </div>
            </div>

        </div>
    </div>
</div>

<script>

    function onFillSuggest{{$randomId}}() {

        let value = $('input[name="name"]').val()

        if(!value){
            value = $('input[name="title"]').val()
        }

        if (value){
            $('#input_{{$randomId}}').val(value)
        }
    }

    function genContentAI{{$randomId}}(id) {

        const value = $('#input_' + id).val()

        if (value){

            hideModal('modal_{{$randomId}}')

            showToastSuccess('Đang tạo nội dung')

            callAjax(
                "POST",
                "{{route('ajax.chat_ai.get')}}",
                {
                    'code': 1,
                    'text': value,
                    'token': "{{\App\Models\Setting::first()->token_chat}}",
                },
                (response) => {
                    showToastSuccess('Đã tạo nội dung')
                    tinyMCE.get(id).setContent(response.message)

                },
                (error) => {
                    showToastError('Có lỗi trong khi tạo nội dung')
                },
                false,
            )

        }else{
            alert('Vui lòng nhập mô tả')
        }


    }
</script>

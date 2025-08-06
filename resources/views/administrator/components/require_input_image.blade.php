@php
    $idRandom = \App\Models\Helper::randomString();
@endphp

<div class="mt-3 form-group">
    <div>
        <label>
            {{isset($label) ? $label : "Logo"}} @include('administrator.components.lable_require')
        </label>
    </div>
    <div class="container-image-input" id="container_{{$idRandom}}">
        <input type="file" name="{{$name}}"
               id="image-file_{{$idRandom}}"
               accept="image/x-png, image/jpeg" required
               style="display : none" {{isset($disabled) ? 'disabled' : ''}}
        />

        <label id="image-label_{{$idRandom}}" for="image-file_{{$idRandom}}">

            @if(isset($item) && !empty($item->$name))
                <img id="image_placeholder_{{$idRandom}}" class="image-place-houlder" src="{{env('APP_URL') . ($item->$name)}}">
            @else
                <img id="image_placeholder_{{$idRandom}}" class="image-place-houlder" src="{{(asset('/assets/administrator/images/placeholder.png'))}}">
                {{--                Upload image--}}
            @endif

        </label>

    </div>
</div>

<style>

    #image_placeholder_{{$idRandom}}{
        max-width: 200px;
    }

    .image-place-houlder {
        width: 50px;
        height: 50px;
        position: absolute;
        top: 40%;
    }

    #container_{{$idRandom}} {
        display: flex;
        justify-content: center;
        position: relative;
    }

    #image-label_{{$idRandom}} {
        position: relative;
        width: 200px;
        height: 200px;
        background: #fff;
        background-position: center;
        background-repeat: no-repeat;
        background-size: contain;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0px 1px 7px rgba(105, 110, 232, 0.54);
        border-radius: 10px;
        flex-direction: column;
        gap: 15px;
        user-select: none;
        cursor: pointer;
        color: #207ed1;
        transition: all 1s;
    }

    #image-label_{{$idRandom}}:hover {
        color: #18ac1c;
    }
</style>

<script>
    $(document).ready(function () {

        const input_file = document.getElementById('image-file_{{$idRandom}}');
        const input_label = document.getElementById('image-label_{{$idRandom}}')

        const convert_to_base64 = file => new Promise((response) => {
            const file_reader = new FileReader();
            file_reader.readAsDataURL(file);
            file_reader.onload = () => response(file_reader.result);
        });

        input_file.addEventListener('change', async function () {
            const file = document.querySelector('#image-file_{{$idRandom}}').files;
            const my_image = await convert_to_base64(file[0]);
            // input_label.style.backgroundImage = `url(${my_image})`

            $('#image_placeholder_{{$idRandom}}').attr('src',my_image);


            {{--$('#image-label_{{$idRandom}}').html('')--}}
        })


    });
</script>

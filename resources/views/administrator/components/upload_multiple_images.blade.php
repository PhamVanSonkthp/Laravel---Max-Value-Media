{{--@php--}}

{{--    if(isset($item)) {--}}
{{--        $images = $item->images;--}}
{{--        $relateImageTableId = $item->id;--}}
{{--        $relate_id = $item->id;--}}
{{--        $upload_mutiple_id = $relate_id;--}}
{{--    }else{--}}
{{--        $upload_mutiple_id = \App\Models\Helper::randomString();--}}
{{--    }--}}

{{--@endphp--}}

{{--<style>--}}
{{--    #drop-region-{{$upload_mutiple_id}} {--}}
{{--        background-color: #fff;--}}
{{--        border-radius: 20px;--}}
{{--        box-shadow: 0 0 35px rgba(0, 0, 0, 0.05);--}}
{{--        /*width:400px;*/--}}
{{--        padding: 20px;--}}
{{--        /*text-align: center;*/--}}
{{--        /*cursor: pointer;*/--}}
{{--        transition: .3s;--}}
{{--        min-height: 314px;--}}
{{--        position: relative;--}}
{{--    }--}}

{{--    .drop-region-active{--}}
{{--        filter: drop-shadow(0 0 0.15rem crimson);--}}
{{--    }--}}

{{--    #drop-region-{{$upload_mutiple_id}}:hover {--}}
{{--        box-shadow: 0 0 45px rgba(0, 0, 0, 0.1);--}}
{{--    }--}}

{{--    #image-preview-{{$upload_mutiple_id}} {--}}
{{--        margin-top: 20px;--}}
{{--        display: flex;--}}
{{--        gap: 10px;--}}
{{--        overflow-x: auto;--}}
{{--    }--}}

{{--    #image-preview-{{$upload_mutiple_id}} .image-view {--}}
{{--        display: inline-block;--}}
{{--        position: relative;--}}
{{--        margin-right: 13px;--}}
{{--        margin-left: 13px;--}}
{{--    }--}}

{{--    #image-preview-{{$upload_mutiple_id}} .image-view img {--}}
{{--        max-width: 102px;--}}
{{--        max-height: 220px;--}}
{{--        box-shadow: rgb(0 0 0 / 20%) 0px 0px 1px inset;--}}
{{--        border-radius: 12px;--}}
{{--        border: 1px solid #dee2e6 !important;--}}
{{--    }--}}

{{--    #image-preview-{{$upload_mutiple_id}} .overlay {--}}
{{--        position: absolute;--}}
{{--        width: 100%;--}}
{{--        height: 100%;--}}
{{--        top: 0;--}}
{{--        right: 0;--}}
{{--        z-index: 2;--}}
{{--        background: rgba(255, 255, 255, 0.5);--}}
{{--    }--}}

{{--    #drop-message-{{$upload_mutiple_id}} {--}}
{{--        position: absolute;--}}
{{--        transform: translate(-50%, -50%);--}}
{{--        left: 50%;--}}
{{--        bottom: 50%;--}}
{{--    }--}}

{{--    .delete-button {--}}
{{--        width: 0px;--}}
{{--        color: red;--}}
{{--        font-size: 25px;--}}
{{--        position: absolute;--}}
{{--        left: -5px;--}}
{{--        top: 0px;--}}
{{--    }--}}

{{--    .delete-button:hover {--}}
{{--        cursor: pointer;--}}
{{--    }--}}

{{--    .delete-button {--}}
{{--        visibility: hidden;--}}
{{--    }--}}

{{--    .image-view {--}}
{{--        cursor: pointer;--}}
{{--    }--}}

{{--    .image-view:hover .delete-button {--}}
{{--        visibility: visible;--}}
{{--    }--}}

{{--    .container-spinner {--}}
{{--        position: absolute;--}}
{{--        top: 50%;--}}
{{--        left: 50%;--}}
{{--        transform: translate(-50%, -50%);--}}
{{--    }--}}

{{--    .drop-blur {--}}
{{--        filter: blur(2px);--}}
{{--        -webkit-filter: blur(2px);--}}
{{--    }--}}


{{--</style>--}}

{{--<div id="drop-region-{{$upload_mutiple_id}}">--}}
{{--    <div id="drop-message-{{$upload_mutiple_id}}">--}}
{{--        Kéo thả hình ảnh vào đây--}}
{{--    </div>--}}
{{--    <ul id="image-preview-{{$upload_mutiple_id}}">--}}
{{--        @if(isset($images))--}}
{{--            @foreach($images as $image)--}}
{{--                <li class="image-view" id="drop_image__{{$image->id}}">--}}
{{--                    <img src="{{$image->image_path}}">--}}
{{--                    <i id="btn_delete_image_{{$upload_mutiple_id}}" class="fa-solid fa-xmark delete-button"></i>--}}
{{--                </li>--}}
{{--            @endforeach--}}

{{--        @endif--}}
{{--    </ul>--}}
{{--</div>--}}

{{--<script>--}}

{{--    $(document).ready(function () {--}}
{{--        @if(isset($images))--}}
{{--        @if(count($images))--}}
{{--        $('#drop-message-{{$upload_mutiple_id}}').hide()--}}
{{--        @endif--}}
{{--            @endif--}}

{{--        if (typeof url_upload_file_{{$upload_mutiple_id}} === 'undefined') {--}}
{{--            var url_upload_file_{{$upload_mutiple_id}} = "{{$post_api}}"--}}
{{--        }else{--}}
{{--            url_upload_file_{{$upload_mutiple_id}} = "{{$post_api}}"--}}
{{--        }--}}

{{--        if (typeof url_delete_file_{{$upload_mutiple_id}} === 'undefined') {--}}
{{--            var url_delete_file_{{$upload_mutiple_id}} = "{{$delete_api}}"--}}
{{--        }else{--}}
{{--            url_delete_file_{{$upload_mutiple_id}} = "{{$delete_api}}"--}}
{{--        }--}}

{{--        if (typeof url_sort_file_{{$upload_mutiple_id}} === 'undefined') {--}}
{{--            var url_sort_file_{{$upload_mutiple_id}} = "{{$sort_api}}"--}}
{{--        }else{--}}
{{--            url_sort_file_{{$upload_mutiple_id}} = "{{$sort_api}}"--}}
{{--        }--}}

{{--        if (typeof maximum_upload_file === 'undefined') {--}}
{{--            var maximum_upload_file = 10e6--}}
{{--        }--}}

{{--        if (typeof accept_upload_file === 'undefined') {--}}
{{--            var accept_upload_file = ['image/jpeg', 'image/png', 'image/gif', 'image/webp']--}}
{{--        }--}}

{{--        $('#image-preview-{{$upload_mutiple_id}}').on('sortupdate', function () {--}}
{{--            const imageIdsArray = [];--}}
{{--            $('#image-preview-{{$upload_mutiple_id}} li').each(function (index) {--}}
{{--                var id = $(this).attr('id');--}}
{{--                if (isDefine(id)) {--}}
{{--                    const split_id = id.split("__");--}}
{{--                    imageIdsArray.push(split_id[1]);--}}
{{--                }--}}
{{--            });--}}

{{--            callAjax(--}}
{{--                "PUT",--}}
{{--                url_sort_file_{{$upload_mutiple_id}},--}}
{{--                {--}}
{{--                    ids: imageIdsArray--}}
{{--                },--}}
{{--                (response) => {--}}

{{--                },--}}
{{--                (error) => {--}}

{{--                },--}}
{{--                false,--}}
{{--            )--}}
{{--        });--}}

{{--        $("#image-preview-{{$upload_mutiple_id}}").sortable({--}}
{{--            update: function (event, ui) {--}}
{{--                // dropIndex = ui.item.index();--}}
{{--            },--}}
{{--        });--}}


{{--        var // where files are dropped + file selector is opened--}}
{{--            dropRegion = document.getElementById("drop-region-{{$upload_mutiple_id}}"),--}}
{{--            // where images are previewed--}}
{{--            imagePreviewRegion = document.getElementById("image-preview-{{$upload_mutiple_id}}");--}}


{{--        // open file selector when clicked on the drop region--}}
{{--        var fakeInput = document.createElement("input");--}}
{{--        fakeInput.type = "file";--}}
{{--        fakeInput.accept = "image/*";--}}
{{--        fakeInput.multiple = true;--}}
{{--        // dropRegion.addEventListener('click', function () {--}}
{{--        //     fakeInput.click();--}}
{{--        // });--}}

{{--        fakeInput.addEventListener("change", function () {--}}
{{--            var files = fakeInput.files;--}}
{{--            handleFiles(files);--}}
{{--        });--}}


{{--        function preventDefault(e) {--}}
{{--            e.preventDefault();--}}
{{--            e.stopPropagation();--}}
{{--        }--}}

{{--        dropRegion.addEventListener('dragenter', preventDefault, false)--}}
{{--        dropRegion.addEventListener('dragleave', preventDefault, false)--}}
{{--        dropRegion.addEventListener('dragover', preventDefault, false)--}}
{{--        dropRegion.addEventListener('drop', preventDefault, false)--}}


{{--        function handleDrop(e) {--}}
{{--            var dt = e.dataTransfer,--}}
{{--                files = dt.files;--}}

{{--            if (files.length) {--}}

{{--                handleFiles(files);--}}

{{--            } else {--}}

{{--                // check for img--}}
{{--                var html = dt.getData('text/html'),--}}
{{--                    match = html && /\bsrc="?([^"\s]+)"?\s*/.exec(html),--}}
{{--                    url = match && match[1];--}}


{{--                if (url) {--}}
{{--                    uploadImageFromURL(url);--}}
{{--                    return;--}}
{{--                }--}}

{{--            }--}}


{{--            function uploadImageFromURL(url) {--}}
{{--                var img = new Image;--}}
{{--                var c = document.createElement("canvas");--}}
{{--                var ctx = c.getContext("2d");--}}

{{--                img.onload = function () {--}}
{{--                    c.width = this.naturalWidth;     // update canvas size to match image--}}
{{--                    c.height = this.naturalHeight;--}}
{{--                    ctx.drawImage(this, 0, 0);       // draw in image--}}
{{--                    c.toBlob(function (blob) {        // get content as PNG blob--}}

{{--                        // call our main function--}}
{{--                        handleFiles([blob]);--}}

{{--                    }, "image/png");--}}
{{--                };--}}
{{--                img.onerror = function () {--}}
{{--                    alert("Error in uploading");--}}
{{--                }--}}
{{--                img.crossOrigin = "";              // if from different origin--}}
{{--                img.src = url;--}}
{{--            }--}}

{{--        }--}}

{{--        dropRegion.addEventListener('drop', handleDrop, false);--}}


{{--        function handleFiles(files) {--}}
{{--            for (var i = 0, len = files.length; i < len; i++) {--}}
{{--                if (validateImage(files[i]))--}}
{{--                    previewAnduploadImage(files[i]);--}}
{{--            }--}}
{{--        }--}}

{{--        function validateImage(image) {--}}
{{--            // check the type--}}
{{--            var validTypes = accept_upload_file;--}}
{{--            if (validTypes.indexOf(image.type) === -1) {--}}
{{--                alert("Invalid File Type");--}}
{{--                return false;--}}
{{--            }--}}

{{--            // check the size--}}
{{--            var maxSizeInBytes = maximum_upload_file; // 10MB--}}
{{--            if (image.size > maxSizeInBytes) {--}}
{{--                alert("File too large");--}}
{{--                return false;--}}
{{--            }--}}

{{--            return true;--}}

{{--        }--}}

{{--        function deleteDropImage(event){--}}
{{--            console.log(event)--}}
{{--            const removed_id = $(this).parent().attr('id').split('__')[1]--}}
{{--            $(this).parent().remove()--}}
{{--            if ($('#image-preview-{{$upload_mutiple_id}}').children().length == 0) {--}}
{{--                $('#drop-message-{{$upload_mutiple_id}}').show()--}}
{{--            }--}}
{{--            callAjax(--}}
{{--                "DELETE",--}}
{{--                url_delete_file_{{$upload_mutiple_id}},--}}
{{--                {--}}
{{--                    id: removed_id--}}
{{--                },--}}
{{--                (response) => {--}}
{{--                    console.log(response)--}}
{{--                },--}}
{{--                (error) => {--}}

{{--                },--}}
{{--                false,--}}
{{--            )--}}
{{--        }--}}

{{--        $(document).on('click', '#btn_delete_image_{{$upload_mutiple_id}}', deleteDropImage);--}}

{{--        function previewAnduploadImage(image) {--}}

{{--            let random_id = uuidv4()--}}

{{--            $('#drop-message-{{$upload_mutiple_id}}').hide()--}}

{{--            // container--}}
{{--            var imgView = document.createElement("li");--}}
{{--            imgView.className = "image-view";--}}
{{--            imgView.id = "drop_image__" + random_id;--}}

{{--            imagePreviewRegion.appendChild(imgView);--}}

{{--            // previewing image--}}
{{--            var img = document.createElement("img");--}}
{{--            img.className = "drop-blur"--}}
{{--            imgView.appendChild(img);--}}

{{--            // progress overlay--}}
{{--            var overlay = document.createElement("i");--}}
{{--            overlay.className = "overlay";--}}
{{--            imgView.appendChild(overlay);--}}

{{--            // spinner overlay--}}
{{--            var container_spinner = document.createElement("span");--}}
{{--            container_spinner.className = "container-spinner";--}}
{{--            var spinner = document.createElement("i");--}}
{{--            spinner.className = "fa fa-spin fa-spinner";--}}
{{--            container_spinner.appendChild(spinner);--}}
{{--            imgView.appendChild(container_spinner);--}}

{{--            // delete button--}}
{{--            var delete_button = document.createElement("i");--}}
{{--            // delete_button.onclick = deleteDropImage;--}}
{{--            // delete_button.setAttribute("onclick","deleteDropImage(this)");--}}
{{--            delete_button.setAttribute("id","btn_delete_image_{{$upload_mutiple_id}}");--}}
{{--            delete_button.className = "fa fa-minus-square-o delete-button";--}}
{{--            imgView.appendChild(delete_button);--}}

{{--            // read the image...--}}
{{--            var reader = new FileReader();--}}
{{--            reader.onload = function (e) {--}}
{{--                img.src = e.target.result;--}}
{{--            }--}}
{{--            reader.readAsDataURL(image);--}}

{{--            // create FormData--}}
{{--            var formData = new FormData();--}}
{{--            formData.append('image', image);--}}
{{--            formData.append('id', random_id);--}}
{{--            formData.append('table', '{{isset($table) ? $table : ''}}');--}}
{{--            formData.append('relate_id', '{{isset($relate_id) ? $relate_id : ''}}');--}}

{{--            callAjaxMultipart(--}}
{{--                "POST",--}}
{{--                url_upload_file_{{$upload_mutiple_id}},--}}
{{--                formData,--}}
{{--                (response) => {--}}
{{--                    container_spinner.remove()--}}
{{--                    overlay.remove();--}}
{{--                    img.classList.remove("drop-blur");--}}
{{--                    $("#image-preview-{{$upload_mutiple_id}}").sortable("refresh");--}}
{{--                    $('#image-preview-{{$upload_mutiple_id}}').trigger('sortupdate')--}}
{{--                },--}}
{{--                (error) => {--}}
{{--                    console.log(error)--}}
{{--                },--}}
{{--                (percent) => {--}}
{{--                    overlay.style.width = percent;--}}
{{--                },--}}
{{--                false,--}}
{{--                false,--}}
{{--                false,--}}
{{--            )--}}

{{--        }--}}


{{--    });--}}


{{--</script>--}}

@php

    if(isset($item)) {
        $images = $item->images;
        $relateImageTableId = $item->id;
        $relate_id = $item->id;
        $upload_mutiple_id = $relate_id;
    }else{
        $upload_mutiple_id = \App\Models\Helper::randomString();
    }

@endphp

<style>
    #drop-region-{{$upload_mutiple_id}}   {
        background-color: #fff;
        border-radius: 20px;
        box-shadow: 0 0 35px rgba(0, 0, 0, 0.05);
        padding: 20px;
        transition: .3s;
        min-height: 314px;
        position: relative;
        cursor: pointer;
        text-align: center;
    }

    .drop-region-active {
        filter: drop-shadow(0 0 0.15rem crimson);
    }

    #drop-region-{{$upload_mutiple_id}}:hover {
        box-shadow: 0 0 45px rgba(0, 0, 0, 0.1);
    }

    #image-preview-{{$upload_mutiple_id}}   {
        margin-top: 20px;
        display: flex;
        gap: 10px;
        overflow-x: auto;
    }

    #image-preview-{{$upload_mutiple_id}} .image-view {
        display: inline-block;
        position: relative;
        margin-right: 13px;
        margin-left: 13px;
    }

    #image-preview-{{$upload_mutiple_id}} .image-view img {
        max-width: 102px;
        max-height: 220px;
        box-shadow: rgb(0 0 0 / 20%) 0px 0px 1px inset;
        border-radius: 12px;
        border: 1px solid #dee2e6 !important;
    }

    #image-preview-{{$upload_mutiple_id}} .overlay {
        position: absolute;
        width: 100%;
        height: 100%;
        top: 0;
        right: 0;
        z-index: 2;
        background: rgba(255, 255, 255, 0.5);
    }

    #drop-message-{{$upload_mutiple_id}}   {
        position: absolute;
        transform: translate(-50%, -50%);
        left: 50%;
        bottom: 50%;
    }

    .delete-button {
        width: 0px;
        color: red;
        font-size: 25px;
        position: absolute;
        left: -5px;
        top: 0px;
    }

    .delete-button:hover {
        cursor: pointer;
    }

    .delete-button {
        visibility: hidden;
    }

    .image-view:hover .delete-button {
        visibility: visible;
    }

    .image-view {
        cursor: pointer;
    }

    .container-spinner {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }

    .drop-blur {
        filter: blur(2px);
        -webkit-filter: blur(2px);
    }

</style>

<div id="drop-region-{{$upload_mutiple_id}}" class="drop-region">
    <div id="drop-message-{{$upload_mutiple_id}}" class="drop-message">
        Kéo thả hình ảnh vào đây hoặc nhấp để chọn ảnh
    </div>
    <ul id="image-preview-{{$upload_mutiple_id}}" class="image-preview">
        @if(isset($images))
            @foreach($images as $image)
                <li class="image-view" id="drop_image__{{$image->id}}">
                    <img src="{{$image->image_path}}">
                    <i id="btn_delete_image_{{$upload_mutiple_id}}" class="fa-solid fa-xmark delete-button"></i>
                </li>
            @endforeach

        @endif
    </ul>
</div>
<input type="file" id="file-input-{{$upload_mutiple_id}}" style="display: none;" multiple accept="image/*">
{{--<script>--}}

{{--    $(document).ready(function () {--}}
{{--        @if(isset($images))--}}
{{--        @if(count($images))--}}
{{--        $('#drop-message-{{$upload_mutiple_id}}').hide()--}}
{{--        @endif--}}
{{--            @endif--}}

{{--        if (typeof url_upload_file_{{$upload_mutiple_id}} === 'undefined') {--}}
{{--            var url_upload_file_{{$upload_mutiple_id}} = "{{$post_api}}"--}}
{{--        } else {--}}
{{--            url_upload_file_{{$upload_mutiple_id}} = "{{$post_api}}"--}}
{{--        }--}}

{{--        if (typeof url_delete_file_{{$upload_mutiple_id}} === 'undefined') {--}}
{{--            var url_delete_file_{{$upload_mutiple_id}} = "{{$delete_api}}"--}}
{{--        } else {--}}
{{--            url_delete_file_{{$upload_mutiple_id}} = "{{$delete_api}}"--}}
{{--        }--}}

{{--        if (typeof url_sort_file_{{$upload_mutiple_id}} === 'undefined') {--}}
{{--            var url_sort_file_{{$upload_mutiple_id}} = "{{$sort_api}}"--}}
{{--        } else {--}}
{{--            url_sort_file_{{$upload_mutiple_id}} = "{{$sort_api}}"--}}
{{--        }--}}

{{--        if (typeof maximum_upload_file === 'undefined') {--}}
{{--            var maximum_upload_file = 10e6--}}
{{--        }--}}

{{--        if (typeof accept_upload_file === 'undefined') {--}}
{{--            var accept_upload_file = ['image/jpeg', 'image/png', 'image/gif', 'image/webp']--}}
{{--        }--}}





{{--        // Xử lý khi người dùng chọn tệp--}}
{{--        $('#file-input-{{$upload_mutiple_id}}').on('change', function () {--}}
{{--            var files = this.files;--}}
{{--            handleFiles(files);--}}
{{--        });--}}


{{--        $('#image-preview-{{$upload_mutiple_id}}').on('sortupdate', function () {--}}
{{--            const imageIdsArray = [];--}}
{{--            $('#image-preview-{{$upload_mutiple_id}} li').each(function (index) {--}}
{{--                var id = $(this).attr('id');--}}
{{--                if (isDefine(id)) {--}}
{{--                    const split_id = id.split("__");--}}
{{--                    imageIdsArray.push(split_id[1]);--}}
{{--                }--}}
{{--            });--}}

{{--            callAjax(--}}
{{--                "PUT",--}}
{{--                url_sort_file_{{$upload_mutiple_id}},--}}
{{--                {--}}
{{--                    ids: imageIdsArray--}}
{{--                },--}}
{{--                (response) => {--}}

{{--                },--}}
{{--                (error) => {--}}

{{--                },--}}
{{--                false,--}}
{{--            )--}}
{{--        });--}}

{{--        $("#image-preview-{{$upload_mutiple_id}}").sortable({--}}
{{--            update: function (event, ui) {--}}
{{--                // dropIndex = ui.item.index();--}}
{{--            },--}}
{{--        });--}}

{{--        var deleteButtonClicked = false;--}}
{{--        var // where files are dropped + file selector is opened--}}
{{--            dropRegion = document.getElementById("drop-region-{{$upload_mutiple_id}}"),--}}
{{--            // where images are previewed--}}
{{--            imagePreviewRegion = document.getElementById("image-preview-{{$upload_mutiple_id}}");--}}


{{--        // open file selector when clicked on the drop region--}}
{{--        var fakeInput = document.createElement("input");--}}
{{--        fakeInput.type = "file";--}}
{{--        fakeInput.accept = "image/*";--}}
{{--        fakeInput.multiple = true;--}}
{{--        // dropRegion.addEventListener('click', function () {--}}
{{--        //     fakeInput.click();--}}
{{--        // });--}}

{{--        fakeInput.addEventListener("change", function () {--}}
{{--            var files = fakeInput.files;--}}
{{--            handleFiles(files);--}}
{{--        });--}}


{{--        function preventDefault(e) {--}}
{{--            e.preventDefault();--}}
{{--            e.stopPropagation();--}}
{{--        }--}}

{{--        dropRegion.addEventListener('dragenter', preventDefault, false)--}}
{{--        dropRegion.addEventListener('dragleave', preventDefault, false)--}}
{{--        dropRegion.addEventListener('dragover', preventDefault, false)--}}
{{--        dropRegion.addEventListener('drop', preventDefault, false)--}}


{{--        function handleDrop(e) {--}}
{{--            var dt = e.dataTransfer,--}}
{{--                files = dt.files;--}}

{{--            if (files.length) {--}}
{{--                handleFiles(files);--}}
{{--            } else {--}}
{{--                // check for img--}}
{{--                var html = dt.getData('text/html'),--}}
{{--                    match = html && /\bsrc="?([^"\s]+)"?\s*/.exec(html),--}}
{{--                    url = match && match[1];--}}

{{--                if (url) {--}}
{{--                    uploadImageFromURL(url);--}}
{{--                    return;--}}
{{--                }--}}
{{--            }--}}

{{--            function uploadImageFromURL(url) {--}}
{{--                var img = new Image;--}}
{{--                var c = document.createElement("canvas");--}}
{{--                var ctx = c.getContext("2d");--}}

{{--                img.onload = function () {--}}
{{--                    c.width = this.naturalWidth;     // update canvas size to match image--}}
{{--                    c.height = this.naturalHeight;--}}
{{--                    ctx.drawImage(this, 0, 0);       // draw in image--}}
{{--                    c.toBlob(function (blob) {        // get content as PNG blob--}}
{{--                        // call our main function--}}
{{--                        handleFiles([blob]);--}}
{{--                    }, "image/png");--}}
{{--                };--}}
{{--                img.onerror = function () {--}}
{{--                    alert("Error in uploading");--}}
{{--                }--}}
{{--                img.crossOrigin = "";              // if from different origin--}}
{{--                img.src = url;--}}
{{--            }--}}

{{--        }--}}

{{--        dropRegion.addEventListener('drop', handleDrop, false);--}}


{{--        function handleFiles(files) {--}}
{{--            for (var i = 0, len = files.length; i < len; i++) {--}}
{{--                if (validateImage(files[i]))--}}
{{--                    previewAnduploadImage(files[i]);--}}
{{--            }--}}
{{--        }--}}

{{--        function validateImage(image) {--}}
{{--            // check the type--}}
{{--            var validTypes = accept_upload_file;--}}
{{--            if (validTypes.indexOf(image.type) === -1) {--}}
{{--                alert("Invalid File Type");--}}
{{--                return false;--}}
{{--            }--}}

{{--            // check the size--}}
{{--            var maxSizeInBytes = maximum_upload_file; // 10MB--}}
{{--            if (image.size > maxSizeInBytes) {--}}
{{--                alert("File too large");--}}
{{--                return false;--}}
{{--            }--}}

{{--            return true;--}}
{{--        }--}}

{{--        function deleteDropImage(event) {--}}
{{--            deleteButtonClicked = true;--}}
{{--            const removed_id = $(this).parent().attr('id').split('__')[1]--}}
{{--            $(this).parent().remove()--}}
{{--            if ($('#image-preview-{{$upload_mutiple_id}}').children().length == 0) {--}}
{{--                $('#drop-message-{{$upload_mutiple_id}}').show()--}}
{{--            }--}}
{{--            callAjax(--}}
{{--                "DELETE",--}}
{{--                url_delete_file_{{$upload_mutiple_id}},--}}
{{--                {--}}
{{--                    id: removed_id--}}
{{--                },--}}
{{--                (response) => {--}}
{{--                    console.log(response)--}}
{{--                    dropRegion.addEventListener('click',preventDefault,false)--}}
{{--                },--}}
{{--                (error) => {--}}

{{--                },--}}
{{--                false,--}}
{{--            )--}}
{{--        }--}}


{{--        $(document).on('click', '#btn_delete_image_{{$upload_mutiple_id}}', deleteDropImage);--}}

{{--        // Kích hoạt phần tử chọn tệp khi nhấp vào khu vực drop--}}
{{--        $('#drop-region-{{$upload_mutiple_id}}').on('click', function (e) {--}}
{{--            setTimeout(function() {--}}
{{--                if (deleteButtonClicked) {--}}
{{--                    deleteButtonClicked = false;--}}
{{--                    return;--}}
{{--                }--}}
{{--                $('#file-input-{{$upload_mutiple_id}}').click();--}}
{{--            }, 500);--}}
{{--        });--}}


{{--        function previewAnduploadImage(image) {--}}

{{--            let random_id = uuidv4()--}}

{{--            $('#drop-message-{{$upload_mutiple_id}}').hide()--}}

{{--            // container--}}
{{--            var imgView = document.createElement("li");--}}
{{--            imgView.className = "image-view";--}}
{{--            imgView.id = "drop_image__" + random_id;--}}

{{--            imagePreviewRegion.appendChild(imgView);--}}

{{--            // previewing image--}}
{{--            var img = document.createElement("img");--}}
{{--            img.className = "drop-blur"--}}
{{--            imgView.appendChild(img);--}}

{{--            // progress overlay--}}
{{--            var overlay = document.createElement("i");--}}
{{--            overlay.className = "overlay";--}}
{{--            imgView.appendChild(overlay);--}}

{{--            // spinner overlay--}}
{{--            var container_spinner = document.createElement("span");--}}
{{--            container_spinner.className = "container-spinner";--}}
{{--            var spinner = document.createElement("i");--}}
{{--            spinner.className = "fa fa-spin fa-spinner";--}}
{{--            container_spinner.appendChild(spinner);--}}
{{--            imgView.appendChild(container_spinner);--}}

{{--            // delete button--}}
{{--            var delete_button = document.createElement("i");--}}
{{--            delete_button.setAttribute("id", "btn_delete_image_{{$upload_mutiple_id}}");--}}
{{--            delete_button.className = "fa fa-minus-square-o delete-button";--}}
{{--            imgView.appendChild(delete_button);--}}

{{--            // read the image...--}}
{{--            var reader = new FileReader();--}}
{{--            reader.onload = function (e) {--}}
{{--                img.src = e.target.result;--}}
{{--            }--}}
{{--            reader.readAsDataURL(image);--}}

{{--            // create FormData--}}
{{--            var formData = new FormData();--}}
{{--            formData.append('image', image);--}}
{{--            formData.append('id', random_id);--}}
{{--            formData.append('table', '{{isset($table) ? $table : ''}}');--}}
{{--            formData.append('relate_id', '{{isset($relate_id) ? $relate_id : ''}}');--}}

{{--            callAjaxMultipart(--}}
{{--                "POST",--}}
{{--                url_upload_file_{{$upload_mutiple_id}},--}}
{{--                formData,--}}
{{--                (response) => {--}}
{{--                    container_spinner.remove()--}}
{{--                    overlay.remove();--}}
{{--                    img.classList.remove("drop-blur");--}}
{{--                    $("#image-preview-{{$upload_mutiple_id}}").sortable("refresh");--}}
{{--                    $('#image-preview-{{$upload_mutiple_id}}').trigger('sortupdate')--}}
{{--                },--}}
{{--                (error) => {--}}
{{--                    console.log(error)--}}
{{--                },--}}
{{--                (percent) => {--}}
{{--                    overlay.style.width = percent;--}}
{{--                },--}}
{{--                false,--}}
{{--                false,--}}
{{--                false,--}}
{{--            )--}}

{{--        }--}}
{{--    });--}}
{{--</script>--}}


<script>
    $(document).ready(function () {

        var deleteButtonClicked = false;
        @if(isset($images))
        @if(count($images))
        $('#drop-message-{{$upload_mutiple_id}}').hide()
        @endif
            @endif

        if (typeof url_upload_file_{{$upload_mutiple_id}} === 'undefined') {
            var url_upload_file_{{$upload_mutiple_id}} = "{{$post_api}}"
        }else{
            url_upload_file_{{$upload_mutiple_id}} = "{{$post_api}}"
        }

        if (typeof url_delete_file_{{$upload_mutiple_id}} === 'undefined') {
            var url_delete_file_{{$upload_mutiple_id}} = "{{$delete_api}}"
        }else{
            url_delete_file_{{$upload_mutiple_id}} = "{{$delete_api}}"
        }

        if (typeof url_sort_file_{{$upload_mutiple_id}} === 'undefined') {
            var url_sort_file_{{$upload_mutiple_id}} = "{{$sort_api}}"
        }else{
            url_sort_file_{{$upload_mutiple_id}} = "{{$sort_api}}"
        }

        if (typeof maximum_upload_file === 'undefined') {
            var maximum_upload_file = 10e6
        }

        if (typeof accept_upload_file === 'undefined') {
            var accept_upload_file = ['image/jpeg', 'image/png', 'image/gif', 'image/webp']
        }

        $('#drop-region-{{$upload_mutiple_id}}').on('click', function (e) {
            setTimeout(function() {

                console.log(deleteButtonClicked)
                if (deleteButtonClicked) {
                    deleteButtonClicked = false;
                    return;
                }
                $('#file-input-{{$upload_mutiple_id}}').click();
            }, 500);
        });

        $('#file-input-{{$upload_mutiple_id}}').on('change', function () {
            var files = this.files;
            handleFiles(files);
        });



        $('#image-preview-{{$upload_mutiple_id}}').on('sortupdate', function () {
            const imageIdsArray = [];
            $('#image-preview-{{$upload_mutiple_id}} li').each(function (index) {
                var id = $(this).attr('id');
                if (isDefine(id)) {
                    const split_id = id.split("__");
                    imageIdsArray.push(split_id[1]);
                }
            });

            callAjax(
                "PUT",
                url_sort_file_{{$upload_mutiple_id}},
                {
                    ids: imageIdsArray
                },
                (response) => {

                },
                (error) => {

                },
                false,
            )
        });

        $("#image-preview-{{$upload_mutiple_id}}").sortable({
            update: function (event, ui) {
                // dropIndex = ui.item.index();
            },
        });


        var // where files are dropped + file selector is opened
            dropRegion = document.getElementById("drop-region-{{$upload_mutiple_id}}"),
            // where images are previewed
            imagePreviewRegion = document.getElementById("image-preview-{{$upload_mutiple_id}}");


        // open file selector when clicked on the drop region
        var fakeInput = document.createElement("input");
        fakeInput.type = "file";
        fakeInput.accept = "image/*";
        fakeInput.multiple = true;
        // dropRegion.addEventListener('click', function () {
        //     fakeInput.click();
        // });

        fakeInput.addEventListener("change", function () {
            var files = fakeInput.files;
            handleFiles(files);
        });


        function preventDefault(e) {
            e.preventDefault();
            e.stopPropagation();
        }

        dropRegion.addEventListener('dragenter', preventDefault, false)
        dropRegion.addEventListener('dragleave', preventDefault, false)
        dropRegion.addEventListener('dragover', preventDefault, false)
        dropRegion.addEventListener('drop', preventDefault, false)


        function handleDrop(e) {
            var dt = e.dataTransfer,
                files = dt.files;

            if (files.length) {
                handleFiles(files);
            } else {
                // check for img
                var html = dt.getData('text/html'),
                    match = html && /\bsrc="?([^"\s]+)"?\s*/.exec(html),
                    url = match && match[1];

                if (url) {
                    uploadImageFromURL(url);
                    return;
                }
            }

            function uploadImageFromURL(url) {
                var img = new Image;
                var c = document.createElement("canvas");
                var ctx = c.getContext("2d");

                img.onload = function () {
                    c.width = this.naturalWidth;     // update canvas size to match image
                    c.height = this.naturalHeight;
                    ctx.drawImage(this, 0, 0);       // draw in image
                    c.toBlob(function (blob) {        // get content as PNG blob
                        // call our main function
                        handleFiles([blob]);
                    }, "image/png");
                };
                img.onerror = function () {
                    alert("Error in uploading");
                }
                img.crossOrigin = "";              // if from different origin
                img.src = url;
            }

        }

        dropRegion.addEventListener('drop', handleDrop, false);


        function handleFiles(files) {
            for (var i = 0, len = files.length; i < len; i++) {
                if (validateImage(files[i]))
                    previewAnduploadImage(files[i]);
            }
        }

        function validateImage(image) {
            // check the type
            var validTypes = accept_upload_file;
            if (validTypes.indexOf(image.type) === -1) {
                alert("Invalid File Type");
                return false;
            }

            // check the size
            var maxSizeInBytes = maximum_upload_file; // 10MB
            if (image.size > maxSizeInBytes) {
                alert("File too large");
                return false;
            }

            return true;
        }

        function deleteDropImage(event){
            deleteButtonClicked = true
            const removed_id = $(this).parent().attr('id').split('__')[1]
            $(this).parent().remove()
            if ($('#image-preview-{{$upload_mutiple_id}}').children().length == 0) {
                $('#drop-message-{{$upload_mutiple_id}}').show()
            }
            callAjax(
                "DELETE",
                url_delete_file_{{$upload_mutiple_id}},
                {
                    id: removed_id
                },
                (response) => {
                    console.log(response)
                },
                (error) => {

                },
                false,
            )
        }

        $(document).on('click', '#btn_delete_image_{{$upload_mutiple_id}}', deleteDropImage);

        function previewAnduploadImage(image) {

            let random_id = uuidv4()

            $('#drop-message-{{$upload_mutiple_id}}').hide()

            // container
            var imgView = document.createElement("li");
            imgView.className = "image-view";
            imgView.id = "drop_image__" + random_id;

            imagePreviewRegion.appendChild(imgView);

            // previewing image
            var img = document.createElement("img");
            img.className = "drop-blur"
            imgView.appendChild(img);

            // progress overlay
            var overlay = document.createElement("i");
            overlay.className = "overlay";
            imgView.appendChild(overlay);

            // spinner overlay
            var container_spinner = document.createElement("span");
            container_spinner.className = "container-spinner";
            var spinner = document.createElement("i");
            spinner.className = "fa fa-spin fa-spinner";
            container_spinner.appendChild(spinner);
            imgView.appendChild(container_spinner);

            // delete button
            var delete_button = document.createElement("i");
            delete_button.setAttribute("id","btn_delete_image_{{$upload_mutiple_id}}");
            delete_button.className = "fa-solid fa-xmark delete-button";
            console.log(delete_button)
            imgView.appendChild(delete_button);

            // read the image...
            var reader = new FileReader();
            reader.onload = function (e) {
                img.src = e.target.result;
            }
            reader.readAsDataURL(image);

            // create FormData
            var formData = new FormData();
            formData.append('image', image);
            formData.append('id', random_id);
            formData.append('table', '{{isset($table) ? $table : ''}}');
            formData.append('relate_id', '{{isset($relate_id) ? $relate_id : ''}}');

            callAjaxMultipart(
                "POST",
                url_upload_file_{{$upload_mutiple_id}},
                formData,
                (response) => {
                    container_spinner.remove()
                    overlay.remove();
                    img.classList.remove("drop-blur");
                    $("#image-preview-{{$upload_mutiple_id}}").sortable("refresh");
                    $('#image-preview-{{$upload_mutiple_id}}').trigger('sortupdate')
                },
                (error) => {
                    console.log(error)
                },
                (percent) => {
                    overlay.style.width = percent;
                },
                false,
                false,
                false,
            )

        }
    });
</script>

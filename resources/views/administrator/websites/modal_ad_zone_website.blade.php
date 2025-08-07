<style>
    .bd-clipboard {
        position: relative;
        display: block;
        float: right;
    }
    .icon_copy {
        position: absolute;
        top: 15px;
        right: 4%;
        font-size: 20px;
        cursor: pointer;
    }
</style>

<div>
    <h2 class="modal-title">{{ optional($zoneWebsite->website)->name }}</h2>

    <div class="getcode__info">
        <div class="getcode__info--name">
            <input type="text" class="form-control" value="{{ $zoneWebsite->name }}" disabled>
        </div>
        <div class="getcode__info--code mt-3">
            <div class="alert alert-primary" role="alert">
                Please add our script into the <code>&lt;head&gt;</code> tag of your website
            </div>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="Normal" role="tabpanel"
                     aria-labelledby="Normal-tab">
                    <div class="row mt-3">
                        <div class="bd-clipboard">
                            <i class="ri-file-copy-line icon_copy" onclick="copyCode('textNormalG')"></i>
                        </div>
                        <div class="col-12 highlight">
                                        <textarea style="padding-top: 30px" class="form-control" id="textNormalG" rows="8"
                                                  placeholder="Code ..." readonly>
                                            {!! $zoneWebsite->code !!}
                                            </textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function copyCode(textAreaId) {
        var copyText = document.getElementById(textAreaId);
        // Select the text field
        copyText.select();
        copyText.setSelectionRange(0, 99999); // For mobile devices
        try {
            // Copy the text inside the text field
            var successful = document.execCommand('copy');
            var message = successful ? 'Copied to clipboard!' : 'Copy failed!';
            console.log(message);
        } catch (err) {
            console.error('Copy failed:', err);
        }
    }
    //active tab
    function activeTab(obj) {
        $('.getcode__info--code ul li a').removeClass('active');
        $(obj).addClass('active');
        var id = $(obj).attr('href');
        $('.tab-item').hide();
        $(id).show();
    }
    $('.getcode__info--code ul li a').click(function() {
        activeTab(this);
        return false;
    });
    activeTab($('.getcode__info--code ul li:first-child a'));

    function myFunction(id) {
        // Get the text field
        var copyText = document.getElementById("text" + id);
        console.log(22, id, copyText)
        // Select the text field
        copyText.select();
        copyText.setSelectionRange(0, 99999); // For mobile devices
        // Copy the text inside the text field
        navigator.clipboard.writeText(copyText.value);
    }
</script>

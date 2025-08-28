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
    <div class="getcode__info">
        <div class="getcode__info--code mt-3">
            <div class="alert alert-primary" role="alert">
                {!! optional(optional($zoneWebsite->zoneDimension)->zoneDimensionPosition)->description !!}
            </div>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="Normal" role="tabpanel"
                     aria-labelledby="Normal-tab">
                    <div class="row mt-3">
                        <div class="bd-clipboard">
                        </div>
                        <div class="col-12 highlight">
                            <textarea class="form-control" id="textNormalG" rows="8" placeholder="Code ..." readonly>{!! $zoneWebsite->gam_code ?? $zoneWebsite->code_normal !!}</textarea>
                        </div>
                        <div class="text-center">
                            <button class="btn btn-outline-primary" onclick="copyCode('textNormalG')">
                                Click here to copy <i class="fa-solid fa-copy" ></i>
                            </button>
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
            showToastSuccess("Copied, Now add your <head> website")
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
        // Select the text field
        copyText.select();
        copyText.setSelectionRange(0, 99999); // For mobile devices
        // Copy the text inside the text field
        navigator.clipboard.writeText(copyText.value);
    }

    @if(isset($hideAllPreModal))
        hideAllModal();
    @endif

</script>

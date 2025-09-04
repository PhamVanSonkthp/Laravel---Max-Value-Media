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
            <div class="alert alert-warning" role="alert">
                {!! optional(optional($zoneWebsite->zoneDimension)->zoneDimensionPosition)->description !!}
            </div>

            <div class="row mt-3">
                <div class="bd-clipboard">
                </div>
                <div class="col-12 highlight">
                    <textarea id="textarea_code" class="form-control p-3" rows="8" placeholder="Code ..." readonly>{!! $zoneWebsite->gam_code ?? $zoneWebsite->code_normal !!}</textarea>

                    <div class="text-center mt-3">
                        <button class="btn btn-primary" onclick="onVerifyZone({{$zoneWebsite->id}})">
                            VERIFY INTEGRATION
                        </button>

                        <button class="btn btn-outline-primary" onclick="copyCode('textarea_code', '{!! optional(optional($zoneWebsite->zoneDimension)->zoneDimensionPosition)->description !!}')">
                            Click here to copy <i class="fa-solid fa-copy" ></i>
                        </button>

                    </div>

                    @if(optional($zoneWebsite->website)->status_website_id == 5)
                        <div style="display:none;" id="modal_ad_zone_website_label_not_verified" class="alert alert-danger" role="alert">Our script has not been integrated</div>
                        <div style="display:none;" id="modal_ad_zone_website_label_verified" class="alert alert-success mt-3" role="alert">After you complete these steps, track status of your website. Your website will be reviewed within 24 hours (72 if the review falls on weekends).</div>
                    @elseif(optional($zoneWebsite->website)->status_website_id == 1)
                        <div class="alert alert-success mt-3" role="alert">After you complete these steps, track status of your website. Your website will be reviewed within 24 hours (72 if the review falls on weekends).</div>
                    @endif

                </div>

            </div>

        </div>
    </div>
</div>

<script>
    function copyCode(textAreaId, description) {
        var copyText = document.getElementById(textAreaId);
        // Select the text field
        copyText.select();
        copyText.setSelectionRange(0, 99999); // For mobile devices
        try {
            // Copy the text inside the text field
            var successful = document.execCommand('copy');
            var message = successful ? 'Copied to clipboard!' : 'Copy failed!';
            showToastSuccess("Copied, Now " + description)
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

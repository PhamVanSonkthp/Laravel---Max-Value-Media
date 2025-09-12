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
    <h2 class="modal-title">{{ $item->name }}</h2>

    <div class="getcode__info">

        <div class="getcode__info--code mt-3">
            <div class="alert alert-warning" role="alert">
                Please update the ads.txt on your website in order to keep it active and continue monetizing
            </div>

            <div class="row mt-3">
                <div class="bd-clipboard">
                </div>
                <div class="col-12 highlight">
                    @if($item->ads_status_website_id == 1)
                        <textarea id="textarea_code_ads" class="form-control p-3" rows="8" placeholder="Code ..."
                                  readonly>@foreach($ads as $ad){{$ad."\r"}}@endforeach
                        </textarea>
                    @else
                        <textarea id="textarea_code_ads" class="form-control p-3" rows="8" placeholder="Code ..."
                                  readonly>{!! $item->ads_compared !!}</textarea>
                    @endif

                    <div class="text-center mt-3">

                        <button class="btn btn-outline-primary" onclick="copyCode('textarea_code_ads')">
                            Click here to copy <i class="fa-solid fa-copy"></i>
                        </button>

                        <button class="btn btn-outline-primary" onclick="downloadAds('textarea_code_ads')">
                            Download Ads.txt <i class="fa-solid fa-download"></i>
                        </button>

                        @if($item->ads_status_website_id != 2)
                        <button class="btn btn-primary" onclick="onCheckAds({{$item->id}})">
                            Check Ads
                        </button>
                        @endif
                    </div>

                        <div id="modal_ads_website_alert_accept" style="display:none;" class="alert alert-success mt-3" role="alert">ACCEPT</div>
                        <div id="modal_ads_website_alert_empty" style="display:none;" class="alert alert-danger mt-3" role="alert">EMPTY</div>
                        <div id="modal_ads_website_alert_not_update" style="display:none;" class="alert alert-warning mt-3" role="alert">NOT_UPDATE</div>

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
            showToastSuccess("Copied")
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

    $('.getcode__info--code ul li a').click(function () {
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

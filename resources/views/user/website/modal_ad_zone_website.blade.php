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
                {!! optional(optional($zoneWebsite->zoneDimension)->zoneDimensionPosition)->description !!}
            </div>

            <div class="row mt-3">
                <div class="bd-clipboard">
                </div>
                <div class="col-12 highlight">
                    <textarea class="form-control" rows="8" placeholder="Code ..." readonly>{!! $zoneWebsite->gam_code ?? $zoneWebsite->code_normal !!}</textarea>

                    @if(optional($zoneWebsite->website)->status_website_id == 5)
                        <div class="text-center mt-2 mb-2">
                            <button class="btn btn-primary" onclick="onVerifyZone({{$zoneWebsite->id}})">
                                VERIFY INTEGRATION
                            </button>
                        </div>
                        <div style="display:none;" id="modal_ad_zone_website_label_not_verified" class="alert alert-danger" role="alert">Our script has not been integrated</div>
                        <div style="display:none;" id="modal_ad_zone_website_label_verified" class="alert alert-success" role="alert">After you complete these steps, track status of your website. Your website will be reviewed within 24 hours (72 if the review falls on weekends).</div>
                    @elseif(optional($zoneWebsite->website)->status_website_id == 1)
                        <div class="alert alert-success" role="alert">After you complete these steps, track status of your website. Your website will be reviewed within 24 hours (72 if the review falls on weekends).</div>
                    @endif

                </div>

            </div>

        </div>
    </div>
</div>

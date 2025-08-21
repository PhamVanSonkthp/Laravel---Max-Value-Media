<div class="accordion accordion-faq" id="accordionExample">
    <div class="accordion-item create-website">
        <h2 class="accordion-header" id="headingOne">
            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                    data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                <span class="site-verified"><i class="ri-checkbox-circle-line"></i></span><b> Add
                    website </b> &nbsp;<span class="website-name"></span>
            </button>
        </h2>
        <hr>
        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
             data-bs-parent="#accordionExample">
            <div class="accordion-body">
                <div>
                    @include('administrator.components.require_input_ajax_checking', ['id' => 'input_url_create','label' => 'URL' , 'name' => 'url', 'placeholder' => 'example.com', 'addon' => '.com/.net,...','value' => '', 'no_margin'=>true])
                </div>

                <div class="mt-3 text-end">
                    <button style="display:none;" id="button_create_website" class="btn btn-success" onclick="onStoreWebsite()">
                        Add now
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="accordion-item complete pointer-events-none">
        <h2 class="accordion-header" id="heading-verify-site">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                <span class="site-complete"><i class="ri-checkbox-circle-line"></i></span> Verify
                site
                ownership
            </button>
        </h2>
        <hr>
        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="heading-verify-site"
             data-bs-parent="#accordionExample">
            <div class="accordion-body pt-0">
                <div class="row">
                    <center>No data !</center>
                </div>
            </div>
        </div>
    </div>

    <div class="accordion-item link-ads pointer-events-none">
        <h2 class="accordion-header" id="heading-complete">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                <span class="site-complete"><i class="ri-checkbox-circle-line"></i></span> Verify ads.txt
            </button>
        </h2>
        <hr>
        <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="heading-complete"
             data-bs-parent="#accordionExample">
            <div class="accordion-body pt-0">
                <div class="row">
                    <div class="col text-center">
                        <div class="alert alert-info mb-0 mt-1" role="alert">
                            <i class="ri-information-line m-0" style="font-size: 18px"></i>
                            Update the ads.txt on your sites in order to keep them active and continue monetizing by clicking <a href="">
                                <span class="badge bg-success">Ads.txt</span>
                            </a>
                        </div>
                        <div class="row">
                            <div class="col mt-3 text-center">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {


    });


</script>

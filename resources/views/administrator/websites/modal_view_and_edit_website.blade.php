<div>
    <div>
        <strong>
            Url
        </strong>
    </div>
    <div>
        <a href="{{$item->url}}">{{$item->url}}</a>
    </div>

    @include('administrator.components.require_select2', ['label' => 'Publisher','name' => 'user_id', 'select2Items' => $users, 'modal_id' => $modalID])

    <div>
        <strong>
            First report:
        </strong>
    </div>

    <div class="card">
        <div class="card-header">
            Access source
        </div>
        <div class="card-body">

        </div>
    </div>

    <div class="card">
        <div class="card-header">
            Traffic statistics
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-6">
                    <label class="fs-sm fw-medium mb-1">Valid hits</label>
                    <h3 class="card-value mb-2">20
                        <small>0.72
                            %</small></h3>
                    <div class="progress ht-5 mb-0">
                        <div class="progress-bar bg-success" style="width: 1%;" role="progressbar" aria-valuenow="1" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div><!-- col -->
                <div class="col-6">
                    <label class="fs-sm fw-medium mb-1">Proxy hits</label>
                    <h3 class="card-value mb-2">100
                        <small>3.62
                            %</small></h3>
                    <div class="progress ht-5 mb-0">
                        <div class="progress-bar bg-warning" style="width: 4%;" role="progressbar" aria-valuenow="3.62" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div><!-- col -->
            </div>
            <div class="row mt-3">
                <div class="col-6">
                    <label class="fs-sm fw-medium mb-1">Junk hits</label>
                    <h3 class="card-value mb-2">0
                        <small>0
                            %</small></h3>
                    <div class="progress ht-5 mb-0">
                        <div class="progress-bar bg-primary" style="width: 0%;" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div><!-- col -->
                <div class="col-6">
                    <label class="fs-sm fw-medium mb-1">Bot hits</label>
                    <h3 class="card-value mb-2">2,640
                        <small>95.65
                            %</small></h3>
                    <div class="progress ht-5 mb-0">
                        <div class="progress-bar bg-danger" style="width: 96%;" role="progressbar" aria-valuenow="95.65" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div><!-- col -->
            </div>
        </div>
    </div>

</div>

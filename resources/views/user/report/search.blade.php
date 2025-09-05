
<style>


    /* ---- BEAUTIFUL SELECT2 MULTI ---- */
    .select2-container--default .select2-selection--multiple {
        min-height: 46px;
        border-radius: 10px;
        border: 1px solid #e6e9ef !important;
        padding: 6px 8px;
        background: #fff;
        box-shadow: 0 2px 6px rgba(16,24,40,0.03);
    }
    .select2-container--default .select2-selection--multiple .select2-selection__choice {
        background: #f3efff !important;
        border: 1px solid rgba(124,58,237,0.1) !important;
        color: #32145a !important;
        padding: 3px 8px;
        margin: 4px 6px 4px 0;
        border-radius: 999px;
        font-size: 13px;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }
    .select2-selection__choice__remove {
        color: #6b21a8 !important;
        margin-right: 4px;
        font-weight: bold;
        cursor: pointer;
    }
    .select2-selection__choice__remove:hover { opacity: 0.75; }

    .select2-container .select2-search--dropdown .select2-search__field {
        height: 36px;
        padding: 6px 10px;
        border-radius: 8px;
        border: 1px solid #e6e9ef;
        margin: 8px;
    }
    .select2-container--default .select2-results__option--highlighted[aria-selected] {
        background: rgba(124,58,237,0.08);
        color: #3b185f;
    }
    /* ---- DATE RANGE INPUT ---- */
    .daterange-input {
        height: 46px;
        border-radius: 10px;
        border: 1px solid #e6e9ef;
        box-shadow: 0 2px 6px rgba(16,24,40,0.03);
        padding-left: 14px;
        background-color: #fff;
    }

    .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
        border-right: none;
    }

    .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
        right: -4px !important;
        left: auto !important;
    }
</style>

<div class="form-row" style="align-items: end;">
    <div class="form-group col-md-3">
        <label for="select_websites_search">Websites</label>
        <select id="select_websites_search" multiple="multiple" style="width:100%;opacity:0;" >
            @foreach($websites as $website)
            <option value="{{$website->id}}" {{in_array($website->id,$searchWebsiteIDs) ? 'selected' : ''}}>{{$website->name}}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group col-md-3">
        <label for="select_zone_websites_search">Zones</label>
        <select id="select_zone_websites_search" multiple="multiple" style="width:100%;opacity:0;" >
            @foreach($zones as $zone)
                <option value="{{$zone->id}}" {{in_array($zone->id,$searchZoneWebsiteIDs) ? 'selected' : ''}}>{{$zone->name}}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group col-md-3">
        <label for="daterange">Date Range</label>
        <input type="text" id="daterange" class="form-control daterange-input" />

    </div>

    <div class="form-group col-md-2">
        <button class="btn btn-primary btn-block" onclick="onSearch()">Apply Filter</button>
    </div>

</div>

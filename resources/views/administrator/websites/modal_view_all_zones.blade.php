<div class="table-responsive product-table">
    <table class="table table-hover table-bordered">
        <thead>
        <tr>
            <th>
                <div>
                    ID
                </div>
            </th>
            <th>
                <div>
                    Name
                </div>
            </th>
            <th>
                <div>
                    Status
                </div>
            </th>
            <th>
                <div>
                    Craeted at
                </div>
            </th>
            <th>
                <div>
                    Action
                </div>
            </th>

        </tr>
        </thead>
        <tbody class="" id="modal_view_all_zones_body_container_item">
        @foreach($items as $index => $item)

            @include('administrator.websites.modal_zone_item_zone', ['item' => $item])

        @endforeach

        </tbody>

    </table>
</div>

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
        <tbody class="" id="body_container_item">
        @foreach($items as $index => $item)
            <tr>
                <td>
                    {{$item->id}}
                </td>
                <td>
                    {{$item->name}}
                </td>
                <td>
                    <div>
                        @include('administrator.components.label', ['style' => 'display: inline-block;
                margin-top: 6px;
                padding: 2px 8px;
                border-radius: 999px;
                font-size: 11px;
                font-weight: 600;
                color: white !important;background: '.optional($item->zoneStatus)->background_color.';', 'label' => optional($item->zoneStatus)->name])
                    </div>
                </td>
                <td>{{\App\Models\Formatter::getDateTime($item->created_at)}}</td>
                <td>
                    <!-- Code button -->
                    <button onclick="onGetAdCodeZone({{$item->id}})" class="btn btn-code" title="Get Code">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M16 18l6-6-6-6M8 6l-6 6 6 6"/>
                        </svg>
                    </button>
                    <!-- Config button -->
                    <button onclick="onDetailZone({{$item->id}})" class="btn btn-config" title="Config">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <circle cx="12" cy="12" r="3"/>
                            <path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 1 1-2.83 2.83l-.06-.06A1.65 1.65 0 0 0 15 19.4a1.65 1.65 0 0 0-1 .6 1.65 1.65 0 0 0-.33 1.82 2 2 0 1 1-2.83-2.83 1.65 1.65 0 0 0-1-.6 1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 1 1-2.83-2.83l.06-.06A1.65 1.65 0 0 0 4.6 15a1.65 1.65 0 0 0-.6-1 1.65 1.65 0 0 0-1.82-.33 2 2 0 1 1 2.83-2.83 1.65 1.65 0 0 0 1-.6 1.65 1.65 0 0 0 .33-1.82A2 2 0 1 1 9.17 4.6a1.65 1.65 0 0 0 1 .6 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 1 1 2.83 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82 1.65 1.65 0 0 0 .6 1 1.65 1.65 0 0 0 1.82.33 2 2 0 1 1 2.83 2.83 1.65 1.65 0 0 0-.6 1z"/>
                        </svg>
                    </button>
                </td>
            </tr>

        @endforeach

        </tbody>

    </table>
</div>

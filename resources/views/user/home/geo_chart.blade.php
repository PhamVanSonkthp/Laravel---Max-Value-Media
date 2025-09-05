<div>
    <div class="row mt-2">
        <!-- Left: Country list -->
        <div class="col-md-4">
            <div>
                <div class="header p-0">
                    <h2><strong>Geo</strong></h2>
                </div>
                <div>
                    <ul class="list-group list-group-flush">
                        @foreach($trafficByContries as $index => $trafficByContry)
                            <li class="list-group-item p-0 mt-2">
                                <div class="d-flex justify-content-between mb-1">
                                    <span class="small">{{optional($trafficByContry->national)->name}}</span><span class="text-muted small fw-semibold">{{\App\Models\Formatter::formatNumber($trafficByContry['requests'] / max(1, array_sum(array_column($trafficByContries, "requests"))) * 100, 2)}}%</span>
                                </div>
                                <div class="progress" style="height: 5px;">
                                    <div class="progress-bar" style="width:{{\App\Models\Formatter::formatNumber($trafficByContry['requests'] / max(1, array_sum(array_column($trafficByContries, "requests"))) * 100, 2)}}%; background: {{$jsonColorMaps[$index]}}"></div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

        <!-- Right: Geo chart -->
        <div class="col-md-8">
            <div id="geo_chart"></div>
        </div>
    </div>
</div>

<script>
    google.charts.load("current", { packages:["geochart"] });
    google.charts.setOnLoadCallback(drawRegionsMap);

    function drawRegionsMap() {
        // Assign unique values (1..N) per country
        const data = new  google.visualization.DataTable();
        data.addColumn('string', 'Country');
        data.addColumn('number', 'Value');  // must be numeric for coloring
        data.addColumn({type:'string', role:'tooltip'}); // extra info text

        data.addRows(@json($jsonDrawMaps));

        const options = {
            colorAxis: {
                colors: @json($jsonColorMaps)
            },
            backgroundColor: '#f4f6f9',
            datalessRegionColor: '#e9ecef',
            defaultColor: '#f5f5f5',
            legend: 'none'
        };

        const chart = new google.visualization.GeoChart(document.getElementById('geo_chart'));
        chart.draw(data, options);
    }
</script>

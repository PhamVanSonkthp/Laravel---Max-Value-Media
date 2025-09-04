<div>
    <div class="row">
        <!-- Left: Country list -->
        <div class="col-md-4">
            <div class="header p-0">
                <h2><strong>Devices</strong></h2>
            </div>

            <ul class="chart-legend mt-2">
                @foreach($trafficByDevices as $index => $trafficByDevice)
                    <li><span class="legend-color" style="color:{{$jsonColorChartDevices[$index]}}">{{optional($trafficByDevice->device)->name}} ({{\App\Models\Formatter::formatNumber($trafficByDevice['requests'] / max(1, array_sum(array_column($trafficByDevices, "requests"))) * 100, 2)}}%)</span></li>
                @endforeach
            </ul>
        </div>

        <!-- Right: chart -->
        <div class="col-md-8">
            <div id="donut_chart"></div>
        </div>
    </div>
</div>

<script>
    google.charts.load("current", { packages: ["corechart"] });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        const data = google.visualization.arrayToDataTable(@json($jsonDrawChartDevices));

        const options = {
            pieHole: 0.55,                 // donut
            legend: "none",                // hide default legend
            pieSliceText: "percentage",
            chartArea: { width: "100%", height: "90%" },
            colors: @json($jsonColorChartDevices),
            backgroundColor: "transparent"
        };

        const chart = new google.visualization.PieChart(document.getElementById("donut_chart"));
        chart.draw(data, options);
    }

    window.addEventListener("resize", () => { if (google.visualization) drawChart(); });
</script>

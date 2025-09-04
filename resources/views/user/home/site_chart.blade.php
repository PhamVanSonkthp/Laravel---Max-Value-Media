<style>

    #siteChart-canvas {
        width: 100% !important;
    }
    #siteChart-customRange {
        display: none;
        max-width: 230px;
    }
    .dropdown-menu li button {
        width: 100%;
        text-align: left;
    }
</style>

<div class="siteChart-container">
    <!-- Chart -->
    <canvas id="siteChart-canvas"></canvas>
</div>

<script>
    // Example Data
    const siteChartData = @json($siteCharts);
    const siteChartPalette = [
        "#e6194b", // red
        "#3cb44b", // green
        "#4363d8", // blue
        "#f58231", // orange
        "#911eb4", // purple
        "#46f0f0", // cyan
        "#f032e6", // magenta
        "#bcf60c", // lime
        "#fabebe", // pink
        "#008080"  // teal
    ];


    function siteChartDatasets(data, sites) {
        return sites.map((site, index)=> ({
            label: site,
            data: data.map(item => item[site] ?? null),
            borderColor: siteChartPalette[index % siteChartPalette.length],
            borderWidth: 2,
            tension: 0.3,
            fill: false,
            spanGaps: true
        })).filter(ds => ds.data.some(v => v !== null));
    }

    function siteChartFilterData(rangeType, start = null, end = null) {
        let filtered = siteChartData;
        const today = new Date("{{\Carbon\Carbon::today()->toDateString()}}");

        if (rangeType === "week") {
            const weekAgo = new Date(today);
            weekAgo.setDate(today.getDate() - 6);
            filtered = siteChartData.filter(item => {
                const d = new Date(item.period);
                return d >= weekAgo && d <= today;
            });
        } else if (rangeType === "month") {
            const month = today.getMonth();
            filtered = siteChartData.filter(item => new Date(item.period).getMonth() === month);
        } else if (rangeType === "custom" && start && end) {
            filtered = siteChartData.filter(item => {
                const d = new Date(item.period);
                return d >= new Date(start) && d <= new Date(end);
            });
        }
        return filtered;
    }

    // Init Chart
    const ctx = document.getElementById("siteChart-canvas");
    const siteChart = new Chart(ctx, {
        type: "line",
        data: {
            labels: siteChartData.map(i => i.period),
            datasets: siteChartDatasets(siteChartData, Object.keys(siteChartData[0]).filter(k => k !== "period"))
        },
        options: {
            responsive: true,
            interaction: { mode: 'nearest', intersect: false },
            plugins: {
                legend: { position: "bottom" },
                title: { display: true, text: "Traffic by Site" },
                tooltip: { enabled: ctx => ctx.chart.data.datasets.length > 0 }
            },
            scales: {
                y: { beginAtZero: true, title: { display: true, text: "Visits" } },
                x: { title: { display: true, text: "Date" } }
            }
        },
        plugins: [{
            id: "noData",
            afterDraw: chart => {
                if (chart.data.datasets.length === 0) {
                    const { ctx, chartArea: { left, top, right, bottom } } = chart;
                    ctx.save();
                    ctx.textAlign = "center";
                    ctx.textBaseline = "middle";
                    ctx.fillStyle = "#999";
                    ctx.font = "16px sans-serif";
                    ctx.fillText("No data available", (left + right) / 2, (top + bottom) / 2);
                    ctx.restore();
                }
            }
        }]
    });

    // Custom Range Picker
    const rangePicker = flatpickr("#siteChart-customRange", {
        mode: "range",
        dateFormat: "Y-m-d",
        onClose: updateSiteChart
    });

    let currentRange = "week";

    // Update Chart
    function updateSiteChart() {
        const selectedSites = Array.from(document.querySelectorAll(".siteChart-siteCheckbox:checked")).map(cb => cb.value);
        const customRange = document.getElementById("siteChart-customRange").value;
        let start = null, end = null;

        if (currentRange === "custom" && customRange) {
            const dates = customRange.split(" to ");
            start = dates[0];
            end = dates[1] || dates[0];
        }

        const filtered = siteChartFilterData(currentRange, start, end);
        siteChart.data.labels = filtered.map(i => i.period);
        siteChart.data.datasets = siteChartDatasets(filtered, selectedSites);
        siteChart.update();

        // ✅ Update sites dropdown button text
        const label = document.getElementById("siteChart-dropdownLabel");
        const allCheckboxes = document.querySelectorAll(".siteChart-siteCheckbox");
        if (selectedSites.length === 0) {
            label.textContent = "Select Sites";
        } else if (selectedSites.length === allCheckboxes.length) {
            label.textContent = "All Sites";
        } else {
            label.textContent = selectedSites.join(", ");
        }

        // ✅ Update "Select All" state
        const selectAll = document.getElementById("siteChart-selectAll");
        selectAll.checked = selectedSites.length === allCheckboxes.length;
        selectAll.indeterminate = selectedSites.length > 0 && selectedSites.length < allCheckboxes.length;
    }

    // Checkbox Handling
    document.querySelectorAll(".siteChart-siteCheckbox").forEach(cb => {
        cb.addEventListener("change", updateSiteChart);
    });

    // Select All Handling
    document.getElementById("siteChart-selectAll").addEventListener("change", function () {
        const checkboxes = document.querySelectorAll(".siteChart-siteCheckbox");
        checkboxes.forEach(cb => cb.checked = this.checked);
        updateSiteChart();
    });

    // Date Dropdown Handling
    document.querySelectorAll(".siteChart-dateOption").forEach(btn => {
        btn.addEventListener("click", function () {
            currentRange = this.dataset.value;
            document.getElementById("siteChart-dateDropdownLabel").textContent = this.textContent;

            const customInput = document.getElementById("siteChart-customRange");
            if (currentRange === "custom") {
                customInput.style.display = "inline-block";
                setTimeout(() => rangePicker.open(), 0); // auto-open
            } else {
                customInput.style.display = "none";
            }
            updateSiteChart();
        });
    });
</script>

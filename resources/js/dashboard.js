// STOP JIKA BUKAN HALAMAN DASHBOARD
if (typeof window.chartData === "undefined") {
    console.warn("chartData not found, dashboard.js skipped");
} else {
    import("chart.js/auto").then(({ default: Chart }) => {
        const ctx = document.getElementById("revenueChart");
        if (!ctx) return;

        const dataSets = {
            daily: window.chartData.daily,
            weekly: window.chartData.weekly,
            monthly: window.chartData.monthly,
            yearly: window.chartData.yearly,
        };

        let chart = new Chart(ctx, {
            type: "line",
            data: {
                labels: dataSets.daily.labels,
                datasets: [
                    {
                        label: "Pendapatan",
                        data: dataSets.daily.data,
                        tension: 0.4,
                        fill: true,
                    },
                ],
            },
        });

        const filter = document.getElementById("chartFilter");
        if (filter) {
            filter.addEventListener("change", (e) => {
                const selected = e.target.value;
                chart.data.labels = dataSets[selected].labels;
                chart.data.datasets[0].data = dataSets[selected].data;
                chart.update();
            });
        }
    });
}

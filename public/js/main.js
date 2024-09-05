document.addEventListener("DOMContentLoaded", function () {
    // Ambil data dari server menggunakan AJAX
    fetch("/sentiment-data")
        .then((response) => response.json())
        .then((data) => {
            // Ekstrak data untuk chart
            var labels = data.labels;
            var positiveData = data.Positive;
            var neutralData = data.Neutral;
            var negativeData = data.Negative;

            // Inisialisasi chart
            var ctx2 = document
                .getElementById("sentimentChart")
                .getContext("2d");

            var gradientPositive = ctx2.createLinearGradient(0, 230, 0, 50);

            gradientPositive.addColorStop(1, "rgba(110,172,218,0.2)");
            gradientPositive.addColorStop(0.2, "rgba(3,52,110,0.0)");
            gradientPositive.addColorStop(0, "rgba(110,172,218,0)");

            var gradientNeutral = ctx2.createLinearGradient(0, 230, 0, 50);

            gradientNeutral.addColorStop(1, "rgba(15,103,177,0.2)");
            gradientNeutral.addColorStop(0.2, "rgba(3,52,110,0.0)");
            gradientNeutral.addColorStop(0, "rgba(15,103,177,0)");

            var gradientNegative = ctx2.createLinearGradient(0, 230, 0, 50);

            gradientNegative.addColorStop(1, "rgba(2,21,38,0.2)");
            gradientNegative.addColorStop(0.2, "rgba(3,52,110,0.0)");
            gradientNegative.addColorStop(0, "rgba(2,21,38,0)");

            var sentimentChart = new Chart(ctx2, {
                type: "line",
                data: {
                    labels: labels,
                    datasets: [
                        {
                            label: "Positive",
                            tension: 0.4,
                            borderWidth: 0,
                            pointRadius: 0,
                            borderColor: "#6eacda",
                            borderWidth: 3,
                            backgroundColor: gradientPositive,
                            fill: true,
                            data: positiveData,
                            maxBarThickness: 6,
                        },
                        {
                            label: "Neutral",
                            tension: 0.4,
                            borderWidth: 0,
                            pointRadius: 0,
                            borderColor: "#0f67b1",
                            borderWidth: 3,
                            backgroundColor: gradientNeutral,
                            fill: true,
                            data: neutralData,
                            maxBarThickness: 6,
                        },
                        {
                            label: "Negative",
                            tension: 0.4,
                            borderWidth: 0,
                            pointRadius: 0,
                            borderColor: "#021526",
                            borderWidth: 3,
                            backgroundColor: gradientNegative,
                            fill: true,
                            data: negativeData,
                            maxBarThickness: 6,
                        },
                    ],
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false,
                        },
                    },
                    interaction: {
                        intersect: false,
                        mode: "index",
                    },
                    scales: {
                        y: {
                            grid: {
                                drawBorder: false,
                                display: true,
                                drawOnChartArea: true,
                                drawTicks: false,
                                borderDash: [5, 5],
                            },
                            ticks: {
                                display: true,
                                padding: 10,
                                color: "#b2b9bf",
                                font: {
                                    size: 11,
                                    family: "Open Sans",
                                    style: "normal",
                                    lineHeight: 2,
                                },
                            },
                        },
                        x: {
                            grid: {
                                drawBorder: false,
                                display: false,
                                drawOnChartArea: false,
                                drawTicks: false,
                                borderDash: [5, 5],
                            },
                            ticks: {
                                display: true,
                                color: "#b2b9bf",
                                padding: 10,
                                font: {
                                    size: 11,
                                    family: "Open Sans",
                                    style: "normal",
                                    lineHeight: 2,
                                },
                            },
                        },
                    },
                },
            });

            // Inisialisasi chart untuk setiment positive
            var ctx2 = document
                .getElementById("detailedSentimentChartPositive")
                .getContext("2d");
            var detailedSentimentChartPositive = new Chart(ctx2, {
                type: "bar",
                data: {
                    labels: labels, // gunakan label yang sama untuk contoh
                    datasets: [
                        {
                            label: "Positive Sentiment",
                            data: positiveData, // gunakan data yang sama untuk contoh
                            backgroundColor: "rgba(75, 192, 192, 0.2)",
                            borderColor: "rgba(75, 192, 192, 1)",
                            borderWidth: 1,
                        },
                    ],
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                        },
                    },
                },
            });

            // Inisialisasi chart untuk setiment Negative
            var ctx2 = document
                .getElementById("detailedSentimentChartNegative")
                .getContext("2d");
            var detailedSentimentChartNegative = new Chart(ctx2, {
                type: "bar",
                data: {
                    labels: labels, // gunakan label yang sama untuk contoh
                    datasets: [
                        {
                            label: "Negative Sentiment",
                            data: negativeData, // gunakan data yang sama untuk contoh
                            backgroundColor: "rgba(75, 192, 192, 0.2)",
                            borderColor: "rgba(75, 192, 192, 1)",
                            borderWidth: 1,
                        },
                    ],
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                        },
                    },
                },
            });

            // Inisialisasi chart untuk setiment Neutral
            var ctx2 = document
                .getElementById("detailedSentimentChartNeutral")
                .getContext("2d");
            var detailedSentimentChartNeutral = new Chart(ctx2, {
                type: "bar",
                data: {
                    labels: labels, // gunakan label yang sama untuk contoh
                    datasets: [
                        {
                            label: "Neutral Sentiment",
                            data: neutralData, // gunakan data yang sama untuk contoh
                            backgroundColor: "rgba(75, 192, 192, 0.2)",
                            borderColor: "rgba(75, 192, 192, 1)",
                            borderWidth: 1,
                        },
                    ],
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                        },
                    },
                },
            });
        })
        .catch((error) => console.error("Error fetching data:", error));
});

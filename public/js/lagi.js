document.addEventListener("DOMContentLoaded", function () {
    var ctx = document.getElementById("sentimentChart").getContext("2d");

    // Dummy data for the last 30 days
    var labels = [];
    var positiveData = [];
    var neutralData = [];
    var negativeData = [];

    for (let i = 30; i > 0; i--) {
        let date = new Date();
        date.setDate(date.getDate() - i);
        labels.push(date.toISOString().split("T")[0]);

        // Generate random data for demonstration
        positiveData.push(Math.floor(Math.random() * 100));
        neutralData.push(Math.floor(Math.random() * 50));
        negativeData.push(Math.floor(Math.random() * 30));
    }

    var sentimentChart = new Chart(ctx, {
        type: "line",
        data: {
            labels: labels,
            datasets: [
                {
                    label: "Positive",
                    data: positiveData,
                    borderColor: "rgba(75, 192, 192, 1)",
                    backgroundColor: "rgba(75, 192, 192, 0.2)",
                    fill: true,
                },
                {
                    label: "Neutral",
                    data: neutralData,
                    borderColor: "rgba(54, 162, 235, 1)",
                    backgroundColor: "rgba(54, 162, 235, 0.2)",
                    fill: true,
                },
                {
                    label: "Negative",
                    data: negativeData,
                    borderColor: "rgba(255, 99, 132, 1)",
                    backgroundColor: "rgba(255, 99, 132, 0.2)",
                    fill: true,
                },
            ],
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                },
                x: {
                    type: "time",
                    time: {
                        unit: "day",
                        tooltipFormat: "MMM D",
                    },
                },
            },
        },
    });
});

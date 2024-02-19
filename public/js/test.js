// public/js/charts.js

document.addEventListener('DOMContentLoaded', function () {
    // Fetch data from the server or use static data
    var data = {
        labels: ['Label 1', 'Label 2', 'Label 3'],
        datasets: [{
            label: 'Chart Title',
            data: [10, 20, 30],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
            ],
            borderWidth: 1
        }]
    };

    var options = {
        responsive: true,
        maintainAspectRatio: false
    };

    // Get the canvas element
    var ctx = document.getElementById('myChart').getContext('2d');

    // Create the chart
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: data,
        options: options
    });
});

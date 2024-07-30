<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Compare Courses/Professors - Course Critic</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <div class="sidebar">
        <h2>Course Critic</h2>
        <a href="home.php"><i class="fas fa-tachometer-alt"></i>&nbsp&nbsp Dashboard</a>
        <a href="courses.php"><i class="fas fa-book"></i>&nbsp&nbsp Courses</a>
        <a href="submit.html"><i class="fas fa-edit"></i>&nbsp&nbsp Submit a Review</a>
        <a href="compare.php"><i class="fas fa-balance-scale"></i>&nbsp&nbsp Compare</a>
    </div>
    <div class="content">
        <h1>Compare Courses/Professors</h1>
        <form id="compare-form" method="POST">
            <label for="course1">Course/Professor 1:</label>
            <input type="text" id="course1" name="course1" required>
            <label for="course2">Course/Professor 2:</label>
            <input type="text" id="course2" name="course2" required>
            <button type="submit">Compare</button>
        </form>
        <div class="chart-container" style="width: 80%; margin: auto;">
            <canvas id="compareChart"></canvas>
        </div>
    </div>

    <script>
        document.getElementById('compare-form').addEventListener('submit', async function(event) {
            event.preventDefault();
            const course1 = document.getElementById('course1').value;
            const course2 = document.getElementById('course2').value;

            const response = await fetch('compare_data.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    course1,
                    course2
                })
            });

            const data = await response.json();
            drawChart(data);
        });

        function drawChart(data) {
            const ctx = document.getElementById('compareChart').getContext('2d');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Overall Rating'],
                    datasets: [{
                            label: data.course1.name,
                            data: [data.course1.rating],
                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 1
                        },
                        {
                            label: data.course2.name,
                            data: [data.course2.rating],
                            backgroundColor: 'rgba(153, 102, 255, 0.2)',
                            borderColor: 'rgba(153, 102, 255, 1)',
                            borderWidth: 1
                        }
                    ]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                            max: 5
                        }
                    }
                }
            });
        }
    </script>
</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Critic</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <div class="sidebar">
        <h2>Course Critic</h2>
        <a href="home.php"><i class="fas fa-tachometer-alt"></i>&nbsp;&nbsp;Dashboard</a>
        <a href="courses.php"><i class="fas fa-book"></i>&nbsp;&nbsp;Courses</a>
        <a href="submit.html"><i class="fas fa-edit"></i>&nbsp;&nbsp;Submit a Review</a>
        <a href="compare.php"><i class="fas fa-balance-scale"></i>&nbsp;&nbsp;Compare</a>
    </div>
    <div class="content">
        <div class="search-bar">
            <input type="text" placeholder="Search for course or professor..." id="searchInput">
            <button onclick="search()">Search</button>
        </div>
        <div class="header-image"></div>
        <div class="welcome">
            <h1>Welcome to Course Review and Rating Platform</h1>
            <p>Your one-stop destination for honest course reviews and comparisons.</p>
        </div>
        <div class="course-list">
            <?php
            require_once 'conn1.php'; // Include the database connection file

            // Fetch the top 3 rated courses from the database
            $sql = 'SELECT course_name, course_code, professor_name, AVG(overall_rating) as avg_rating 
                    FROM reviews 
                    GROUP BY course_name, course_code, professor_name 
                    ORDER BY avg_rating DESC 
                    LIMIT 3';
            try {
                $stmt = $dbh->query($sql);
                if ($stmt->rowCount() > 0) {
                    // Output data of each row
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo "<div class='course'>";
                        echo "<h3>" . htmlspecialchars($row['course_name']) . "</h3>";
                        echo "<p>Faculty: " . htmlspecialchars($row['professor_name']) . "</p>";
                        echo "<div class='rating'>" . str_repeat('★', round($row['avg_rating'])) . str_repeat('☆', 5 - round($row['avg_rating'])) . "</div>";
                        echo "</div>";
                    }
                } else {
                    echo "No courses found.";
                }
            } catch (PDOException $e) {
                echo 'Error: ' . $e->getMessage();
            }

            $dbh = null; // Close the database connection
            ?>
        </div>
        <div class="view-more">
            <a href="courses.php">View More Courses</a>
        </div>
    </div>
    <script>
        function search() {
            var searchInput = document.getElementById('searchInput').value;
            window.location.href = 'search.php?query=' + encodeURIComponent(searchInput);
        }
    </script>
</body>

</html>
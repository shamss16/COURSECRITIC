<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results</title>
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
        <div class="search-results">
            <h1>Search Results</h1>
            <?php
            require_once 'conn1.php'; // Include the database connection file

            // Get the search query from the URL
            $query = isset($_GET['query']) ? $_GET['query'] : '';

            // Fetch matching courses and professors from the database
            $sql = 'SELECT course_name, course_code, professor_name, AVG(overall_rating) as avg_rating 
                    FROM reviews 
                    WHERE course_name LIKE :query OR professor_name LIKE :query 
                    GROUP BY course_name, course_code, professor_name 
                    ORDER BY avg_rating DESC';

            try {
                $stmt = $dbh->prepare($sql);
                $stmt->bindValue(':query', '%' . $query . '%', PDO::PARAM_STR);
                $stmt->execute();

                if ($stmt->rowCount() > 0) {
                    // Output data of each row
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo "<div class='search-result-item'>";
                        echo "<h3>" . htmlspecialchars($row['course_name']) . "</h3>";
                        echo "<p>Faculty: " . htmlspecialchars($row['professor_name']) . "</p>";
                        echo "<div class='rating'>" . str_repeat('★', round($row['avg_rating'])) . str_repeat('☆', 5 - round($row['avg_rating'])) . "</div>";
                        echo "</div>";
                    }
                } else {
                    echo "<p>No results found for '<strong>" . htmlspecialchars($query) . "</strong>'.</p>";
                }
            } catch (PDOException $e) {
                echo 'Error: ' . $e->getMessage();
            }

            $dbh = null; // Close the database connection
            ?>
        </div>
    </div>
</body>

</html>
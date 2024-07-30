<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Courses</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

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
        <h1>Courses</h1>
        <div class="subjects-container">
            <?php
            require_once 'conn1.php'; // Include the database connection file

            // Fetch subjects and review counts from the database
            $sql = 'SELECT course_name, course_code, COUNT(*) as review_count FROM reviews GROUP BY course_name, course_code';
            try {
                $stmt = $dbh->query($sql);
                if ($stmt->rowCount() > 0) {
                    // Output data of each row
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo "<div class='subject-block'>";
                        echo "<a href='reviews.php?course_code=" . urlencode($row['course_code']) . "'>";
                        echo "<h2>" . htmlspecialchars($row['course_name']) . " (" . htmlspecialchars($row['course_code']) . ")</h2>";
                        echo "<p>Number of Reviews: " . htmlspecialchars($row['review_count']) . "</p>";
                        echo "</a>";
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
    </div>
</body>

</html>
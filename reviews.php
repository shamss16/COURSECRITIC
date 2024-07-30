<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Reviews</title>
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
        <h1>Course Reviews</h1>
        <div class="reviews-container">
            <?php
            require_once 'conn1.php'; // Include the database connection file

            if (isset($_GET['course_code'])) {
                $courseCode = $_GET['course_code'];

                // Fetch reviews for the selected course from the database
                $sql = 'SELECT course_name, professor_name, overall_rating, workload_rating, difficulty_rating, review 
                        FROM reviews 
                        WHERE course_code = ?';
                try {
                    $stmt = $dbh->prepare($sql);
                    $stmt->execute([$courseCode]);
                    if ($stmt->rowCount() > 0) {
                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            echo "<div class='review-block'>";
                            echo "<h2>" . htmlspecialchars($row['course_name']) . "</h2>";
                            echo "<p>Professor: " . htmlspecialchars($row['professor_name']) . "</p>";
                            echo "<p>Overall Rating: <span class='rating'>" . str_repeat('★', round($row['overall_rating'])) . str_repeat('☆', 5 - round($row['overall_rating'])) . "</span></p>";
                            echo "<p>Workload Rating: " . htmlspecialchars($row['workload_rating']) . "</p>";
                            echo "<p>Difficulty Rating: " . htmlspecialchars($row['difficulty_rating']) . "</p>";
                            echo "<p>Review: " . htmlspecialchars($row['review']) . "</p>";
                            echo "</div>";
                        }
                    } else {
                        echo "<p>No reviews found for this course.</p>";
                    }
                } catch (PDOException $e) {
                    echo 'Error: ' . $e->getMessage();
                }
            } else {
                echo "<p>No course selected.</p>";
            }

            $dbh = null; // Close the database connection
            ?>
        </div>
    </div>
</body>

</html>
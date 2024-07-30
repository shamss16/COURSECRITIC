<?php
//require_once 'conn1.php'; // Include the database connection file

//if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//     $courseName = $_POST['course-name'];
//     $courseCode = $_POST['course-code'];
//     $professorName = $_POST['professor-name'];
//     $overallRating = $_POST['overall-rating'];
//     $workloadRating = $_POST['workload-rating'];
//     $difficultyRating = $_POST['difficulty-rating'];
//     $review = $_POST['review'];

//     try {
//         $stmt = $dbh->prepare('INSERT INTO reviews (course_name, course_code, professor_name, overall_rating, workload_rating, difficulty_rating, review) VALUES (?, ?, ?, ?, ?, ?, ?)');
//         $stmt->execute([$courseName, $courseCode, $professorName, $overallRating, $workloadRating, $difficultyRating, $review]);
//         echo '<script>alert("Thank you for submitting your review!"); window.location.href = "submit.html";</script>';
//     } catch (PDOException $e) {
//         echo 'Error: ' . $e->getMessage();
//     }
// } else {
//     echo 'Invalid Request';
//}

require_once 'conn1.php'; // Include the database connection file

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $courseName = $_POST['course-name'];
    $courseCode = $_POST['course-code'];
    $professorName = $_POST['professor-name'];
    $overallRating = $_POST['overall-rating'];
    $workloadRating = $_POST['workload-rating'];
    $difficultyRating = $_POST['difficulty-rating'];
    $review = $_POST['review'];

    try {
        $stmt = $dbh->prepare('INSERT INTO reviews (course_name, course_code, professor_name, overall_rating, workload_rating, difficulty_rating, review) VALUES (?, ?, ?, ?, ?, ?, ?)');
        $stmt->execute([$courseName, $courseCode, $professorName, $overallRating, $workloadRating, $difficultyRating, $review]);
        echo '<script>alert("Thank you for submitting your review!"); window.location.href = "courses.php";</script>';
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
} else {
    echo 'Invalid Request';
}

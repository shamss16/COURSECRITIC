<?php
require_once 'conn1.php';

$data = json_decode(file_get_contents('php://input'), true);
$course1 = $data['course1'];
$course2 = $data['course2'];

$response = [
    'course1' => ['name' => $course1, 'rating' => 0],
    'course2' => ['name' => $course2, 'rating' => 0]
];

try {
    $sql = 'SELECT course_name, AVG(overall_rating) as avg_rating 
            FROM reviews 
            WHERE course_name = :course_name OR professor_name = :professor_name
            GROUP BY course_name';
    $stmt = $dbh->prepare($sql);

    // Fetch data for course1/professor1
    $stmt->execute([':course_name' => $course1, ':professor_name' => $course1]);
    $result1 = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($result1) {
        $response['course1']['name'] = $result1['course_name'];
        $response['course1']['rating'] = round($result1['avg_rating'], 1);
    }

    // Fetch data for course2/professor2
    $stmt->execute([':course_name' => $course2, ':professor_name' => $course2]);
    $result2 = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($result2) {
        $response['course2']['name'] = $result2['course_name'];
        $response['course2']['rating'] = round($result2['avg_rating'], 1);
    }

    echo json_encode($response);
} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}

$dbh = null; // Close the database connection

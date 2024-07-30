<?php
session_start();
include "conn.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email_or_regno = $_POST['email_or_regno'];
    $password = $_POST['password'];

    try {
        // Prepare and execute the SQL statement
        $sql = $dbh->prepare("SELECT * FROM register WHERE Email = :email_or_regno OR Registration_number = :email_or_regno");
        $sql->bindParam(':email_or_regno', $email_or_regno);
        $sql->execute();

        // Fetch the user data
        $user = $sql->fetch(PDO::FETCH_ASSOC);

        // Check if a matching record is found and verify the password
        if ($user) {
            if ($password == $user['Password']) {
                // Set user session data if needed
                $_SESSION['user_email'] = $user['Email'];

                header("Location: home.php");
                exit();
            } else {
                // Password is incorrect
                $_SESSION['error_message'] = "Invalid Password.";
                header("Location: login.php");
                exit();
            }
        } else {
            // Email/Registration number is incorrect
            $_SESSION['error_message'] = "Invalid Email/Registration Number.";
            header("Location: login.php");
            exit();
        }
    } catch (PDOException $e) {
        // Handle PDO exception
        echo "Error: " . $e->getMessage();
    }
}

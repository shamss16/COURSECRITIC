<?php
include "conn.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $registration_number = $_POST['registration_number'];
    $password = $_POST['password'];

    $check_sql = $dbh->prepare("SELECT * FROM register WHERE Email = ? OR Registration_number = ?");
    $check_sql->execute(array($email, $registration_number));
    if ($check_sql->rowCount() > 0) {
        echo "<script>
        alert('You already have an account');
        window.location.href = 'index.php';
        </script>";
    } else {
        $sql = $dbh->prepare("INSERT INTO register (Email, Registration_number, Password) VALUES (?, ?, ?)");
        if ($sql->execute(array($email, $registration_number, $password))) {
            echo "<script>
        alert('Registered successfully');
        window.location.href = 'index.php';
        </script>";
        } else {
            echo "<script>
        alert('Registration failed');
        </script>";
        }
    }
}

<?php
$username = 'root';
$password = '';
$server = 'localhost';
$database = 'coursecritic';
try {
    $dbh = new PDO(sprintf('mysql:host=%s;dbname=%s', $server, $database), $username, $password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}

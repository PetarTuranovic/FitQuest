<?php

// DB CONNECTION
$host = 'localhost';
$dbname = 'fitquest';
$username = 'root';
$password = '';

$conn = new mysqli($host, $username, $password, $dbname);

// DB CONNECTION CHECK
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

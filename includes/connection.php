<?php

$hostname = "localhost";
$username = "root";
$password = "";
$database = "banksystem";

// Create connection
$conn = new mysqli($hostname, $username, $password, $database);
$conn->set_charset("utf8");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>

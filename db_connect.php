<?php
$servername = "localhost";           
$username = "root";                 
$password_db = "kali12345678";     
$dbname = "faida_investment_firm";

// Create connection
$conn = new mysqli($servername, $username, $password_db, $dbname);

// Check connection
if ($conn->connect_error) {
    error_log("Database Connection Failed: " . $conn->connect_error);
    die("Database connection failed. Please try again later.");
}

if (!$conn->set_charset("utf8mb4")) {
     error_log("Error loading character set utf8mb4: " . $conn->error);
}

?>
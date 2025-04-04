<?php

// Enable error reporting
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

// Database config
// $servername = "localhost";
// $username = "root";
// $password = ""; 
// $dbname = "FAIDA_INVESTMENT_FIRM";

// Creating connection
$Client_ID = $_POST['Client_ID'];
$Client_Name = $_POST['Client_Name'];
$Gender = $_POST['Gender'];
$Email = $_POST['Email'];
$Phone_Number = $_POST['Phone_Number'];

$conn = new mysqli('localhost', 'root', '', 'test');

// Checking for errors in connection
if($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}else{
    $stmt = $conn->prepare("INSERT INTO Clients_Table(Client_ID, Client_Name, Gender, Email, Phone_Number) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $Client_ID, $Client_Name, $Gender, $Email, $Phone_Number);
    $stmt->execute();
    echo "Registration Successfull...."
    $stmt->close();
    $conn->close();
}

// Process form data when form is submitted
// if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Prepare and bind
    // $stmt = $conn->prepare("INSERT INTO clients (Client_ID, Client_Name, Gender, Email, Phone_Number, Registration_Date) VALUES (?, ?, ?, ?, ?, ?)");
    // $stmt->bind_param("ssssss", $client_id, $name, $gender, $email, $phone, $reg_date);

    // Get form data
    // $Client_ID = $_POST['Client_ID'];
    // $Client_Name = $_POST['Client_Name'];
    // $Gender = $_POST['Gender'];
    // $Email = $_POST['Email'];
    // $Phone_Number = $_POST['Phone_Number'];
    // $Registration_Date = $_POST['Registration_Date'];

    // Execute the statement
    // if ($stmt->execute()) {
        // Success - redirect back to clients page
        // header("Location: clients.html?success=1");
        // exit();
    // } else {
        // echo "Error: " . $stmt->error;
    // }

    // Close statement
    // $stmt->close();
// }

// Close connection
// $conn->close();
?>
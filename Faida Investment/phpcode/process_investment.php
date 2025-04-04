<?php
// Database config
$servername = "localhost";
$username = "root";
$password = ""; 
$dbname = "faida_investment_firm";

// Creating connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Checking for errors in connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO investments (investment_id, investment_name, investment_type, risk_level, annual_return, minimum_investment) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssdd", $investment_id, $investment_name, $investment_type, $risk_level, $annual_return, $minimum_investment);

    // Get form data
    $investment_id = $_POST['Investment_ID'];
    $investment_name = $_POST['Investment_Name'];
    $investment_type = $_POST['Investment_Type'];
    $risk_level = $_POST['Risk_Level'];
    $annual_return = $_POST['Annual_Return'];
    $minimum_investment = $_POST['Minimum_Investment'];

    // Execute the statement
    if ($stmt->execute()) {
        // Success - redirect back to investments page
        header("Location: investment.html?success=1");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close statement
    $stmt->close();
}

// Close connection
$conn->close();
?>
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

// Process portfolio form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['Portfolio_ID'])) {
    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO portfolios (portfolio_id, client_id, portfolio_name, total_value) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sssd", $portfolio_id, $client_id, $portfolio_name, $total_value);

    // Get form data
    $portfolio_id = $_POST['Portfolio_ID'];
    $client_id = $_POST['Client_ID'];
    $portfolio_name = $_POST['Portfolio_Name'];
    $total_value = $_POST['Total_Value'];

    // Execute the statement
    if ($stmt->execute()) {
        header("Location: portfolio.html?success=portfolio");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
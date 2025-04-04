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

// Process portfolio investment form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['Portfolio_Investments_ID'])) {
    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO portfolio_investments (portfolio_investment_id, portfolio_id, investment_id, investment_amount) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sssd", $p_investment_id, $portfolio_id, $investment_id, $investment_amount);

    // Get form data
    $p_investment_id = $_POST['Portfolio_Investments_ID'];
    $portfolio_id = $_POST['Portfolio_ID'];
    $investment_id = $_POST['Investment_ID'];
    $investment_amount = $_POST['Investment_amount'];

    // Execute the statement
    if ($stmt->execute()) {
        header("Location: portfolio.html?success=investment");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
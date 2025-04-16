<?php
// Error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$servername = "localhost"; 
$username = "root";      
$password = "kali12345678"; 
$dbname = "faida_investment_firm"; 


if ($_SERVER["REQUEST_METHOD"] == "POST") {
     if (isset($_POST['Investment_ID'], $_POST['Investment_Name'], $_POST['Investment_Type'], $_POST['Risk_Level'], $_POST['Annual_Return'], $_POST['Minimum_Investment']) &&
        !empty($_POST['Investment_ID']) && !empty($_POST['Investment_Name']) && !empty($_POST['Investment_Type']) && !empty($_POST['Risk_Level']) && isset($_POST['Annual_Return']) && isset($_POST['Minimum_Investment'])) {

        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            error_log("Connection failed: " . $conn->connect_error);
            die("Database connection error.");
        }

       
        $stmt = $conn->prepare("INSERT INTO Investments_Table (Investments_ID, Investment_name, Investment_Type, Risk_Level, Annual_Return, Minimun_Investment) VALUES (?, ?, ?, ?, ?, ?)");
        if ($stmt === false) {
             error_log('Prepare failed: ' . $conn->error);
             die('Error preparing database statement.');
        }

       
        $bindResult = $stmt->bind_param("isssdd", $investment_id, $investment_name, $investment_type, $risk_level, $annual_return, $minimum_investment);
        if ($bindResult === false) {
             error_log('Bind failed: ' . $stmt->error);
             die('Error binding parameters.');
        }

        $investment_id = $_POST['Investment_ID'];
        $investment_name = $_POST['Investment_Name'];
        $investment_type = $_POST['Investment_Type'];
        $risk_level = $_POST['Risk_Level'];
        $annual_return = $_POST['Annual_Return'];
        $minimum_investment = $_POST['Minimum_Investment'];

        if ($stmt->execute()) {
            header("Location: ../investment.php?success=1"); // Redirect to investment.php
            exit();
        } else {
            error_log("Error executing statement: " . $stmt->error);
            echo "Error: Could not add investment. ";
        }
        $stmt->close();
        $conn->close();

    } else {
         echo "Error: Missing or empty required form data.";
    }
} else {
     echo "Error: Invalid request method.";
}
?>

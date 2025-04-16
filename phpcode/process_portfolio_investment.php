<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

echo "<!DOCTYPE html><html><head><title>Processing Portfolio Investment...</title></head><body>"; // Start HTML

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check required fields
     if (isset($_POST['Portfolio_Investments_ID'], $_POST['Portfolio_ID'], $_POST['Investment_ID'], $_POST['Investment_amount']) &&
        !empty($_POST['Portfolio_Investments_ID']) && !empty($_POST['Portfolio_ID']) && !empty($_POST['Investment_ID']) && isset($_POST['Investment_amount'])) {

        
        $servername = "localhost";
        $username = "root";     
        $password = "kali12345678"; 
        $dbname = "faida_investment_firm"; 

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            error_log("Connection failed: " . $conn->connect_error);
            echo '<h1>Database Connection Error</h1><p>Connection Failed: ' . htmlspecialchars($conn->connect_error) . '</p>';
        } else {
             echo "<h1>Attempting to Add Portfolio Investment...</h1>";
            $stmt = $conn->prepare("INSERT INTO Portfolio_Investments (Portfolio_Investments_ID, Portfolio_ID, Investment_ID, Investment_amount) VALUES (?, ?, ?, ?)");

             if ($stmt === false) {
                 error_log('Prepare failed: ' . $conn->error);
                 echo '<p style="color:red;">Error preparing database statement: ' . htmlspecialchars($conn->error) . '</p>';
            } else {
                $bindResult = $stmt->bind_param("iiid", $p_investment_id, $portfolio_id, $investment_id, $investment_amount);

                 if ($bindResult === false) {
                     error_log('Bind failed: ' . $stmt->error);
                     echo '<p style="color:red;">Error binding parameters: ' . htmlspecialchars($stmt->error) . '</p>';
                 } else {
                    $p_investment_id = $_POST['Portfolio_Investments_ID'];
                    $portfolio_id = $_POST['Portfolio_ID'];
                    $investment_id = $_POST['Investment_ID'];
                    $investment_amount = $_POST['Investment_amount'];

                    if ($stmt->execute()) {
                         echo '<p style="color:green; font-weight:bold;">Portfolio Investment Added Successfully!</p>';
                         echo '<p>(Redirect disabled for debugging. You would normally be sent back to the portfolio page.)</p>';
                        
                    } else {
                        echo '<p style="color:red; font-weight:bold;">Error: Could not add portfolio investment.</p>';
                        echo '<p style="color:red;">Database Error: ' . htmlspecialchars($stmt->error) . '</p>';
                        error_log("SQL Error (Portfolio Investment Add): " . $stmt->error);
                    }
                 }
                 $stmt->close();
            }
            $conn->close();
        }
    } else {
        echo '<p style="color:red;">Error: Missing or empty required form data for portfolio investment.</p>';
    }
} else {
     echo '<p style="color:red;">Error: Invalid request method (Must be POST).</p>';
}
echo '<br><a href="../portfolio.php">Back to Portfolio Page</a>'; // Link back
echo "</body></html>"; // End HTML
?>
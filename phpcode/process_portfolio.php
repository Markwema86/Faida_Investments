<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

echo "<!DOCTYPE html><html><head><title>Processing Portfolio...</title></head><body>"; // Start HTML

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check required fields
     if (isset($_POST['Portfolio_ID'], $_POST['Client_ID'], $_POST['Portfolio_Name'], $_POST['Total_Value']) &&
         !empty($_POST['Portfolio_ID']) && !empty($_POST['Client_ID']) && !empty($_POST['Portfolio_Name']) && isset($_POST['Total_Value'])) {

        
        $servername = "localhost"; 
        $username = "root";      
        $password = "kali12345678"; 
        $dbname = "faida_investment_firm"; 

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            error_log("Connection failed: " . $conn->connect_error);
             echo '<h1>Database Connection Error</h1><p>Connection Failed: ' . htmlspecialchars($conn->connect_error) . '</p>';
        } else {
             echo "<h1>Attempting to Add Portfolio...</h1>";
            $stmt = $conn->prepare("INSERT INTO Portfolio_Table (Portfolio_ID, Client_ID, Portfolio_Name, Total_Value) VALUES (?, ?, ?, ?)");

             if ($stmt === false) {
                 error_log('Prepare failed: ' . $conn->error);
                 echo '<p style="color:red;">Error preparing database statement: ' . htmlspecialchars($conn->error) . '</p>';
            } else {
                $bindResult = $stmt->bind_param("iisd", $portfolio_id, $client_id, $portfolio_name, $total_value);

                 if ($bindResult === false) {
                     error_log('Bind failed: ' . $stmt->error);
                     echo '<p style="color:red;">Error binding parameters: ' . htmlspecialchars($stmt->error) . '</p>';
                 } else {
                    $portfolio_id = $_POST['Portfolio_ID'];
                    $client_id = $_POST['Client_ID'];
                    $portfolio_name = $_POST['Portfolio_Name'];
                    $total_value = $_POST['Total_Value'];

                    if ($stmt->execute()) {
                        echo '<p style="color:green; font-weight:bold;">Portfolio Added Successfully!</p>';
                        echo '<p>(Redirect disabled for debugging. You would normally be sent back to the portfolio page.)</p>';
                        
                    } else {
                        echo '<p style="color:red; font-weight:bold;">Error: Could not add portfolio.</p>';
                        echo '<p style="color:red;">Database Error: ' . htmlspecialchars($stmt->error) . '</p>';
                        error_log("SQL Error (Portfolio Add): " . $stmt->error);
                    }
                 }
                 $stmt->close();
            }
            $conn->close();
        }
    } else {
         echo '<p style="color:red;">Error: Missing or empty required form data.</p>';
    }
} else {
     echo '<p style="color:red;">Error: Invalid request method (Must be POST).</p>';
}
echo '<br><a href="../portfolio.php">Back to Portfolio Page</a>'; // Link back
echo "</body></html>"; // End HTML
?>

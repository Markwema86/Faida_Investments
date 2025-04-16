<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if all required fields are set and not empty
    if (isset($_POST['Client_ID'], $_POST['Client_Name'], $_POST['Gender'], $_POST['Email'], $_POST['Phone_Number'], $_POST['Registration_Date']) &&
        !empty($_POST['Client_ID']) && !empty($_POST['Client_Name']) && !empty($_POST['Gender']) && !empty($_POST['Email']) && !empty($_POST['Phone_Number']) && !empty($_POST['Registration_Date'])) {

        // --- Database Connection ---
        $servername = "localhost"; 
        $username = "root";     
        $password = "kali12345678";
        $dbname = "faida_investment_firm"; 
       

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            error_log('Connection Failed: ' . $conn->connect_error);
            die('Database connection error. Please try again later or contact support.');
        } else {
            $stmt = $conn->prepare("INSERT INTO Clients_Table (Client_ID, Client_Name, Gender, Email, Phone_Number, Registration_Date) VALUES (?, ?, ?, ?, ?, ?)");

            if ($stmt === false) {
                 error_log('Prepare failed: ' . $conn->error);
                 die('Error preparing database statement. Please try again later or contact support.');
            }

            // Assign POST variables 
            $Client_ID = $_POST['Client_ID'];
            $Client_Name = $_POST['Client_Name'];
            $Gender = $_POST['Gender'];
            $Email = $_POST['Email']; 
            $Phone_Number = $_POST['Phone_Number']; 
            $Registration_Date = $_POST['Registration_Date']; 

            // Bind parameters
            // Using 'i' for Client_ID and Phone_Number as they are INT in the schema
            // Using 's' for string values
            $bindResult = $stmt->bind_param("isssis", $Client_ID, $Client_Name, $Gender, $Email, $Phone_Number, $Registration_Date);

             if ($bindResult === false) {
                 error_log('Bind failed: ' . $stmt->error);
                 // Provide user-friendly error message
                 die('Error binding parameters. Please try again later or contact support.');
            }

            // Execute the statement
            if ($stmt->execute()) {
                header("Location: ../clients.php?success=1");
                exit(); 
            } else {
                error_log("Error executing statement: " . $stmt->error . " - SQLState: " . $stmt->sqlstate);
                 if ($stmt->errno == 1062) { 
                    echo "Error: Could not add client. A client with this ID or Phone Number may already exist.";
                 } else {
                    echo "Error: Could not add client. Please try again later or contact support.";
                 }
            }
            // Close statement
            $stmt->close();
        }
        // Close connection
        $conn->close();
    } else {
        echo "Error: Missing or empty required form data. Please fill out all fields.";
    }
} else {
     echo "Error: Invalid request method. This page only accepts POST requests.";
}
?>

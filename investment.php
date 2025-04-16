<?php

session_start(); // Start the session

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit; 
}

?>
<!DOCTYPE html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faida-Investment - Investments</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <nav class="navbar">
            <div class="logo">
                <h1 class="logo">Faida-Investment Firm</h1>
            </div>
            <ul class="navbar-items">
                <li><a href="index.php">Home</a></li>
                <li><a href="clients.php">Client</a></li>
                <li><a href="investment.php">Investment</a></li>
                <li><a href="portfolio.php">Portfolio</a></li>
                <li><a href="logout.php" class="btn" style="background-color: #dc3545;">Logout</a></li>
            </ul>
        </nav>
    </header>
    <section id="investment-section"> <div class="title">
            <div>
                <h1>Investments</h1>
            </div>
            <div>
                <button class="add-button" id="addInvestmentBtn">+ Add Investment</button>
            </div>
        </div>
    </section>
    <section id="investment-search"> <div class="search-container">
            <input type="search" placeholder="Search..." class="search-input">
            <button class="search-button">Search</button>
        </div>
    </section><br><br><br>
    <section id="investment-table"> <table class="data-table">
            <thead>
                <tr>
                    <th>Investment ID</th>
                    <th>Investment Name</th>
                    <th>Investment Type</th>
                    <th>Risk Level</th>
                    <th>Annual Return (%)</th>
                    <th>Minimum Investment</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $servername = "localhost"; 
                    $username = "root";      
                    $password = "kali12345678"; 
                    $dbname = "Faida_Investment_Firm";

                    // Create connection
                    $conn = new mysqli($servername, $username, $password, $dbname);

                    // Check connection
                    if ($conn->connect_error) {
                        echo "<tr><td colspan='6'>Connection Failed: " . htmlspecialchars($conn->connect_error) . "</td></tr>";
                    } else {
                        $sql = "SELECT Investments_ID, Investment_name, Investment_Type, Risk_Level, Annual_Return, Minimun_Investment FROM Investments_Table ORDER BY Investment_name ASC";
                        $result = $conn->query($sql);

                        if ($result && $result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . htmlspecialchars($row["Investments_ID"]) . "</td>";
                                echo "<td>" . htmlspecialchars($row["Investment_name"]) . "</td>";
                                echo "<td>" . htmlspecialchars($row["Investment_Type"]) . "</td>";
                                echo "<td>" . htmlspecialchars($row["Risk_Level"]) . "</td>";
                                echo "<td>" . htmlspecialchars(number_format($row["Annual_Return"], 2)) . "</td>";
                                echo "<td>" . htmlspecialchars(number_format($row["Minimun_Investment"], 2)) . "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='6'>No investments found</td></tr>";
                        }
                        $conn->close();
                    }
                ?>
            </tbody>
        </table>
    </section><br><br><br><br>

    <div class="popup-overlay" id="investmentPopupForm">
        <div class="popup-form">
            <div class="form-header">
                <h2>Add New Investment</h2>
                <button class="close-btn" id="closeInvestmentPopupBtn">&times;</button>
            </div>
             <form id="investmentForm" action="./phpcode/process_investment.php" method="POST">
                <div class="form-group">
                    <label for="investmentID">Investment ID</label>
                    <input type="text" id="investmentID" name="Investment_ID" required>
                </div>
                <div class="form-group">
                    <label for="investmentName">Investment Name</label>
                    <input type="text" id="investmentName" name="Investment_Name" required>
                </div>
                <div class="form-group">
                    <label for="investmentType">Investment Type</label>
                    <input type="text" id="investmentType" name="Investment_Type" required>
                </div>
                <div class="form-group">
                    <label for="riskLevel">Risk Level</label>
                    <input type="text" id="riskLevel" name="Risk_Level" required>
                </div>
                <div class="form-group">
                    <label for="annualReturn">Annual Return (%)</label>
                    <input type="number" step="0.01" id="annualReturn" name="Annual_Return" required>
                </div>
                <div class="form-group">
                    <label for="minInvestment">Minimum Investment</label>
                     <input type="number" step="0.01" id="minInvestment" name="Minimum_Investment" required>
                </div>
                <div class="form-actions">
                    <button type="button" class="cancel-btn" id="cancelInvestmentFormBtn">Cancel</button>
                    <button type="submit" class="submit-btn">Add Investment</button>
                </div>
            </form>
        </div>
    </div>

    <footer>
        <div class="footer-section">
            <div class="footer">
                <div class="footer1">
                    <h2>About Us</h2>
                    <p> Faida-Investment Firm is a leading financial investment firm in the Middle East. Our mission is to provide clients with the tools and insights they need to make informed financial decisions. </p>
                </div>
                <div class="footer1">
                    <h2>Contact Us</h2>
                    <p> Email: <a href="mailto:faida@investment.com">faida@investment.com</a> </p>
                    <p> Phone: <a href="tel:+254 769 634 770">+254 769 634 770</a> </p>
                </div>
                <div class="footer1">
                    <h2>Quick Links</h2>
                     <ul> <li><a href="index.php">Home</a></li>
                        <li><a href="clients.php">Client</a></li>       
                        <li><a href="investment.php">Investment</a></li> 
                        <li><a href="portfolio.php">Portfolio</a></li>   
                    </ul>
                </div>
            </div>
            <p class="bottom-footer">&copy; Faida-Investment Firm 2025. All rights reserved.</p>
        </div>
    </footer>
    <script src="main.js"></script>
</body>
</html>

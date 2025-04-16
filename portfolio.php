<?php
session_start(); // Start the session

// Check if the user is logged in, if not then redirect to login page
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
    <title>Faida-Investment - Portfolio</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <nav class="navbar">
             <div class="logo"> <h1 class="logo">Faida-Investment Firm</h1> </div>
             <ul class="navbar-items">
                <li><a href="index.php">Home</a></li>
                <li><a href="clients.php">Client</a></li>
                <li><a href="investment.php">Investment</a></li>
                <li><a href="portfolio.php">Portfolio</a></li>
                <li><a href="logout.php" class="btn" style="background-color:rgb(238, 75, 0);">Logout</a></li>
            </ul>
        </nav>
    </header>
    <section id="portfolio-section">
        <div class="title"> <div> 
            <h1>Portfolios</h1> 
        </div> 
        <div> 
            <button class="add-button" id="addPortfolioBtn">+ Add Portfolio</button> 
        </div> 
    </div>
    </section>

    <section id="portfolio-search"> 
        <div class="search-container"> 
            <input type="search" placeholder="Search Portfolios..." class="search-input"> 
            <button class="search-button">Search</button> 
        </div> 
    </section><br><br><br>

    <section id="portfolio-table">
        <table class="data-table">
            <thead> 
                <tr> 
                    <th>Portfolio ID</th> 
                    <th>Client ID</th> 
                    <th>Portfolio Name</th> 
                    <th>Total Value</th> 
                </tr> 
            </thead>

            <tbody>
                <?php
                    // --- !!! ACTION REQUIRED: Database Connection !!! ---
                    $servername_p = "localhost"; $username_p = "root"; $password_p = "kali12345678"; $dbname_p = "Faida_Investment_Firm";
                    // --- End of ACTION REQUIRED ---
                    $conn_portfolio = new mysqli($servername_p, $username_p, $password_p, $dbname_p);
                    if ($conn_portfolio->connect_error) { echo "<tr><td colspan='4'>Connection Failed: " . htmlspecialchars($conn_portfolio->connect_error) . "</td></tr>"; }
                    else {
                        $sql_portfolio = "SELECT Portfolio_ID, Client_ID, Portfolio_Name, Total_Value FROM Portfolio_Table ORDER BY Portfolio_ID ASC";
                        $result_portfolio = $conn_portfolio->query($sql_portfolio);
                        if ($result_portfolio && $result_portfolio->num_rows > 0) {
                            while($row = $result_portfolio->fetch_assoc()) { /* ... echo table rows ... */
                                echo "<tr>"; echo "<td>" . htmlspecialchars($row["Portfolio_ID"]) . "</td>"; echo "<td>" . htmlspecialchars($row["Client_ID"]) . "</td>"; echo "<td>" . htmlspecialchars($row["Portfolio_Name"]) . "</td>"; echo "<td>" . htmlspecialchars(number_format($row["Total_Value"], 2)) . "</td>"; echo "</tr>";
                            }
                        } else { echo "<tr><td colspan='4'>No portfolios found</td></tr>"; }
                        $conn_portfolio->close();
                    }
                ?>
            </tbody>
        </table>
    </section>
    <section id="portfolio-investment-section"> <div class="title"> <div> <h1>Portfolio Investments</h1> </div> <div> <button class="add-button" id="addPortfolioInvestmentBtn">+ Add Portfolio Investments</button> </div> </div> </section>
    <section id="portfolio-investment-table">
        <table class="data-table">
            <thead> 
                <tr> 
                    <th>Portfolio Investment ID</th> 
                    <th>Portfolio ID</th> 
                    <th>Investment ID</th> 
                    <th>Investment Amount</th> 
                </tr> 
            </thead>
            <tbody>
                 <?php
                     // --- !!! ACTION REQUIRED: Database Connection !!! ---
                    $servername_pi = "localhost"; $username_pi = "root"; $password_pi = "kali12345678"; $dbname_pi = "Faida_Investment_Firm";
                     // --- End of ACTION REQUIRED ---
                    $conn_portfolio_inv = new mysqli($servername_pi, $username_pi, $password_pi, $dbname_pi);
                    if ($conn_portfolio_inv->connect_error) { echo "<tr><td colspan='4'>Connection Failed: " . htmlspecialchars($conn_portfolio_inv->connect_error) . "</td></tr>"; }
                    else {
                        $sql_portfolio_inv = "SELECT Portfolio_Investments_ID, Portfolio_ID, Investment_ID, Investment_amount FROM Portfolio_Investments ORDER BY Portfolio_Investments_ID ASC";
                        $result_portfolio_inv = $conn_portfolio_inv->query($sql_portfolio_inv);
                        if ($result_portfolio_inv && $result_portfolio_inv->num_rows > 0) {
                             while($row = $result_portfolio_inv->fetch_assoc()) { /* ... echo table rows ... */
                                echo "<tr>"; echo "<td>" . htmlspecialchars($row["Portfolio_Investments_ID"]) . "</td>"; echo "<td>" . htmlspecialchars($row["Portfolio_ID"]) . "</td>"; echo "<td>" . htmlspecialchars($row["Investment_ID"]) . "</td>"; echo "<td>" . htmlspecialchars(number_format($row["Investment_amount"], 2)) . "</td>"; echo "</tr>";
                             }
                        } else { echo "<tr><td colspan='4'>No portfolio investments found</td></tr>"; }
                        $conn_portfolio_inv->close();
                    }
                ?>
            </tbody>
        </table>
    </section><br><br><br><br>

    <div class="popup-overlay" id="portfolioPopupForm">
         <div class="popup-form">
             <div class="form-header"> <h2>Add New Portfolio</h2> <button class="close-btn" id="closePortfolioPopupBtn">&times;</button> </div>
            <form id="portfolioForm" action="./phpcode/process_portfolio.php" method="POST">
                 <div class="form-group"> 
                    <label for="PortfolioId">Portfolio ID</label> 
                    <input type="text" id="PortfolioId" name="Portfolio_ID" required> 
                 </div>
                 <div class="form-group"> 
                    <label for="clientID" name="">Client ID</label> 
                    <input type="text" id="clientID" name="Client_ID" required> 
                </div>
                <div class="form-group"> 
                    <label for="portfolioName">Portfolio Name</label> 
                    <input type="text" id="portfolioName" name="Portfolio_Name" required> 
                </div>
                <div class="form-group">
                    <label for="totalValue">Total Value</label> 
                    <input type="number" step="0.01" id="totalValue" name="Total_Value" required> 
                </div>
                <div class="form-actions"> 
                    <button type="button" class="cancel-btn" id="cancelPortfolioBtn">Cancel</button> 
                    <button type="submit" class="submit-btn">Add Portfolio</button> 
                </div>
            </form>
        </div>
    </div>
    <div class="popup-overlay" id="portfolioInvestmentPopupForm">
        <div class="popup-form">
            <div class="form-header"> <h2>Add Portfolio Investment</h2> <button class="close-btn" id="closePortfolioInvestmentPopupBtn">&times;</button> </div>
            <form id="portfolioInvestmentForm" action="./phpcode/process_portfolio_investment.php" method="POST">
                 <div class="form-group"> 
                    <label for="pinvestmentId">Portfolio Investment ID</label> 
                    <input type="text" id="pinvestmentId" name="Portfolio_Investments_ID" required> 
                </div>
                 <div class="form-group"> 
                    <label for="portfolioId">Portfolio ID</label> 
                    <input type="text" id="portfolioId" name="Portfolio_ID" required> 
                </div>
                 <div class="form-group"> 
                    <label for="investmentId">Investment ID</label> 
                    <input type="text" id="investmentId" name="Investment_ID" required> 
                </div>
                 <div class="form-group"> 
                    <label for="investmentAmount">Investment Amount</label> 
                    <input type="number" step="0.01" id="investmentAmount" name="Investment_amount" required> 
                </div>
                <div class="form-actions"> 
                    <button type="button" class="cancel-btn" id="cancelPortfolioInvestmentBtn">Cancel</button> 
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

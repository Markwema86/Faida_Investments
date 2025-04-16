<?php
session_start(); 

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit; 
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faida-Investment</title>
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
    <section id="home">
         <h1>Welcome to Faida-Investment</h1>
        <p>
            We are dedicated to providing a comprehensive and user-friendly platform<br>
            for managing client investments, portfolios, and financial assets.<br> Our
            mission is to empower our clients with the tools and insights they <br>
            need to make informed financial decisions.
        </p>
        <div class="home-btn">
            <button class="btn1"><a href="#features">Learn more</a></button>
            <button class="btn2"><a style="text-decoration: none; color: white;" href="register.php">Get Started</a></button>
        </div>
    </section>

    <section id="features">
         <h1>Key Features</h1>
        <p>Everything you need to manage Investments and clients Portfolios efficiently</p>
        <br>
        <div class="feature-list">
            <div class="feature">
                <img src="images/portfolio.png" alt="Feature 1">
                <h2>Portfolio Management</h2>
                <p>
                    Our Portfolio Management service provides a tailored approach to help you build and maintain a diversified investment portfolio. We analyze your financial goals and risk tolerance to create a strategy that maximizes returns while minimizing risk.
                </p>
            </div>
            <div class="feature">
                <img src="images/team.png" alt="Feature 2">
                <h2>Client Management</h2>
                <p>
                    Track, manage, and communicate with your clients efficiently.
                    Our Client Management system streamlines interactions, ensuring
                    that you can provide personalized service and timely updates.
                </p>
            </div>
            <div class="feature">
                <img src="images/analysis.png" alt="Feature 3">
                <h2>Financial Analysis</h2>
                <p>
                    Get detailed financial reports and insights on your investments.
                    Our Financial Analysis tools provide in-depth evaluations of market
                    trends, asset performance, and risk assessments.
                </p>
            </div>
            <div class="feature">
                <img src="images/empathy.png" alt="Feature 3">
                <h2>Secure and Compliant</h2>
                <p>
                    Your data security is our top priority. Our platform is designed
                    to meet the highest standards of security and compliance,
                    ensuring that your sensitive information is protected.
                </p>
            </div>
        </div>
    </section>


    <section id="features2">
         <h1>Ready to Optimize Your Investment Management?</h1>
        <p>
            Join thousands of financial professionals who trust our plartform
        </p>
        <div class="home-btn">
            <button class="btn2"><a style="text-decoration: none; color: white;" href="register.php">Get Started</a></button>
        </div>
    </section>

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

    <script src="main.js"></script> </body>
</html>
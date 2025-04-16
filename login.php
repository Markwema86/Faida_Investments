<?php
session_start(); 
require_once 'db_connect.php';

$errors = []; 

if (isset($_SESSION['user_id'])) {
    header("Location: index.php"); 
    exit();
}

// Handle login form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email'] ?? ''); // Use null coalescing for safety
    $password_attempt = $_POST['password'] ?? ''; // NO HASHING as requested

    if (empty($email) || empty($password_attempt)) {
        $errors[] = "Email and password are required.";
    } else {
        // Prepare statement to find user by email
        $stmt = $conn->prepare("SELECT UserID, FullName, Email, Password FROM Users WHERE Email = ?");
         if ($stmt === false) {
             // Log the detailed error, provide generic message
             error_log("Database error (login select prepare): " . $conn->error);
             $errors[] = "An unexpected error occurred. Please try again later.";
        } else {
            $stmt->bind_param("s", $email);
            if (!$stmt->execute()) {
                 error_log("Database error (login select execute): " . $stmt->error);
                 $errors[] = "An unexpected error occurred. Please try again later.";
            } else {
                $result = $stmt->get_result();

                if ($result->num_rows === 1) {
                    $user = $result->fetch_assoc();

                    // Verify password (Direct comparison - NOT RECOMMENDED)
                    if ($password_attempt === $user['Password']) {
                        session_regenerate_id(true);

                        $_SESSION['user_id'] = $user['UserID'];
                        $_SESSION['user_fullname'] = $user['FullName'];
                        $_SESSION['user_email'] = $user['Email'];
                        $_SESSION['login_time'] = time(); // Optional: store login time

                        // Close statement and connection *before* redirecting
                        $stmt->close();
                        $conn->close();

                        // Redirect to the main application page (index.php)
                        header("Location: index.php");
                        exit(); // Important: Stop script execution after redirection

                    } else {
                        // Invalid password
                        $errors[] = "Invalid email or password.";
                    }
                } else {
                    // No user found with that email
                    $errors[] = "Invalid email or password.";
                }
            }
            if ($stmt->bind_result_called) { // Check if statement is still open in a way
               $stmt->close();
            }
        }
    }
    if ($conn->ping()) {
        $conn->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Faida-Investment</title>
    <link rel="stylesheet" href="style.css"> <style>
        /* Reuse styles from register.php or include in style.css */
        body { display: flex; justify-content: center; align-items: center; min-height: 100vh; background-color: #f4f7f6; font-family: sans-serif;}
        .auth-container { background-color: #fff; padding: 30px 40px; border-radius: 8px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); width: 100%; max-width: 400px; }
        .auth-container h1 { text-align: center; margin-bottom: 25px; color: #263954; }
        .form-group { margin-bottom: 15px; }
        .form-group label { display: block; margin-bottom: 5px; font-weight: bold; color: #333; }
        .form-group input { width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; font-size: 1rem;}
        .auth-btn { width: 100%; padding: 12px; background-color: #04c253; border: none; color: white; font-size: 16px; border-radius: 4px; cursor: pointer; margin-top: 10px; transition: background-color 0.2s ease;}
        .auth-btn:hover { background-color: #03a144; }
        .error-messages { margin-bottom: 15px; padding: 10px; border-radius: 4px; text-align: left; background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }
        .error-messages ul { list-style: none; padding: 0; margin: 0; }
        .error-messages li { margin-bottom: 5px; }
        .success-message { margin-bottom: 15px; padding: 10px; border-radius: 4px; text-align: center; }
        .switch-link { text-align: center; margin-top: 20px; font-size: 0.9em;}
        .switch-link a { color: #007bff; text-decoration: none; }
        .switch-link a:hover { text-decoration: underline; }
    </style>
</head>
<body>
    <div class="auth-container">
        <h1>Login</h1>

        <?php if (!empty($errors)): ?>
            <div class="error-messages">
                <ul>
                    <?php foreach ($errors as $error): ?>
                        <li><?php echo htmlspecialchars($error); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

         <?php if (isset($_GET['registered']) && $_GET['registered'] == '1'): ?>
            <div class="success-message" style="background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb;">
                Registration successful! Please log in.
            </div>
        <?php endif; ?>
         <?php if (isset($_GET['logged_out']) && $_GET['logged_out'] == '1'): ?>
            <div class="success-message" style="background-color: #d1ecf1; color: #0c5460; border: 1px solid #bee5eb;">
                You have been logged out successfully.
            </div>
        <?php endif; ?>
        <?php if (isset($_GET['error']) && $_GET['error'] == 'protected'): ?>
            <div class="error-messages" style="background-color: #fff3cd; color: #856404; border-color: #ffeeba;">
                 Please log in to access that page.
            </div>
        <?php endif; ?>


        <form action="login.php" method="POST">
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" class="auth-btn">Login</button>
        </form>
        <div class="switch-link">
            Don't have an account? <a href="register.php">Register here</a>
        </div>
    </div>
</body>
</html>

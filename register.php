<?php
session_start();
require_once 'db_connect.php'; 

$errors = []; 

// --- Step 1: Handle Form Submission ---
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // --- Step 2: Get and Trim Input Data ---
    $fullname = trim($_POST['fullname'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? ''; // NO HASHING as requested
    $confirm_password = $_POST['confirm_password'] ?? '';

    // --- Step 3: Perform Validations ---
    if (empty($fullname)) {
        $errors[] = "Full name is required.";
    }
    // Email validations
    if (empty($email)) {
        $errors[] = "Email is required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    }
    // Password validations
    if (empty($password)) {
        $errors[] = "Password is required.";
    }
    if ($password !== $confirm_password) {
        $errors[] = "Passwords do not match.";
    }

    // --- Step 4: Check if Email Exists  ---
    if (empty($errors)) {
        $stmt_check = $conn->prepare("SELECT UserID FROM Users WHERE Email = ?");
        if ($stmt_check === false) {
             error_log("Database error (check email prepare): " . $conn->error);
             $errors[] = "An unexpected error occurred checking email. Please try again later.";
        } else {
            $stmt_check->bind_param("s", $email);
            if (!$stmt_check->execute()) {
                 error_log("Database error (check email execute): " . $stmt_check->error);
                 $errors[] = "An unexpected error occurred checking email. Please try again later.";
            } else {
                 $stmt_check->store_result();
                 if ($stmt_check->num_rows > 0) {
                    $errors[] = "Email address is already registered.";
                 }
            }
            $stmt_check->close();
        }
    }

    // --- Step 5: Attempt Database Insertion (ONLY if NO errors occurred) ---
    if (empty($errors)) {
        $stmt_insert = $conn->prepare("INSERT INTO Users (FullName, Email, Password) VALUES (?, ?, ?)");
         if ($stmt_insert === false) {
             error_log("Database error (insert user prepare): " . $conn->error);
             $errors[] = "An unexpected error occurred during registration setup.";
        } else {
            // Bind parameters - $fullname here CANNOT be empty if validation worked
            $stmt_insert->bind_param("sss", $fullname, $email, $password);

            // Execute the insertion - This is the line (or near it) where your error occurred
            if ($stmt_insert->execute()) {
                // --- START: Auto-login after registration ---
                $new_user_id = $stmt_insert->insert_id; 

                // Set session variables to log the user in immediately
                $_SESSION['user_id'] = $new_user_id;
                $_SESSION['user_fullname'] = $fullname; // Use the submitted fullname
                $_SESSION['user_email'] = $email;       // Use the submitted email

                // --- END: Auto-login after registration ---

                // Close the insert statement before redirecting
                $stmt_insert->close();
                $conn->close(); 

                // Redirect to the homepage (index.php)
                header("Location: index.php");
                exit(); 

            } else {
                 // Log the detailed error
                 error_log("Database error (insert user execute): " . $stmt_insert->error . " - SQLState: " . $stmt_insert->sqlstate);
                 $errors[] = "Registration failed due to a database error. Please try again.";
                 $stmt_insert->close();
            }
        }
    }

    // --- Step 6: Close Connection if Still Open ---
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
    <title>Register - Faida-Investment</title>
    <link rel="stylesheet" href="style.css"> <style>
        body { display: flex; justify-content: center; align-items: center; min-height: 100vh; background-color: #f4f7f6; font-family: sans-serif; }
        .auth-container { background-color: #fff; padding: 30px 40px; border-radius: 8px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); width: 100%; max-width: 400px; }
        .auth-container h1 { text-align: center; margin-bottom: 25px; color: #263954; }
        .form-group { margin-bottom: 15px; }
        .form-group label { display: block; margin-bottom: 5px; font-weight: bold; color: #333; }
        .form-group input { width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; font-size: 1rem;}
        .auth-btn { width: 100%; padding: 12px; background-color: #ff5f03; border: none; color: white; font-size: 16px; border-radius: 4px; cursor: pointer; margin-top: 10px; transition: background-color 0.2s ease;}
        .auth-btn:hover { background-color: #e05303; }
        .error-messages { margin-bottom: 15px; padding: 10px; border-radius: 4px; text-align: left; background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }
        .error-messages ul { list-style: none; padding: 0; margin: 0; }
        .error-messages li { margin-bottom: 5px; }
        .switch-link { text-align: center; margin-top: 20px; font-size: 0.9em; }
        .switch-link a { color: #007bff; text-decoration: none; }
        .switch-link a:hover { text-decoration: underline; }
        #passwordMatchError { color: red; font-size: 0.8em; display: none; margin-top: 3px;} /* Style for JS error msg */
    </style>
</head>
<body>
    <div class="auth-container">
        <h1>Register</h1>

        <?php
        // Display errors if any occurred during processing
        if (!empty($errors)): ?>
            <div class="error-messages">
                <strong>Please fix the following errors:</strong>
                <ul>
                    <?php foreach ($errors as $error): ?>
                        <li><?php echo htmlspecialchars($error); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form action="register.php" method="POST" id="registerForm" novalidate> <div class="form-group">
                <label for="fullname">Full Name:</label>
                <input type="text" id="fullname" name="fullname" required value="<?php echo isset($_POST['fullname']) ? htmlspecialchars($_POST['fullname']) : ''; ?>">
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                 <input type="email" id="email" name="email" required value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="confirm_password">Confirm Password:</label>
                <input type="password" id="confirm_password" name="confirm_password" required>
                 <span id="passwordMatchError">Passwords do not match.</span> </div>
            <button type="submit" class="auth-btn">Register</button>
        </form>
         <div class="switch-link">
            Already have an account? <a href="login.php">Login here</a>
        </div>
    </div>

    <script>
        const form = document.getElementById('registerForm');
        const password = document.getElementById('password');
        const confirmPassword = document.getElementById('confirm_password');
        const passwordMatchError = document.getElementById('passwordMatchError');

        function checkPasswordMatch() {
            // Trim values to avoid issues with whitespace
            const passVal = password.value.trim();
            const confirmPassVal = confirmPassword.value.trim();

            if (passVal !== confirmPassVal && confirmPassVal !== '') {
                passwordMatchError.style.display = 'block'; 
                confirmPassword.style.borderColor = 'red';
                return false;
            } else {
                passwordMatchError.style.display = 'none'; 
                confirmPassword.style.borderColor = '#ccc'; 
                return true; 
            }
        }

    </script>
</body>
</html>
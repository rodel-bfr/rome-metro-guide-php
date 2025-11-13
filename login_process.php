<?php
session_start();
include 'connection.php'; // Your database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST['username']) || empty($_POST['password'])) {
        $_SESSION['login_error'] = "Username and password are required.";
        header("Location: admin.php");
        exit;
    }

    $username = trim($_POST['username']);
    $password_attempt = trim($_POST['password']); // Plain text password for this example

    // Prepare SQL statement to prevent SQL injection
    $sql = "SELECT id, username, password FROM admin_users WHERE username = ?";
    $stmt = mysqli_prepare($cnx, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        
        if ($user = mysqli_fetch_assoc($result)) {
            // Securely verify the hashed password
            if (password_verify($password_attempt, $user['password'])) {
                $_SESSION['admin_logged_in'] = true;
                $_SESSION['admin_id'] = $user['id'];
                $_SESSION['admin_username'] = $user['username'];
                unset($_SESSION['login_error']);
                header("Location: admin.php"); // Redirect to admin page
                exit;
            } else {
                $_SESSION['login_error'] = "Invalid username or password.";
            }
        } else {
            $_SESSION['login_error'] = "Invalid username or password.";
        }
        mysqli_stmt_close($stmt);
    } else {
        // SQL error
        $_SESSION['login_error'] = "Database error. Please try again later.";
        error_log("MySQLi prepare error: " . mysqli_error($cnx));
    }
    mysqli_close($cnx);
} else {
    // Not a POST request
    $_SESSION['login_error'] = "Invalid request method.";
}

header("Location: admin.php"); // Redirect back to admin page with error
exit;
?>
<?php
// Require the Composer autoloader
require __DIR__ . '/vendor/autoload.php';

// Load the .env file
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$db_host = $_ENV['DB_HOST'];
$db_user = $_ENV['DB_USER'];
$db_pass = $_ENV['DB_PASS'];
$db_name = $_ENV['DB_NAME'];

// mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT); // Better error handling
$cnx = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

// Test the connection
if (mysqli_connect_errno()) {
    // Use error_log instead of die() for production
    error_log("MySQL connection failed: " . mysqli_connect_error());
    die("A database connection error occurred. Please try again later.");
}

// Set the character set to utf8
mysqli_set_charset($cnx, "utf8");
?>
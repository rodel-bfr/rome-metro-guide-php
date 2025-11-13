<?php
// This file is for one-time use to generate a password hash.

$plain_password = 'changeme'; // Change this to your desired password
echo "<h1>Password Hash Generator</h1>";

// Hash the password using PHP's recommended algorithm
$hashed_password = password_hash($plain_password, PASSWORD_DEFAULT);

echo "<p><strong>Your Plain Password:</strong> " . htmlspecialchars($plain_password) . "</p>";
echo "<p><strong>Your Hashed Password (Copy this):</strong></p>";
echo "<textarea rows='3' cols='80' readonly>" . htmlspecialchars($hashed_password) . "</textarea>";
echo "<p><strong>Instructions:</strong></p>";
echo "<ol>";
echo "<li>Copy the hashed password from the text box above.</li>";
echo "<li>Go to phpMyAdmin and select your `admin_users` table.</li>";
echo "<li>Click the 'Insert' tab.</li>";
echo "<li>In the `username` field, type your desired username (e.g., 'admin').</li>";
echo "<li>In the `password` field, paste the hashed password.</li>";
echo "<li>Click 'Go' to save.</li>";
echo "</ol>";
echo "<p><strong>SECURITY:</strong> Delete this file from your project after you're done!</p>";
?>
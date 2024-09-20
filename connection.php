<?php
// Replace these variables with your own credentials
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "arogya_hms";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "";
?>

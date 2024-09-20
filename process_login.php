<?php
session_start();

// Replace with your own database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "arogya_hms";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$email = $conn->real_escape_string($_POST['email']);
$password = $_POST['password'];

$tables = ['admin', 'patients', 'doctors', 'nurses', 'receptionists'];

foreach ($tables as $table_name) {
    $sql = "SELECT * FROM $table_name WHERE email = '$email'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        
        // Use password_verify() to check if the entered password matches the hashed password
        if (password_verify($password, $row['password'])) {
            $_SESSION['user_id'] = $row["{$table_name}_id"];
            $_SESSION['user_type'] = $table_name;
            switch ($table_name) {
                case 'doctors':
                    header("Location: doctor_dashboard.php");
                    break;
                case 'patients':
                    header("Location: patient_dashboard.php");
                    break;
                case 'admin':
                    header("Location: admin_dashboard.php");
                    break;
                case 'nurses':
                    header("Location: nurse_dashboard.php");
                    break;
                case 'receptionists':
                    header("Location: receptionist_dashboard.php");
                    break;
            }
            exit;
        }
    }
}

$_SESSION['error_message'] = "Invalid email or password";
header("Location: login.php");
exit;
?>

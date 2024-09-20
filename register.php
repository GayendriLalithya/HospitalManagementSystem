<?php
// Replace with your own database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "arogya_hms";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$first_name = $conn->real_escape_string($_POST['first_name']);
$last_name = $conn->real_escape_string($_POST['last_name']);
$phone = $conn->real_escape_string($_POST['phone']);
$address = $conn->real_escape_string($_POST['address']);
$age = intval($_POST['age']);
$gender = $conn->real_escape_string($_POST['gender']);
$user_type = $conn->real_escape_string($_POST['user_type']);
$email = $conn->real_escape_string($_POST['email']);
$password = $conn->real_escape_string($_POST['password']);

// Hash the password using the default BCRYPT algorithm
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

switch ($user_type) {
    case 'Doctor':
        $table_name = "doctors";
        break;
    case 'Patient':
        $table_name = "patients";
        break;
    case 'Admin':
        $table_name = "admin";
        break;
    case 'Nurse':
        $table_name = "nurses";
        break;
    case 'Receptionist':
        $table_name = "receptionists";
        break;
    default:
        echo "Invalid user type";
        exit;
}

$sql = "INSERT INTO $table_name (first_name, last_name, email, phone, address, age, gender, password) VALUES ('$first_name', '$last_name', '$email', '$phone', '$address', $age, '$gender', '$hashed_password')";

if ($conn->query($sql) === TRUE) {
    header("Location: login.php");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>

<?php
// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "arogya_hms";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $conn->real_escape_string($_POST['recep_fname']);
    $last_name = $conn->real_escape_string($_POST['recep_lname']);
    $email = $conn->real_escape_string($_POST['recep_email']);
    $phone = $conn->real_escape_string($_POST['recep_phone']);
    $address = $conn->real_escape_string($_POST['recep_address']);
    $age = intval($_POST['recep_age']);
    $gender = $conn->real_escape_string($_POST['recep_gender']);
    $password = $conn->real_escape_string($_POST['recep_pw']);

    // Hashing the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO receptionists (first_name, last_name, email, phone, address, age, gender, password) VALUES ('$first_name', '$last_name', '$email', '$phone', '$address', $age, '$gender', '$hashed_password')";

    try {
        if ($conn->query($sql) === TRUE) {
            echo "<script type='text/javascript'>alert('Receptionist added successfully!')</script>";
        } else {
            throw new mysqli_sql_exception($conn->error, $conn->errno);
        }
    } catch (mysqli_sql_exception $e) {
        if ($e->getCode() === 1062) {
            echo "<script type='text/javascript'>alert('Error adding receptionist: Duplicate entry detected.')</script>";
        } else {
            echo "<script type='text/javascript'>alert('Error adding receptionist: " . $e->getMessage() . "')</script>";
        }
    }

    // Close the database connection
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/insert_patients.css">
    <!--Icons-->
    <link rel="stylesheet" href="css/all.min.css">
    <!-- <script src="https://kit.fontawesome.com/ec0debbca9.js" crossorigin="anonymous"></script> -->
    <title>Admin | Add Receptionist</title>


    <style>
        .sidenav a {
            padding: 8px 8px 8px 32px;
            text-decoration: none;
            font-size: 25px;
            color: #CCC;
            display: block;
            transition: 0.3s;
            font-family: Arial, sans-serif;
            padding-top: 35px;
        }
    </style>

    <script>
        function togglePasswordVisibility(inputId, iconId) {
            const input = document.getElementById(inputId);
            const icon = document.getElementById(iconId);
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }
    </script>

</head>
<body>

<div id="mySidenav" class="sidenav" class="background">
        <b><p><a href="index.php">Home</a><br/>
        <b><p><a href="admin_dashboard.php">Dashboard</a><br/>
        <b><p><a href="view_receptionist.php">View Receptionists</a><br/>
        <b><p><a href="update_receptionist.php">Update Receptionist</a><br/>
        <b><p><a href="delete_receptionist.php">Delete Receptionist</a><br/>
        <b><p><a href="logout.php">Logout</a><br/>    
    </div> 

    <div class="container" style="margin-left: 38%;">
        <h1>Add Receptionist</h1>
        <form id="receptionistForm" method="POST" name="recep_reg" onsubmit="return checkpasswordmem()" autocomplete="off" enctype="multipart/form-data">
            <div class="row">
                <label for="recep_fname">Receptionist First Name</label>
                <input type="text" id="recep_fname" name="recep_fname" placeholder="Enter Receptionist's First Name" required>
            </div>
            <div class="row">
                <label for="recep_lname">Receptionist Last Name</label>
                <input type="text" id="recep_lname" name="recep_lname" placeholder="Enter Receptionist's Last Name" required>
            </div>
            <div class="row">
                <label for="recep_phone">Phone Number</label>
                <input type="number" id="recep_phone" name="recep_phone" placeholder="Enter Receptionist's Contact Number" required>
            </div>
            <div class="row">
                <label for="recep_address">Address</label>
                <input type="text" id="recep_address" name="recep_address" placeholder="Enter Receptionist's Home Address" required>
            </div>
            <div class="row">
                <label for="recep_email">Email Address</label>
                <input type="email" id="recep_email" name="recep_email" placeholder="Enter Receptionist's Email Address" required>
            </div>
            <div class="row">
                <label for="recep_age">Age</label>
                <input type="number" id="recep_age" name="recep_age" placeholder="Enter Receptionist's Age" required>
            </div>
            <div class="row">
                <label for="recep_gender">Gender</label>
                <select id="recep_gender" style="padding: 10px;" name="recep_gender" required>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    <option value="Other">Other</option>
                </select>
            </div>
            <div class="row">
                <label for="sucpw">Create a password</label>
                <div class="input-wrapper">
                    <input type="password" name="recep_pw" autocomplete="password" required="" id="sucpw" placeholder="Create Password">
                    <i class="far fa-eye" id="toggle_password" style="margin-left: -50px; cursor: pointer;" onclick="togglePasswordVisibility('sucpw', 'toggle_password')"></i>
                </div>
            </div>
            <div class="row">
                <label for="supw">Confirm Password</label>
                <div class="input-wrapper">
                    <input type="password" name="recep_pw_con" autocomplete="password" required="" id="supw" placeholder="Confirm Password">
                    <i class="far fa-eye" id="toggle_confirm_password" style="margin-left: -50px; cursor: pointer;" onclick="togglePasswordVisibility('supw', 'toggle_confirm_password')"></i>
                </div>
            </div>
            <div class="row">
                <button type="submit">Submit</button>
            </div>
        </form>
    </div>

</body>
</html>
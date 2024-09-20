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

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $conn->real_escape_string($_POST['nursefname']);
    $last_name = $conn->real_escape_string($_POST['nurselname']);
    $email = $conn->real_escape_string($_POST['nurseemail']);
    $phone = $conn->real_escape_string($_POST['nursephone']);
    $address = $conn->real_escape_string($_POST['nurseaddress']);
    $age = intval($_POST['nurseage']);
    $gender = $conn->real_escape_string($_POST['nursegender']);
    $raw_password = $_POST['nursepw'];

    $password_hash = password_hash($raw_password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO nurses (first_name, last_name, email, phone, address, age, gender, password) VALUES ('$first_name', '$last_name', '$email', '$phone', '$address', $age, '$gender', '$password_hash')";

    try {
        if ($conn->query($sql) === TRUE) {
            echo "<script type='text/javascript'>alert('Nurse added successfully!')</script>";
        } else {
            throw new mysqli_sql_exception($conn->error, $conn->errno);
        }
    } catch (mysqli_sql_exception $e) {
        if ($e->getCode() === 1062) {
            echo "<script type='text/javascript'>alert('Error adding nurse: Duplicate entry detected.')</script>";
        } else {
            echo "<script type='text/javascript'>alert('Error adding nurse: " . $e->getMessage() . "')</script>";
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
    <title>Admin | Add Nurse</title>

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
        <b><p><a href="view_nurse.php">View Nurses</a><br/>
        <b><p><a href="update_nurse.php">Update Nurse</a><br/>
        <b><p><a href="delete_nurse.php">Delete Nurse</a><br/>
        <b><p><a href="logout.php">Logout</a><br/>
    </div>

    <div class="container" style="margin-left: 38%;">
    <h1>Add Nurse</h1>
    <form id="nurseForm" method="POST" name="nursereg" onsubmit="return checkpasswordmem()" autocomplete="off" enctype="multipart/form-data">
        <div class="row">
            <label for="nursefname">Nurse First Name</label>
            <input type="text" id="nursefname" name="nursefname" placeholder="Enter Nurse's First Name" required>
        </div>
        <div class="row">
            <label for="nurselname">Nurse Last Name</label>
            <input type="text" id="nurselname" name="nurselname" placeholder="Enter Nurse's Last Name" required>
        </div>
        <div class="row">
            <label for="nursephone">Phone Number</label>
            <input type="number" id="nursephone" name="nursephone" placeholder="Enter Nurse's Contact Number" required>
        </div>
        <div class="row">
            <label for="nurseaddress">Address</label>
            <input type="text" id="nurseaddress" name="nurseaddress" placeholder="Enter Nurse's Home Address" required>
        </div>
        <div class="row">
            <label for="nurseemail">Email Address</label>
            <input type="email" id="nurseemail" name="nurseemail" placeholder="Enter Nurse's Email Address" required>
        </div>
        <div class="row">
            <label for="nurseage">Age</label>
            <input type="number" id="nurseage" name="nurseage" placeholder="Enter Nurse's Age" required>
        </div>
        <div class="row">
            <label for="nursegender">Gender</label>
            <select id="nursegender" style="padding: 10px;" name="nursegender" required>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
                <option value="Other">Other</option>
            </select>
        </div>
        <div class="row">
            <label for="sucpw">Create a password</label>
            <div class="input-wrapper">
            <input type="password" name="nursepw" autocomplete="password" required="" id="sucpw" placeholder="Create Password">
            <i class="far fa-eye" id="toggle_password" style="margin-left: -50px; cursor: pointer;" onclick="togglePasswordVisibility('sucpw', 'toggle_password')"></i>
        </div>
        </div>
        <div class="row">
            <label for="supw">Confirm Password</label>
            <div class="input-wrapper">
            <input type="password" name="nursepw_con" autocomplete="password" required="" id="supw" placeholder="Confirm Password">
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


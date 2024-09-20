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
    $first_name = $conn->real_escape_string($_POST['patfname']);
    $last_name = $conn->real_escape_string($_POST['patlname']);
    $email = $conn->real_escape_string($_POST['patemail']);
    $phone = $conn->real_escape_string($_POST['patphone']);
    $address = $conn->real_escape_string($_POST['pataddress']);
    $age = intval($_POST['patage']);
    $gender = $conn->real_escape_string($_POST['patgender']);
    $password = $conn->real_escape_string($_POST['patpw']);

    // Hash the password before storing it in the database
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO patients (first_name, last_name, email, phone, address, age, gender, password) VALUES ('$first_name', '$last_name', '$email', '$phone', '$address', $age, '$gender', '$hashed_password')";

    try {
        if ($conn->query($sql) === TRUE) {
            echo "<script type='text/javascript'>alert('Patient added successfully!')</script>";
        } else {
            throw new mysqli_sql_exception($conn->error, $conn->errno);
        }
    } catch (mysqli_sql_exception $e) {
        if ($e->getCode() === 1062) {
            echo "<script type='text/javascript'>alert('Error adding patient: Duplicate entry detected.')</script>";
        } else {
            echo "<script type='text/javascript'>alert('Error adding patient: " . $e->getMessage() . "')</script>";
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
    <title>Admin | Add Patient</title>

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
        <b><p><a href="view_patient.php">View Patients</a><br/>
        <b><p><a href="update_patient.php">Update Patient</a><br/>
        <b><p><a href="delete_patient.php">Delete Patient</a><br/>
        <b><p><a href="logout.php">Logout</a><br/>    
    </div> 

    <div class="container" style="margin-left: 38%;">
        <h1>Add Patient</h1>
        <form method="POST" action="insert_patient.php" name="patreg" onsubmit="return checkpasswordmem()" autocomplete="off" enctype="multipart/form-data">

            <div class="row">
                <label for="patfname">Patient First Name</label>
                <input type="text" id="patfname" name="patfname" placeholder="Enter Patient's First Name" required>
            </div>
            <div class="row">
                <label for="patlname">Patient Last Name</label>
                <input type="text" id="patlname" name="patlname" placeholder="Enter Patient's Last Name" required>
            </div>
            <div class="row">
                <label for="patphone">Phone Number</label>
                <input type="number" id="patphone" name="patphone" placeholder="Enter Patient's Contact Number" required>
            </div>
            <div class="row">
                <label for="pataddress">Address</label>
                <input type="text" id="pataddress" name="pataddress" placeholder="Enter Patient's Home Address" required>
            </div>
            <div class="row">
                <label for="patemail">Email Address</label>
                <input type="email" id="patemail" name="patemail" placeholder="Enter Patient's Email Address" required>
            </div>
            <div class="row">
                <label for="patage">Age</label>
                <input type="number" id="patage" name="patage" placeholder="Enter Patient's Age" required>
            </div>
            <div class="row">
                <label for="patgender">Gender</label>
                <select id="patgender" style="padding: 10px;" name="patgender" required>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    <option value="Other">Other</option>
                </select>
            </div>
            <div class="row">
                <label for="sucpw">Create a password</label>
                <div class="input-wrapper">
                <input type="password" name="patpw" autocomplete="password" required="" id="sucpw" placeholder="Create Password">
                <i class="far fa-eye" id="toggle_password" style="margin-left: -50px; cursor: pointer;" onclick="togglePasswordVisibility('sucpw', 'toggle_password')"></i>
            </div>
            </div>
            <div class="row">
                <label for="supw">Confirm Password</label>
                <div class="input-wrapper">
                <input type="password" name="patpw_con" autocomplete="password" required="" id="supw" placeholder="Confirm Password">
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



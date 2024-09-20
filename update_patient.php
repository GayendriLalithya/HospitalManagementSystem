<?php
// Include the connection file
require_once 'connection.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Get the submitted data from the form
    $patient_id = $_POST['patid'];
    $entered_password = $_POST['patpw'];

    // Check if the entered password matches the one in the database
    $sql = "SELECT password FROM patients WHERE patient_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $patient_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $stored_password = $row['password'];

        // Verify the entered password against the stored hashed password
        if (password_verify($entered_password, $stored_password)) {

            // Get the submitted data from the form
            $first_name = $_POST['patfname'];
            $last_name = $_POST['patlname'];
            $phone = $_POST['patphone'];
            $address = $_POST['pataddress'];
            $email = $_POST['patemail'];

            // Prepare the SQL statement for updating the patient's information
            $sql = "UPDATE patients SET first_name = ?, last_name = ?, phone = ?, address = ?, email = ? WHERE patient_id = ?";

            // Initialize a prepared statement
            $stmt = $conn->prepare($sql);

            // Bind the parameters to the statement
            $stmt->bind_param("sssssi", $first_name, $last_name, $phone, $address, $email, $patient_id);

            // Execute the prepared statement
            if ($stmt->execute()) {
                echo "<script>alert('Patient information updated successfully!');</script>";
            } else {
                echo "<script>alert('Error updating patient information!');</script>";
            }

            // Close the statement
            $stmt->close();
        } else {
            echo "<script>alert('Incorrect password!');</script>";
        }
    } else {
        echo "<script>alert('Patient not found!');</script>";
    }

    // Close the connection
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
    <title>Admin | Update Patient Info</title>

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
        <b><p><a href="insert_patient.php">Add Patient</a><br/>
        <b><p><a href="delete_patient.php">Delete Patient</a><br/>
        <b><p><a href="logout.php">Logout</a><br/>    
    </div> 

    <div class="container" style="margin-left: 38%;">
        <h1>Update Patient Information</h1>
        <form method="POST" action="update_patient.php" name="patreg" onsubmit="return checkpasswordmem()" autocomplete="off" enctype="multipart/form-data">
            <div class="row">
                <label for="patfname">Patient First Name</label>
                <input type="text" id="patfname" name="patfname" placeholder="Enter Patient's First Name" required>
            </div>
            <div class="row">
                <label for="patlname">Patient Last Name</label>
                <input type="text" id="patlname" name="patlname" placeholder="Enter Patient's Last Name" required>
            </div>
            <div class="row">
                <label for="patid">Patient ID</label>
                <input type="text" id="patid" name="patid" placeholder="Enter Patient's ID No" required>
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
                <label for="sucpw">Enter the password</label>
                <div class="input-wrapper">
                <input type="password" name="patpw" autocomplete="password" required="" id="sucpw" placeholder="Enter the Password">
                <i class="far fa-eye" id="toggle_password" style="margin-left: -50px; cursor: pointer;" onclick="togglePasswordVisibility('sucpw', 'toggle_password')"></i>
            </div>
            </div>
            <div class="row">
                <button type="submit">Submit</button>
            </div>
        </form>
    </div>
</body>
</html>

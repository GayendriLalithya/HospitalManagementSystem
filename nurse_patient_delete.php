<?php
include 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $patfname = $_POST["patfname"];
    $patlname = $_POST["patlname"];
    $patid = $_POST["patid"];
    $entered_password = $_POST["patpw"];

    $sql = "SELECT * FROM patients WHERE patient_id = ? AND first_name = ? AND last_name = ?";

    // Prepare statement
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("iss", $patid, $patfname, $patlname);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $stored_password = $row['password'];

            // Verify the entered password against the stored hashed password
            if (password_verify($entered_password, $stored_password)) {

                // Delete patient record
                $sql_delete = "DELETE FROM patients WHERE patient_id = ?";
                if ($delete_stmt = $conn->prepare($sql_delete)) {
                    $delete_stmt->bind_param("i", $patid);
                    try {
                        $delete_stmt->execute();
                        if ($delete_stmt->affected_rows > 0) {
                            echo "<script type='text/javascript'>alert('Patient Deleted Successfully!')</script>";
                        } else {
                            echo "<script type='text/javascript'>alert('Error Deleting Patient: " . $delete_stmt->error . "')</script>";
                        }
                    } catch (mysqli_sql_exception $e) {
                        if ($e->getCode() == 1451) {
                            echo "<script type='text/javascript'>alert('Cannot delete patient. The patient is associated with records in other tables.')</script>";
                        } else {
                            echo "<script type='text/javascript'>alert('Error Deleting Patient: " . $e->getMessage() . "')</script>";
                        }
                    }
                }

            } else {
                echo "<script type='text/javascript'>alert('Incorrect Password!')</script>";
            }

        } else {
            echo "<script type='text/javascript'>alert('Patient not found.')</script>";
        }

        $stmt->close();
    } else {
        echo "<script type='text/javascript'>alert('Error preparing SQL statement.')</script>";
    }
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
    <title>Nurse | Delete Patient</title>

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
        <b><p><a href="nurse_dashboard.php">Dashboard</a><br/>
        <b><p><a href="nurse_patient_view.php">View Patients</a><br/>
        <b><p><a href="nurse_patient_insert.php">Insert Patient</a><br/>
        <b><p><a href="nurse_patient_update.php">Update Patient</a><br/>
        <b><p><a href="logout.php">Logout</a><br/>    
    </div> 

    <div class="container" style="margin-left: 38%;">
        <h1>Delete Patient</h1>
        <form method="POST" action="nurse_patient_delete.php" name="patreg" onsubmit="return checkpasswordmem()" autocomplete="off" enctype="multipart/form-data">
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
                <label for="sucpw">Enter the Password</label>
                <div class="input-wrapper">
                <input type="password" name="patpw" autocomplete="password" required="" id="sucpw" placeholder="Enter the Password">
                <i class="far fa-eye" id="toggle_password" style="margin-left: -50px; cursor: pointer;" onclick="togglePasswordVisibility('sucpw', 'toggle_password')"></i>
            </div>
            </div>
            <div class="row">
                <button type="submit" class="red-btn">Delete</button>
            </div>
        </form>
    </div>
</body>
</html>

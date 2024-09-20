<?php
include 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $docfname = $_POST["docfname"];
    $doclname = $_POST["doclname"];
    $docid = $_POST["docid"];
    $entered_password = $_POST["docpw"];

    $sql = "SELECT * FROM doctors WHERE doctor_id = ? AND first_name = ? AND last_name = ?";

    // Prepare statement
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("iss", $docid, $docfname, $doclname);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $stored_password = $row['password'];

            // Verify the entered password against the stored hashed password
            if (password_verify($entered_password, $stored_password)) {

                // Delete doctor record
                $sql_delete = "DELETE FROM doctors WHERE doctor_id = ?";
                if ($delete_stmt = $conn->prepare($sql_delete)) {
                    $delete_stmt->bind_param("i", $docid);
                    try {
                        $delete_stmt->execute();
                        if ($delete_stmt->affected_rows > 0) {
                            echo "<script type='text/javascript'>alert('Doctor Deleted Successfully!')</script>";
                        } else {
                            echo "<script type='text/javascript'>alert('Error Deleting Doctor: " . $delete_stmt->error . "')</script>";
                        }
                    } catch (mysqli_sql_exception $e) {
                        if ($e->getCode() == 1451) {
                            echo "<script type='text/javascript'>alert('Cannot delete doctor. The doctor is associated with records in other tables.')</script>";
                        } else {
                            echo "<script type='text/javascript'>alert('Error Deleting Doctor: " . $e->getMessage() . "')</script>";
                        }
                    }
                }

            } else {
                echo "<script type='text/javascript'>alert('Incorrect Password!')</script>";
            }

        } else {
            echo "<script type='text/javascript'>alert('Doctor not found.')</script>";
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
    <title>Admin | Delete Doctor</title>

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
        <b><p><a href="view_doctor.php">View Doctors</a><br/>
        <b><p><a href="insert_doctor.php">Insert Doctor</a><br/>
        <b><p><a href="update_doctor.php">Update Doctor</a><br/>
        <b><p><a href="logout.php">Logout</a><br/>    
    </div> 

    <div class="container" style="margin-left: 38%;">
        <h1>Delete Doctor</h1>
        <form method="POST" action="delete_doctor.php" name="docreg" onsubmit="return checkpasswordmem()" autocomplete="off" enctype="multipart/form-data">
            <div class="row">
                <label for="docfname">Doctor First Name</label>
                <input type="text" id="docfname" name="docfname" placeholder="Enter Doctor's First Name" required>
            </div>
            <div class="row">
                <label for="doclname">Doctor Last Name</label>
                <input type="text" id="doclname" name="doclname" placeholder="Enter Doctor's Last Name" required>
            </div>
            <div class="row">
                <label for="docid">Doctor ID</label>
                <input type="text" id="docid" name="docid" placeholder="Enter Doctor's ID No" required>
            </div>
            <div class="row">
                <label for="sucpw">Enter the Password</label>
                <div class="input-wrapper">
                <input type="password" name="docpw" autocomplete="password" required="" id="sucpw" placeholder="Enter the Password" style="margin-left: 1px;">
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


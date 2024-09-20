<?php
include 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nursefname = $_POST["nursefname"];
    $nurselname = $_POST["nurselname"];
    $nurseid = $_POST["nurseid"];
    $entered_password = $_POST["nursepw"];

    $sql = "SELECT * FROM nurses WHERE nurse_id = ? AND first_name = ? AND last_name = ?";

    // Prepare statement
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("iss", $nurseid, $nursefname, $nurselname);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $stored_password = $row['password'];

            // Verify the entered password against the stored hashed password
            if (password_verify($entered_password, $stored_password)) {

                // Delete nurse record
                $sql_delete = "DELETE FROM nurses WHERE nurse_id = ?";
                if ($delete_stmt = $conn->prepare($sql_delete)) {
                    $delete_stmt->bind_param("i", $nurseid);
                    try {
                        $delete_stmt->execute();
                        if ($delete_stmt->affected_rows > 0) {
                            echo "<script type='text/javascript'>alert('Nurse Deleted Successfully!')</script>";
                        } else {
                            echo "<script type='text/javascript'>alert('Error Deleting Nurse: " . $delete_stmt->error . "')</script>";
                        }
                    } catch (mysqli_sql_exception $e) {
                        if ($e->getCode() == 1451) {
                            echo "<script type='text/javascript'>alert('Cannot delete nurse. The nurse is associated with records in other tables.')</script>";
                        } else {
                            echo "<script type='text/javascript'>alert('Error Deleting Nurse: " . $e->getMessage() . "')</script>";
                        }
                    }
                }

            } else {
                echo "<script type='text/javascript'>alert('Incorrect Password!')</script>";
            }

        } else {
            echo "<script type='text/javascript'>alert('Nurse not found.')</script>";
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
    <title>Admin | Delete Nurse</title>

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
    <b><p><a href="insert_nurse.php">Insert Nurse</a><br/>
    <b><p><a href="update_nurse.php">Update Nurse</a><br/>
    <b><p><a href="logout.php">Logout</a><br/>    
</div> 

<div class="container" style="margin-left: 38%;">
    <h1>Delete Nurse</h1>
    <form method="POST" action="delete_nurse.php" name="nursereg" onsubmit="return checkpasswordmem()" autocomplete="off" enctype="multipart/form-data">
        <div class="row">
            <label for="nursefname">Nurse First Name</label>
            <input type="text" id="nursefname" name="nursefname" placeholder="Enter Nurse's First Name" required>
        </div>
        <div class="row">
            <label for="nurselname">Nurse Last Name</label>
            <input type="text" id="nurselname" name="nurselname" placeholder="Enter Nurse's Last Name" required>
        </div>
        <div class="row">
            <label for="nurseid">Nurse ID</label>
            <input type="text" id="nurseid" name="nurseid" placeholder="Enter Nurse's ID No" required>
        </div>
        <div class="row">
            <label for="sucpw">Enter the Password</label>
            <div class="input-wrapper">
            <input type="password" name="nursepw" autocomplete="password" required="" id="sucpw" placeholder="Enter the Password" style="margin-left: 1px;">
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
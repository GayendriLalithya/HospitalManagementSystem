<?php
include 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $recfname = $_POST["recfname"];
    $reclname = $_POST["reclname"];
    $recid = $_POST["recid"];
    $entered_password = $_POST["recpw"];

    $sql = "SELECT * FROM receptionists WHERE receptionist_id = ? AND first_name = ? AND last_name = ?";

    // Prepare statement
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("iss", $recid, $recfname, $reclname);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $stored_password = $row['password'];

            // Verify the entered password against the stored hashed password
            if (password_verify($entered_password, $stored_password)) {

                // Delete receptionist record
                $sql_delete = "DELETE FROM receptionists WHERE receptionist_id = ?";
                if ($delete_stmt = $conn->prepare($sql_delete)) {
                    $delete_stmt->bind_param("i", $recid);
                    try {
                        $delete_stmt->execute();
                        if ($delete_stmt->affected_rows > 0) {
                            echo "<script type='text/javascript'>alert('Receptionist Deleted Successfully!')</script>";
                        } else {
                            echo "<script type='text/javascript'>alert('Error Deleting Receptionist: " . $delete_stmt->error . "')</script>";
                        }
                    } catch (mysqli_sql_exception $e) {
                        if ($e->getCode() == 1451) {
                            echo "<script type='text/javascript'>alert('Cannot delete receptionist. The receptionist is associated with records in other tables.')</script>";
                        } else {
                            echo "<script type='text/javascript'>alert('Error Deleting Receptionist: " . $e->getMessage() . "')</script>";
                        }
                    }
                }

            } else {
                echo "<script type='text/javascript'>alert('Incorrect Password!')</script>";
            }

        } else {
            echo "<script type='text/javascript'>alert('Receptionist not found.')</script>";
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
    <title>Admin | Delete Receptionist</title>
    
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
        <b><p><a href="insert_receptionist.php">Insert Receptionist</a><br/>
        <b><p><a href="update_receptionist.php">Update Receptionist</a><br/>
        <b><p><a href="logout.php">Logout</a><br/>   
    </div> 

    <div class="container" style="margin-left: 38%;">
        <h1>Delete Receptionist</h1>
        <form method="POST" action="delete_receptionist.php" name="recreg" onsubmit="return checkpasswordmem()" autocomplete="off" enctype="multipart/form-data">
            <div class="row">
                <label for="recfname">Receptionist First Name</label>
                <input type="text" id="recfname" name="recfname" placeholder="Enter Receptionist's First Name" required>
            </div>
            <div class="row">
                <label for="reclname">Receptionist Last Name</label>
                <input type="text" id="reclname" name="reclname" placeholder="Enter Receptionist's Last Name" required>
            </div>
            <div class="row">
                <label for="recid">Receptionist ID</label>
                <input type="text" id="recid" name="recid" placeholder="Enter Receptionist's ID No" required>
            </div>
            <div class="row">
                <label for="recpw">Enter the Password</label>
                <div class="input-wrapper">
                <input type="password" name="recpw" autocomplete="password" required="" id="recpw" placeholder="Enter the Password" style="margin-left: 1px;">
                <i class="far fa-eye" id="toggle_password" style="margin-left: -50px; cursor: pointer;" onclick="togglePasswordVisibility('recpw', 'toggle_password')"></i>
            </div>
            </div>
            <div class="row">
                <button type="submit" class="red-btn">Delete</button>
            </div>
        </form>
    </div>
</body>
</html>


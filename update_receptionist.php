<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/insert_patients.css">
    <!--Icons-->
    <link rel="stylesheet" href="css/all.min.css">
    <!-- <script src="https://kit.fontawesome.com/ec0debbca9.js" crossorigin="anonymous"></script> -->
    <title>Admin | Update Receptionist Info</title>
    <style>
    .sidenav a {
        padding: 8px 8px 8px 32px;
        text-decoration: none;
        font-size: 25px;
        color: #CCC;
        display: block;
        transition: 0.3s;
        font-family: Arial, sans-serif;
        padding-top: 35px;}
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
        <b><p><a href="insert_receptionist.php">Add Receptionist</a><br/>
        <b><p><a href="delete_receptionist.php">Delete Receptionist</a><br/>
        <b><p><a href="logout.php">Logout</a><br/>    
    </div> 

    <div class="container" style="margin-left: 38%;">
        <h1>Update Receptionist Information</h1>
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" name="recreg" onsubmit="return checkpasswordmem()" autocomplete="off" enctype="multipart/form-data">
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
                <label for="recphone">Phone Number</label>
                <input type="number" id="recphone" name="recphone" placeholder="Enter Receptionist's Contact Number" required>
            </div>
            <div class="row">
                <label for="recaddress">Address</label>
                <input type="text" id="recaddress" name="recaddress" placeholder="Enter Receptionist's Home Address" required>
            </div>
            <div class="row">
                <label for="recemail">Email Address</label>
                <input type="email" id="recemail" name="recemail" placeholder="Enter Receptionist's Email Address" required>
            </div>
            <div class="row">
                <label for="sucpw">Enter the Password</label>
                <div class="input-wrapper">
                    <input type="password" name="recpw" autocomplete="password" required="" id="sucpw" placeholder="Enter the Password">
                    <i class="far fa-eye" id="toggle_password" style="margin-left: -50px; cursor: pointer;" onclick="togglePasswordVisibility('sucpw', 'toggle_password')"></i>
                </div>
            </div>
            <div class="row">
                <button type="submit" name="submit">Submit</button>
            </div>
        </form>
    </div>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
        // Include the connection file
        require_once "connection.php";

        // Get the form data
        $receptionist_id = $_POST["recid"];
        $first_name = $_POST["recfname"];
        $last_name = $_POST["reclname"];
        $phone = $_POST["recphone"];
        $address = $_POST["recaddress"];
        $email = $_POST["recemail"];
        $password = $_POST["recpw"];

        // Check if entered password matches the hashed password stored in the database
        $check_password_sql = "SELECT password FROM receptionists WHERE receptionist_id = ?";
        if ($check_password_stmt = $conn->prepare($check_password_sql)) {
            $check_password_stmt->bind_param("i", $receptionist_id);
            $check_password_stmt->execute();
            $check_password_stmt->bind_result($hashed_password);
            $check_password_stmt->fetch();
            $check_password_stmt->close();

            if (!password_verify($password, $hashed_password)) {
                echo "<script>alert('Incorrect password!');</script>";
                $conn->close();
                exit();
            }
        }

        // Update the receptionist's information in the database
        $sql = "UPDATE receptionists SET first_name = ?, last_name = ?, phone = ?, address = ?, email = ? WHERE receptionist_id  = ?";

        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("sssssi", $first_name, $last_name, $phone, $address, $email, $receptionist_id);

            if ($stmt->execute()) {
                echo "<script>alert('Receptionist information updated successfully!');</script>";
            } else {
                echo "<script>alert('Error updating receptionist information!');</script>";
            }

            // Close the statement
            $stmt->close();
        } else {
            echo "<script>alert('Error preparing the SQL statement!');</script>";
        }

        // Close the connection
        $conn->close();
    }
    ?>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/insert_patients.css">
    <!--Icons-->
    <link rel="stylesheet" href="css/all.min.css">
    <!-- <script src="https://kit.fontawesome.com/ec0debbca9.js" crossorigin="anonymous"></script> -->
    <title>Admin | Update Nurse Info</title>

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
        <b><p><a href="insert_nurse.php">Add Nurse</a><br/>
        <b><p><a href="delete_nurse.php">Delete Nurse</a><br/>
        <b><p><a href="logout.php">Logout</a><br/>    
    </div> 

    <div class="container" style="margin-left: 38%;">
        <h1>Update Nurse Information</h1>
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" name="nursereg" onsubmit="return checkpasswordmem()" autocomplete="off" enctype="multipart/form-data">
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
                <label for="sucpw">Enter the Password</label>
                <div class="input-wrapper">
                <input type="password" name="nursepw" autocomplete="password" required="" id="sucpw" placeholder="Enter the Password">
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
        $nurse_id = $_POST["nurseid"];
        $first_name = $_POST["nursefname"];
        $last_name = $_POST["nurselname"];
        $phone = $_POST["nursephone"];
        $address = $_POST["nurseaddress"];
        $email = $_POST["nurseemail"];
        $entered_password = $_POST["nursepw"];

        // Check if the entered password matches the hashed password stored in the database
        $sql_check = "SELECT password FROM nurses WHERE nurse_id = ?";
        if ($check_stmt = $conn->prepare($sql_check)) {
            $check_stmt->bind_param("i", $nurse_id);
            $check_stmt->execute();
            $result = $check_stmt->get_result();

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $stored_password = $row['password'];

                // Verify the entered password against the stored hashed password
                if (password_verify($entered_password, $stored_password)) {
                    // Update the nurse's information in the database
                    $sql = "UPDATE nurses SET first_name = ?, last_name = ?, phone = ?, address = ?, email = ? WHERE nurse_id  = ?";
                    if ($stmt = $conn->prepare($sql)) {
                        $stmt->bind_param("sssssi", $first_name, $last_name, $phone, $address, $email, $nurse_id);

                        if ($stmt->execute()) {
                            echo "<script>alert('Nurse information updated successfully!');</script>";
                        } else {
                            echo "<script>alert('Error updating nurse information!');</script>";
                        }

                        // Close the statement
                        $stmt->close();
                    } else {
                        echo "<script>alert('Error preparing the SQL statement!');</script>";
                    }
                } else {
                    echo "<script>alert('Incorrect Password!');</script>";
                }
            } else {
                echo "<script>alert('Nurse not found.');</script>";
            }

            // Close the check statement
            $check_stmt->close();
        } else {
            echo "<script>alert('Error preparing the SQL statement!');</script>";
        }

        // Close the connection
        $conn->close();
    }
    ?>
</body>
</html>


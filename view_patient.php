<?php
require_once 'connection.php';

// Your code that interacts with the database here
$sql = "SELECT * FROM patients";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | View Patients</title>
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
    <link rel="stylesheet" href="./css/view.css">
</head>
<body>
<div class="sidenav">
    <p><a href="index.php">Home</a><br/>
    <p><a href="admin_dashboard.php">Dashboard</a><br/>
    <p><a href="insert_patient.php">Add Patient</a><br/>
    <p><a href="update_patient.php">Update Patient</a><br/>
    <p><a href="delete_patient.php">Delete Patient</a><br/>
    <p><a href="logout.php">Logout</a><br/>    
</div>  

<div class="main-content">
    <div class="container" style="margin-left: 5%;">
        <div class="search-container">
            <form action="search_patients.php" method="POST">
                <input type="text" name="search" id="search" placeholder="Search patients by first name..." style="width: 800px;">
                <button type="submit" style="width: 200px;"><i class="fas fa-search"></i> Search</button>
            </form>
        </div>
    </div>

    <div class="container" style="margin-left: 5%;">
        <h1>All Patients</h1>
        <hr>
        
        <div class="form-group">
            <form action="view_patient.php" method="POST"></form>
        </div>
        
        <!-- Displaying the patients data -->
        <?php
        if ($result->num_rows > 0) {
            echo "<table border='1'>
                    <tr>
                        <th>Patient ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>Age</th>
                        <th>Gender</th>
                    </tr>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>" . $row['patient_id'] . "</td>
                        <td>" . $row['first_name'] . "</td>
                        <td>" . $row['last_name'] . "</td>
                        <td>" . $row['email'] . "</td>
                        <td>" . $row['phone'] . "</td>
                        <td>" . $row['address'] . "</td>
                        <td>" . $row['age'] . "</td>
                        <td>" . $row['gender'] . "</td>
                    </tr>";
            }
            echo "</table>";
        } else {
            echo "0 results";
        }
        ?>
    </div>
</div>
</body>
</html>

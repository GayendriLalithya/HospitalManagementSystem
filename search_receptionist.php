<?php
require_once 'connection.php';

$search = isset($_POST['search_receptionists']) ? $_POST['search_receptionists'] : '';

$sql = "SELECT * FROM receptionists WHERE first_name LIKE '%$search%' OR last_name LIKE '%$search%' OR email LIKE '%$search%'";

$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | Search Receptionists</title>
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
    <link rel="stylesheet" href="./css/view.css">
</head>
<body>
<div class="sidenav">
        <b><p><a href="index.php">Home</a><br/>
        <b><p><a href="admin_dashboard.php">Dashboard</a><br/>
        <b><p><a href="insert_receptionist.php">Add Receptionist</a><br/>
        <b><p><a href="update_receptionist.php">Update Receptionist</a><br/>
        <b><p><a href="delete_receptionist.php">Delete Receptionist</a><br/>
        <b><p><a href="view_receptionist.php">View Receptionists</a><br/>
        <b><p><a href="logout.php">Logout</a><br/>    
    </div> 

    <div class="main-content">
    <div class="container" style="margin-left: 5%;">
        <h1>Search Results</h1>
        <hr>
        
        <!-- Displaying the search results -->
        <?php
        if (mysqli_num_rows($result) > 0) {
            echo "<table>";
            echo "<tr>";
            echo "<th>ID</th>";
            echo "<th>First Name</th>";
            echo "<th>Last Name</th>";
            echo "<th>Email</th>";
            echo "<th>Phone</th>";
            echo "<th>Address</th>";
            echo "</tr>";

            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row['receptionist_id'] . "</td>";
                echo "<td>" . $row['first_name'] . "</td>";
                echo "<td>" . $row['last_name'] . "</td>";
                echo "<td>" . $row['email'] . "</td>";
                echo "<td>" . $row['phone'] . "</td>";
                echo "<td>" . $row['address'] . "</td>";
                echo "</tr>";
            }

            echo "</table>";
        } elseif (isset($search)) {
            echo "<p>No results found.</p>";
        }
        mysqli_close($conn);
        ?>
    </div>
    </div>
</body>
</html>

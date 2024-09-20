<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | View Doctors</title>
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
    <link rel="stylesheet" href="./css/view.css">

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
</head>
<body>

    <div class="sidenav">
        <b><p><a href="index.php">Home</a><br/>
        <b><p><a href="admin_dashboard.php">Dashboard</a><br/>
        <b><p><a href="insert_doctor.php">Add Doctor</a><br/>
        <b><p><a href="update_doctor.php">Update Doctor</a><br/>
        <b><p><a href="delete_doctor.php">Delete Doctor</a><br/>
        <b><p><a href="logout.php">Logout</a><br/>    
    </div> 

    <div class="main-content">
    <div class="container" style="margin-left: 5%;">
        <div class="search-container">
        <form action="search_doctors.php" method="POST">
            <input type="text" name="search_doctors" id="search_doctors" placeholder="Search doctors..." style="width: 800px;">
            <button type="submit" style="width: 200px;"><i class="fas fa-search"></i> Search</button>
        </form>

        </div>
    </div>

    <div class="container" style="margin-left: 5%;">
        <h1>All Doctors</h1>
        <hr>
        
        <div class="form-group">
            <form action="view_doctor.php" method="POST"></form>
        </div>
        <!-- Displaying the doctors data -->
        <?php
        require_once 'connection.php';

        $sql = "SELECT * FROM doctors";
        $result = mysqli_query($conn, $sql);

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
                echo "<td>" . $row['doctor_id'] . "</td>";
                echo "<td>" . $row['first_name'] . "</td>";
                echo "<td>" . $row['last_name'] . "</td>";
                echo "<td>" . $row['email'] . "</td>";
                echo "<td>" . $row['phone'] . "</td>";
                echo "<td>" . $row['address'] . "</td>";
                echo "</tr>";
            }

            echo "</
            table>";
        } else {
        echo "<p>No doctors found.</p>";
        }
        mysqli_close($conn);
        ?>
        </div>
    </div>
    </body>
</html>    
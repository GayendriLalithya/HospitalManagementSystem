<?php
require_once 'connection.php';

$sql = "SELECT availability.availability_id, CONCAT(doctors.first_name, ' ', doctors.last_name) AS doctor_name, availability.date, availability.start_time, availability.end_time, availability.status FROM availability JOIN doctors ON availability.doctor_id = doctors.doctor_id ORDER BY availability.date, availability.start_time";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient | View Availability</title>
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
        <b><p><a href="patient_dashboard.php">Dashboard</a><br/>
        <b><p><a href="logout.php">Logout</a><br/>    
    </div> 

    <div class="main-content">
    

    <div class="container" style="margin-left: 5%;">
        <h1>All Doctors Availability</h1>
        <hr>
        
        <div class="form-group">
            <form action="doctor_availability_view.php" method="POST"></form>
        </div>
        <!-- Displaying the doctors data -->
        <table>
                <thead>
                    <tr>
                        <th>Availability ID</th>
                        <th>Doctor Name</th>
                        <th>Date</th>
                        <th>Start Time</th>
                        <th>End Time</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row["availability_id"] . "</td>";
                            echo "<td>" . $row["doctor_name"] . "</td>";
                            echo "<td>" . $row["date"] . "</td>";
                            echo "<td>" . $row["start_time"] . "</td>";
                            echo "<td>" . $row["end_time"] . "</td>";
                            echo "<td>" . $row["status"] . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6'>No records found</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>
<?php
require_once 'connection.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient | Room Availability</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
    <link rel="stylesheet" href="./css/view.css">
</head>
<body>

    <div class="sidenav">
        <b><p><a href="index.php">Home</a><br/>
        <b><p><a href="patient_dashboard.php">Dashboard</a><br/>
        <b><p><a href="index.php">Logout</a><br/>    
    </div> 

    <div class="main-content">
        
    <div class="container" style="margin-left: 5%;">
        <h1>Room Availability</h1>
        <hr>
        
        <div class="form-group">
            <form action="patient_room.php" method="POST"></form>
        </div>
        
        
        <table>
        <thead>
            <tr>
                <th>Room Number</th>
                <th>Room Type</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT * FROM rooms";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["room_number"] . "</td>";
                    echo "<td>" . $row["room_type"] . "</td>";
                    echo "<td>" . $row["status"] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='3'>No rooms found.</td></tr>";
            }

            $conn->close();
            ?>
        </tbody>
    </table>
    </div>
</div>

</body>
</html>
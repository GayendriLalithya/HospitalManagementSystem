<?php
require_once 'connection.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nurse | Medical History</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
    <link rel="stylesheet" href="./css/view.css">
</head>
<body>

    <div id="mySidenav" class="sidenav" class="background">
        <b><p><a href="index.php">Home</a><br/>
        <b><p><a href="nurse_dashboard.php">Dashboard</a><br/>
        <b><p><a href="records_update.php">Update Records</a><br/>
        <b><p><a href="records_insert.php">Insert Records</a><br/>
        <b><p><a href="logout.php">Logout</a><br/>    
    </div> 

    <div class="main-content">
    <div class="container" style="margin-left: 5%;">
        <h1>Medical History</h1>
        <hr>
        
        <div class="form-group">
            <form action="patient_history.php" method="POST"></form>
        </div>
        
        <!-- Displaying the patients data -->
        <table>
                <thead>
                    <tr>
                        <th>Record ID</th>
                        <th>Date</th>
                        <th>Doctor Name</th>
                        <th>Patient Name</th>
                        <th>Diagnosis</th>
                        <th>Treatment</th>
                        <th>Notes</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include 'connection.php';

                    $sql = "SELECT medical_history.record_id, medical_history.date, CONCAT(doctors.first_name, ' ', doctors.last_name) AS doctor_name, CONCAT(patients.first_name, ' ', patients.last_name) AS patient_name, medical_history.diagnosis, medical_history.treatment, medical_history.notes
                            FROM medical_history
                            JOIN doctors ON medical_history.doctor_id = doctors.doctor_id
                            JOIN patients ON medical_history.patient_id = patients.patient_id";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row["record_id"] . "</td>";
                            echo "<td>" . $row["date"] . "</td>";
                            echo "<td>" . $row["doctor_name"] . "</td>";
                            echo "<td>" . $row["patient_name"] . "</td>";
                            echo "<td>" . $row["diagnosis"] . "</td>";
                            echo "<td>" . $row["treatment"] . "</td>";
                            echo "<td>" . $row["notes"] . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='7'>No medical history found.</td></tr>";
                    }

                    $conn->close();
                    ?>
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>

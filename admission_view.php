<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nurse | All Admissions</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
    <link rel="stylesheet" href="./css/view.css">

    <style>
        <style>
    .admissions-list {
    max-width: 600px;
    margin: 30px auto;
    background-color: #fff;
    padding: 30px;
    border-radius: 10px;
    border: 2px solid #ccc;
}

.admissions-list h2 {
    color: #333;
    font-size: 20px;
    text-align: center;
    margin-bottom: 20px;
}

.admission-actions {
    max-width: 600px;
    margin: 30px auto;
    background-color: #fff;
    padding: 30px;
    border-radius: 10px;
    border: 2px solid #ccc;
}

.admission-actions label {
    color: #333;
    font-size: 16px;
    display: block;
    margin-bottom: 5px;
}

.admission-actions select {
    font-size: 14px;
    padding: 10px;
    width: 100%;
    border: 1px solid #ccc;
    border-radius: 5px;
    margin-bottom: 20px;
}

button {
    width: 100%;
    padding: 10px;
    font-size: 16px;
    font-weight: bold;
    color: #fff;
    background-color: #3391E7;
    border: 1px solid #000;
    border-radius: 5px;
    cursor: pointer;
    margin-right: 5%;
    margin-top: 10px;
}

button:hover {
    background-color: #fff;
    color: #000;
}

.red-btn {
    width: 100%;
    padding: 10px;
    font-size: 16px;
    font-weight: bold;
    color: #fff;
    background-color: #c61616;
    border: 1px solid #000;
    border-radius: 5px;
    cursor: pointer;
}

input[type="date"],
input[type="time"],
textarea {
    border: 1px solid #ccc;
    border-radius: 4px;
    padding: 10px;
    width: 95%;
    font-size: 14px;
    margin: 10px;
}

label{
    text-align: left;
    
}

</style>
    </style>
</head>
<body>

    <div class="sidenav">
        <b><p><a href="index.php">Home</a><br/>
        <b><p><a href="nurse_dashboard.php">Dashboard</a><br/>
        <b><p><a href="nurse_admission.php">Admission Form</a><br/>
        <b><p><a href="logout.php">Logout</a><br/>    
    </div> 

    <div class="main-content">
    <div class="container" style="margin-left: 5%;">
        <h1>All Admissions</h1>
        <hr>
        
        <div class="form-group">
            <form action="admission_view.php" method="POST"></form>
        </div>
        
        <!-- Displaying the admissions data -->
        <table id="admissions-table">
            <thead>
                <tr>
                    <th>Admission ID</th>
                    <th>Patient Name</th>
                    <th>Room ID</th>
                    <th>Nurse Name</th>
                    <th>Admission Date</th>
                    <th>Admission Time</th>
                    <th>Discharge Date</th>
                    <th>Discharge Time</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include 'connection.php';
                $sql = "SELECT admission.admission_id, CONCAT(patients.first_name, ' ', patients.last_name) AS patient_name, admission.room_id, CONCAT(nurses.first_name, ' ', nurses.last_name) AS nurse_name, admission.admission_date, admission.admission_time, admission.discharge_date, admission.discharge_time
                        FROM admission
                        JOIN nurses ON admission.nurse_id = nurses.nurse_id
                        JOIN patients ON admission.patient_id = patients.patient_id";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['admission_id'] . "</td>";
                        echo "<td>" . $row['patient_name'] . "</td>";
                        echo "<td>" . $row['room_id'] . "</td>";
                        echo "<td>" . $row['nurse_name'] . "</td>";
                        echo "<td>" . $row['admission_date'] . "</td>";
                        echo "<td>" . $row['admission_time'] . "</td>";
                        echo "<td>" . $row['discharge_date'] . "</td>";
                        echo "<td>" . $row['discharge_time'] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='8'>No admissions found</td></tr>";
                }
                $conn->close();
                ?>
            </tbody>
        </table>
    </div>
    </div>
</body>
</html>    
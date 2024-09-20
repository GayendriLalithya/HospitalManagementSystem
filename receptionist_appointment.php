<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receptionist | Appointments</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
    <link rel="stylesheet" href="./css/view.css">

    <style>
    .appointments-list {
    max-width: 600px;
    margin: 30px auto;
    background-color: #fff;
    padding: 30px;
    border-radius: 10px;
    border: 2px solid #ccc;
}

.appointments-list h2 {
    color: #333;
    font-size: 20px;
    text-align: center;
    margin-bottom: 20px;
}

.appointment-actions {
    max-width: 600px;
    margin: 30px auto;
    background-color: #fff;
    padding: 30px;
    border-radius: 10px;
    border: 2px solid #ccc;
}

.appointment-actions label {
    color: #333;
    font-size: 16px;
    display: block;
    margin-bottom: 5px;
}

.appointment-actions select {
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
</head>
<body>

    <div class="sidenav">
        <b><p><a href="index.php">Home</a><br/>
        <b><p><a href="receptionist_dashboard.php">Dashboard</a><br/>
        <b><p><a href="logout.php">Logout</a><br/>    
    </div> 

    <div class="main-content">
    <div class="container" style="margin-left: 5%;">
        <h1>All Appointments</h1>
        <hr>
        
        <div class="form-group">
            <form action="appointments.php" method="POST"></form>
        </div>
        
        <!-- Displaying the appointments data -->
        <table id="appointments-table">
            <thead>
                <tr>
                    <th>Appointment ID</th>
                    <th>Patient Name</th>
                    <th>Doctor Name</th>
                    <th>Date</th>
                    <th>Start Time</th>
                    <th>End Time</th>
                    <th>Symptoms</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include 'connection.php';
                $sql = "SELECT appointments.appointment_id, CONCAT(patients.first_name, ' ', patients.last_name) AS patient_name, CONCAT(doctors.first_name, ' ', doctors.last_name) AS doctor_name, appointments.date, appointments.start_time, appointments.end_time, appointments.symptoms, appointments.status
                        FROM appointments
                        JOIN doctors ON appointments.doctor_id = doctors.doctor_id
                        JOIN patients ON appointments.patient_id = patients.patient_id";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['appointment_id'] . "</td>";
                        echo "<td>" . $row['patient_name'] . "</td>";
                        echo "<td>" . $row['doctor_name'] . "</td>";
                        echo "<td>" . $row['date'] . "</td>";
                        echo "<td>" . $row['start_time'] . "</td>";
                        echo "<td>" . $row['end_time'] . "</td>";
                        echo "<td>" . $row['symptoms'] . "</td>";
                        echo "<td>" . $row['status'] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='8'>No appointments found</td></tr>";
                }
                $conn->close();
                ?>
            </tbody>
        </table>
    </div>
    </div>
    <div class="main-content">
        <div class="container" style="margin-left: 5%;">
            <div class="appointment-actions">
                <form method="POST" action="appointment_delete.php">
                    <label for="appointment-select">Select Appointment:</label>
                    <select id="appointment-select" name="appointment_id">
                        <option value="">--Choose the Appointment ID--</option>
                        <?php
                        // Connect to the database
                        $con = mysqli_connect("localhost", "root", "", "arogya_hms");
                            
                        // Get all appointments from the appointments table
                        $sql_appointments = "SELECT * FROM `appointments`";
                        $all_appointments = mysqli_query($con, $sql_appointments);
                            
                        // Use a while loop to fetch data
                        // from the $all_appointments variable
                        // and individually display as an option
                        while ($appointment = mysqli_fetch_array($all_appointments, MYSQLI_ASSOC)) {
                            $appointment_id = $appointment["appointment_id"];
                            $appointment_id = $appointment["appointment_id"];
                            echo "<option value=\"$appointment_id\">$appointment_id</option>";
                        }
                        ?>
                        </select>
                    <button id="delete-appointment" class="red-btn" type="submit" name="delete">Delete Appointment</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>    
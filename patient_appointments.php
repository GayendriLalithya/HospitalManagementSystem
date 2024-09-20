<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'connection.php';

    if (isset($_POST['action']) && $_POST['action'] == 'cancel') {
        $appointment_id = $_POST['appointment_id'];
        $date = $_POST['date'];
        $start_time = $_POST['stime'];
        $end_time = $_POST['etime'];

        $sql = "UPDATE appointments SET date=?, start_time=?, end_time=?, status='Cancelled' WHERE appointment_id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssi", $date, $start_time, $end_time, $appointment_id);

        if ($stmt->execute()) {
            echo "<script type='text/javascript'>alert('Appointment Canceled Successfully!')</script>";
        } else {
            echo "<script type='text/javascript'>alert('Error Canceling Appointment: " . $stmt->error . "')</script>";
        }

    } elseif (isset($_POST['action']) && $_POST['action'] == 'reschedule') {
        $appointment_id = $_POST['appointment_id'];
        $date = $_POST['date'];
        $start_time = $_POST['stime'];
        $end_time = $_POST['etime'];

        $sql = "UPDATE appointments SET date=?, start_time=?, end_time=?, status='Rescheduled' WHERE appointment_id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssi", $date, $start_time, $end_time, $appointment_id);

        if ($stmt->execute()) {
            echo "<script type='text/javascript'>alert('Appointment Rescheduled Successfully!')</script>";
        } else {
            echo "<script type='text/javascript'>alert('Error Rescheduling Appointment: " . $stmt->error . "')</script>";
        }
    }

    $stmt->close();
    $conn->close();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patients | Appointments</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
    <link rel="stylesheet" href="./css/view.css">
</head>

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
<body>

    <div id="mySidenav" class="sidenav" class="background">
        <b><p><a href="index.php">Home</a><br/>
        <b><p><a href="patient_dashboard.php">Dashboard</a><br/>
        <b><p><a href="logout.php">Logout</a><br/>    
    </div> 
<div class="main-content">
    <div class="container" style="margin-left: 5%;">
        <h1>My Appointments</h1>
        
            
            <!-- Display the appointments table  -->
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
    <div class="container" style="margin-left: 5%;" >
    <div class="appointment-actions">
        <label for="appointment-select">Select Appointment:</label>
        <select id="appointment-select">
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

        <form id="appointment-form" method="POST" action="patient_appointments.php">
            <input type="hidden" id="action" name="action">
            <input type="hidden" id="appointment_id" name="appointment_id">
                        <div class="form-group row">
                            <label class="col-sm-4 col-lg-4">
                                Date
                            </label>
                            <div class="col-sm-8 col-lg-8">
                                <input type="date" id="date" name="date" class="form-control">
                            </div>
                        </div>
                        <!---->
                        <div class="form-group row">
                            <label class="col-sm-4 col-lg-4">
                                Start Time
                            </label>
                            <div class="col-sm-8 col-lg-8">
                                <input type="time" id="stime" name="stime" class="form-control">
                            </div>
                        </div>
                        <!---->
                        <div class="form-group row">
                            <label class="col-sm-4 col-lg-4">
                                End Time
                            </label>
                            <div class="col-sm-8 col-lg-8">
                                <input type="time" id="etime" name="etime" class="form-control">
                            </div>
                        </div>
                    </form>
                    
                    <button type="submit" id="cancel-appointment" class="red-btn">Cancel Appointment</button>
        <button type="submit" id="reschedule-appointment">Reschedule Appointment</button>

    </div>
    </div>

    <script>
    const appointmentSelect = document.getElementById('appointment-select');
    const cancelAppointmentBtn = document.getElementById('cancel-appointment');
    const rescheduleAppointmentBtn = document.getElementById('reschedule-appointment');
    const appointmentForm = document.getElementById('appointment-form');
    const actionInput = document.getElementById('action');
    const appointmentIdInput = document.getElementById('appointment_id');

    cancelAppointmentBtn.addEventListener('click', () => {
        if (appointmentSelect.value) {
            actionInput.value = 'cancel';
            appointmentIdInput.value = appointmentSelect.value;
            appointmentForm.submit();
        } else {
            alert('Please select an appointment to cancel.');
        }
    });

    rescheduleAppointmentBtn.addEventListener('click', () => {
        if (appointmentSelect.value) {
            actionInput.value = 'reschedule';
            appointmentIdInput.value = appointmentSelect.value;
            appointmentForm.submit();
        } else {
            alert('Please select an appointment to reschedule.');
        }
    });
</script>

</body>
</html>

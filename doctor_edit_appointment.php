<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor | Update Appointments</title>
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
input[type="number"],
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
        <b><p><a href="doctor_dashboard.php">Dashboard</a><br/>
        <b><p><a href="appointments.php">View Appointments</a><br/>
        <b><p><a href="logout.php">Logout</a><br/>    
    </div> 

    <div class="main-content">
        <div class="container" style="margin-left: 5%;">
            <form id="appointment-form" method="POST" action="appointment_update.php">
                <div class="appointment-actions">
                    <label for="doctor-select">Select Doctor:</label>
                    <select id="doctor-select" name="doctor_id">
                        <option value="">--Choose a Doctor--</option>
                            <?php
                                // Connect to the database
                                $con = mysqli_connect("localhost", "root", "", "arogya_hms");

                                // Get all doctors from the doctors table
                                $sql_doctors = "SELECT * FROM `doctors`";
                                $all_doctors = mysqli_query($con, $sql_doctors);

                                // Use a while loop to fetch data
                                // from the $all_doctors variable
                                // and individually display as an option
                                while ($doctor = mysqli_fetch_array($all_doctors, MYSQLI_ASSOC)) {
                                    $doctor_id = $doctor["doctor_id"];
                                    $doctor_name = $doctor["first_name"] . " " . $doctor["last_name"];
                                    echo "<option value=\"$doctor_id\">$doctor_name</option>";
                                }
                                ?>
                        </select>

                        <label for="patient-select">Select Patient:</label>
                        <select id="patient-select" name="patient_id">
                        <option value="">--Choose a Patient--</option>
                        <?php
                            // Connect to the database
                            $con = mysqli_connect("localhost", "root", "", "arogya_hms");

                            // Get all patients from the patients table
                            $sql_patients = "SELECT * FROM `patients`";
                            $all_patients = mysqli_query($con, $sql_patients);

                            // Use a while loop to fetch data
                            // from the $all_patients variable
                            // and individually display as an option
                            while ($patient = mysqli_fetch_array($all_patients, MYSQLI_ASSOC)) {
                                $patient_id = $patient["patient_id"];
                                $patient_name = $patient["first_name"] . " " . $patient["last_name"];
                                echo "<option value=\"$patient_id\">$patient_name</option>";
                            }
                            ?>
                        </select>
                    
                    <input type="hidden" id="action" name="action">
                    <!-- <input type="hidden" id="doctor_id" name="doctor_id">
                    <input type="hidden" id="patient_id" name="patient_id"> -->
                    <div class="form-group row">

                        <label for="appointment_id">Appointment ID:</label>
                        <input type="number" id="appointment_id" name="appointment_id">

                        <label for="date-select">Date:</label>
                        <input type="date" id="date-select" name="date">
                        
                        <label for="start-time">Start Time:</label>
                        <input type="time" id="start-time" name="start_time">
                        
                        <label for="end-time">End Time:</label>
                        <input type="time" id="end-time" name="end_time">
                    
                        <label for="symptoms">Symptoms:</label>
                        <textarea id="symptoms" name="symptoms" class="form-control" required></textarea>   
                    </div>

                    <div class="form-group">
                        <label for="status">Status</label>
                        <select id="status" name="status">
                            <option value="Scheduled">Scheduled</option>
                            <option value="Rescheduled">Rescheduled</option>
                            <option value="Cancelled">Cancelled</option>
                            <option value="Completed">Completed</option>
                        </select>
                    </div>
                        
                    <button type="submit" name="submit" id="update-appointment">Update Appointment</button>
            </form>
        </div>
    </div>
</body>
</html>
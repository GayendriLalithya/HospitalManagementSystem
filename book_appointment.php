<?php
error_reporting(E_ALL);

require_once 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $patient_name = $_POST["patient-name"];
    $contact = $_POST["contact"];
    $doctor_id = $_POST["doctor"];
    $date = $_POST["date"];
    $stime = $_POST["stime"];
    $etime = $_POST["etime"];
    $symptoms = $_POST["symptoms"];
    
    // Get patient_id based on the patient's name
    $patient_id_query = "SELECT patient_id FROM patients WHERE CONCAT(first_name, ' ', last_name) = ?";
    $patient_id_stmt = $conn->prepare($patient_id_query);
    $patient_id_stmt->bind_param("s", $patient_name);
    $patient_id_stmt->execute();
    $patient_id_result = $patient_id_stmt->get_result();

    if ($patient_id_result->num_rows === 0) {
        echo "<script type='text/javascript'>alert('Error: Patient not found. Please check the name entered.')</script>";
    } else {
        $patient_id_row = $patient_id_result->fetch_assoc();
        $patient_id = $patient_id_row['patient_id'];
        $patient_id_stmt->close();

        // Insert appointment data into the database
        $sql = "INSERT INTO appointments (patient_id, doctor_id, date, start_time, end_time, symptoms, status) VALUES (?, ?, ?, ?, ?, ?, 'Scheduled')";
        
        $stmt = $conn->prepare($sql);
        if ($stmt === false) {
            die("Error: " . htmlspecialchars($conn->error));
        }
        
        $stmt->bind_param("iissss", $patient_id, $doctor_id, $date, $stime, $etime, $symptoms);
        
        if ($stmt->execute()) {
            echo "<script type='text/javascript'>alert('Appointment Booked Successfully!')</script>";
        } else {
            echo "<script type='text/javascript'>alert('Error Booking Appointment: " . $stmt->error . "')</script>";
        }

        $stmt->close();
    }
}

$conn->close();
?>




<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="./css/book_appointment.css">
        <!--Icons-->
        <link rel="stylesheet" href="css/all.min.css">
        <!-- <script src="https://kit.fontawesome.com/ec0debbca9.js" crossorigin="anonymous"></script> -->
        <title>Patient | Book Appointment</title>

        <style>
            .btn-1:hover {
                
                background-color: #fff;
                color: #3391E7;
  
              }
              .appointment-form select{
                font-size: 14px;
                padding: 10px;
                width: 100%;
                border: 1px solid #ccc;
                border-radius: 5px;
                margin-bottom: 20px;
              }

            
          
        </style>
    </head>
    <body>
        <div class="icon-bar">
            <button class="btn-1" onclick="window.location.href='index.php'"><i class="fa-solid fa-house"></i></button>
            <button class="btn-1" onclick="window.location.href='patient_dashboard.php'"><i class="fa-solid fa-reply"></i></button>
        </div>
        <br>
        <div class="container mt-4 p-4">
            <div class="row">
                <div class="col-md-6">
                    <h2 class="text-center my-4">
                        Book An Appointment
                    </h2>
                    <form method="POST" action="book_appointment.php">
                        <div class="form-group row">
                            <label class="col-sm-4 col-lg-4">
                                Patient Name
                            </label>
                            <div class="col-sm-8 col-lg-8">
                                <input type="text" id="patient-name" name="patient-name" class="form-control" placeholder="Please Enter the first name and last name..." required>
                            </div>
                        </div>
                        <!---->
                        <div class="form-group row">
                            <label class="col-sm-4 col-lg-4">
                                Contact
                            </label>
                            <div class="col-sm-8 col-lg-8">
                                <input type="tel" id="contact" name="contact" class="form-control" placeholder="123" required>
                            </div>
                        </div>
                        <!---->
                        <div class="appointment-form">
                        <label for="doctor-select">Select Doctor:</label>
                        <select id="doctor-select" name="doctor">
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
                        </div>
                        <!---->
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
                        <!---->
                        <div class="form-group row">
                            <label class="col-sm-4 col-lg-4">
                                Symptoms
                            </label>
                            <div class="col-sm-8 col-lg-8">
                                <textarea id="symptoms" name="symptoms" class="form-control" required></textarea>
                            </div>
                        </div>
                        <!---->
                        <div class="form-group row justify-content-end">
                            <div class="col-sm-5">
                                <button type="submit" class="btn btn-form btn-2">Confirm</button>
                            </div>
                        </div>
                    </form>
            </div>
        </div>
                <!-- </div>
                <div class="col-md-6">
                    <h2 id="services" class="text-center my-4"></h2>
                    <ul id="consultations" class="list-group"></ul>
                </div>
            </div>
        </div>
    <script src="./js/book_appointment.js"></script> -->
</body>

</html>

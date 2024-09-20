<?php
// Check if the form is submitted
if (isset($_POST['submit'])) {
    // Connect to the database
    $con = mysqli_connect("localhost", "root", "", "arogya_hms");

    // Check connection
    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Get form data
    $appointment_id = $_POST['appointment_id'];
    $doctor_id = $_POST['doctor_id'];
    $patient_id = $_POST['patient_id'];
    $date = $_POST['date'];
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];
    $symptoms = $_POST['symptoms'];
    $status = $_POST['status'];

    // Check if the provided doctor_id and patient_id exist in the respective tables
    $doctor_exists = mysqli_query($con, "SELECT * FROM doctors WHERE doctor_id = '$doctor_id'");
    $patient_exists = mysqli_query($con, "SELECT * FROM patients WHERE patient_id = '$patient_id'");

    if (mysqli_num_rows($doctor_exists) > 0 && mysqli_num_rows($patient_exists) > 0) {
        // Update the appointment
        $sql = "UPDATE appointments SET doctor_id = '$doctor_id', patient_id = '$patient_id', date = '$date', start_time = '$start_time', end_time = '$end_time', symptoms = '$symptoms', status = '$status' WHERE appointment_id = '$appointment_id'";

        if (mysqli_query($con, $sql)) {
            echo "<script type='text/javascript'>alert('Appointment updated successfully!'); window.location.href='doctor_edit_appointment.php';</script>";
        } else {
            echo "<script type='text/javascript'>alert('Error updating appointment: " . mysqli_error($con) . "');</script>";
        }
    } else {
        echo "<script type='text/javascript'>alert('Error: Doctor or patient does not exist.');</script>";
    }

    // Close the connection
    mysqli_close($con);
}
?>

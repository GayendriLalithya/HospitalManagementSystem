<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['delete']) && isset($_POST['appointment_id'])) {
        $appointment_id = $_POST['appointment_id'];

        // Connect to the database
        $con = mysqli_connect("localhost", "root", "", "arogya_hms");

        // Check connection
        if ($con->connect_error) {
            die("Connection failed: " . $con->connect_error);
        }

        // Prepare and bind
        $stmt = $con->prepare("DELETE FROM appointments WHERE appointment_id = ?");
        $stmt->bind_param("i", $appointment_id);

        if ($stmt->execute()) {
            echo "<script>alert('Appointment Deleted Successfully!'); window.location.href='appointments.php';</script>";
        } else {
            echo "<script>alert('Error Deleting Appointment: " . $stmt->error . "'); window.location.href='appointments.php';</script>";
        }

        $stmt->close();
        $con->close();
    }
}
?>

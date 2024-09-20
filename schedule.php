<?php
if (!isset($_POST['mode'])) {
    echo "";
    exit;
}

$mode = $_POST['mode'];
$con = mysqli_connect("localhost", "root", "", "arogya_hms");

if ($mode === 'update') {
    // Update operation
    if (isset($_POST['schedule_id']) && isset($_POST['doctor_id']) && isset($_POST['date']) && isset($_POST['start_time']) && isset($_POST['end_time'])) {
        $schedule_id = $_POST['schedule_id'];
        $doctor_id = $_POST['doctor_id'];
        $date = $_POST['date'];
        $start_time = $_POST['start_time'];
        $end_time = $_POST['end_time'];

        $sql = "UPDATE schedules SET doctor_id=?, date=?, start_time=?, end_time=? WHERE schedule_id=?";
        $stmt = mysqli_prepare($con, $sql);
        mysqli_stmt_bind_param($stmt, 'isssi', $doctor_id, $date, $start_time, $end_time, $schedule_id);
        mysqli_stmt_execute($stmt);

        if (mysqli_stmt_affected_rows($stmt) > 0) {
            echo "Schedule updated successfully.";
        } else {
            echo "Error: Failed to update Schedule.";
        }

        mysqli_stmt_close($stmt);
    } else {
        echo "Error: Missing required parameters for update operation.";
    }
} elseif ($mode === 'delete') {
    // Delete operation
    if (isset($_POST['schedule_id'])) {
        $schedule_id = $_POST['schedule_id'];

        $sql = "DELETE FROM schedules WHERE schedule_id=?";
        $stmt = mysqli_prepare($con, $sql);
        mysqli_stmt_bind_param($stmt, 'i', $schedule_id);
        mysqli_stmt_execute($stmt);

        if (mysqli_stmt_affected_rows($stmt) > 0) {
            echo "Schedule deleted successfully.";
        } else {
            echo "Error: Failed to delete Schedule.";
        }

        mysqli_stmt_close($stmt);
    } else {
        echo "Error: Missing required parameters for delete operation.";
    }
} else {
    echo "Error: Invalid 'mode' parameter value.";
}

mysqli_close($con);
?>
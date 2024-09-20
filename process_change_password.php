<?php
session_start();
require 'connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the form data
    $email = $_POST['email'];
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    // Check if new_password and confirm_password match
    if ($new_password !== $confirm_password) {
        $_SESSION['error_message'] = 'New Password and Confirm Password do not match.';
        header("Location: change_password.php");
        exit();
    }

    $tables = ['admin', 'patients', 'doctors', 'nurses', 'receptionists'];
    $password_changed = false;

    foreach ($tables as $table) {
        $query = "SELECT * FROM $table WHERE email = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            // Use password_verify() to check if the entered password matches the hashed password
            if (password_verify($current_password, $row['password'])) {
                // Hash the new password before storing it
                $hashed_new_password = password_hash($new_password, PASSWORD_DEFAULT);

                $query = "UPDATE $table SET password = ? WHERE email = ?";
                $stmt = $conn->prepare($query);
                $stmt->bind_param('ss', $hashed_new_password, $email);

                if ($stmt->execute()) {
                    $password_changed = true;
                    echo '<script>alert("The password has been changed successfully.");</script>';
                    
                    switch ($table) {
                        case 'doctors':
                            header("Location: doctor_dashboard.php");
                            break;
                        case 'patients':
                            header("Location: patient_dashboard.php");
                            break;
                        case 'admin':
                            header("Location: admin_dashboard.php");
                            break;
                        case 'nurses':
                            header("Location: nurse_dashboard.php");
                            break;
                        case 'receptionists':
                            header("Location: receptionist_dashboard.php");
                            break;
                    }
                    exit;
                } else {
                    echo "Error updating password: " . $conn->error;
                }
                $stmt->close();
            } else {
                $_SESSION['error_message'] = 'Incorrect Current Password';
                header("Location: change_password.php");
                exit();
            }
            break;
        }
    }

    if (!$password_changed) {
        $_SESSION['error_message'] = 'No user found with the provided username.';
        header("Location: change_password.php");
        exit();
    }

    $conn->close();
} else {
    header('Location: change_password.php');
}
?>

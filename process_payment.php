<?php
require 'connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the form data
    $first_name = $_POST['firstname'];
    $last_name = $_POST['lastname'];
    $email = $_POST['email'];
    $amount = $_POST['amount'];
    $billing_address = $_POST['address'];
    $billing_city = $_POST['city'];
    $billing_state = $_POST['state'];
    $billing_zip = $_POST['zip'];
    $transaction_id = time(); // Generating a simple transaction ID based on the current timestamp
    $payment_date = date('Y-m-d');
    $payment_status = 'Paid';

    // Get the patient_id using full_name and email
    $query = "SELECT patient_id FROM patients WHERE first_name = ? AND last_name = ? AND email = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('sss', $first_name, $last_name, $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $patient_id = $row['patient_id'];

        // Prepare and execute the SQL query
        $query = "INSERT INTO payments (patient_id, amount, billing_address, billing_city, billing_state, billing_zip, transaction_id, payment_date, payment_status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('idsssssss', $patient_id, $amount, $billing_address, $billing_city, $billing_state, $billing_zip, $transaction_id, $payment_date, $payment_status);

        if ($stmt->execute()) {
            // Show success message
           echo "<script type='text/javascript'>
                    alert('Payment Successful!');
                    window.location.href = 'payment.php';
                  </script>";
        } else {
            // Show error message and redirect
            echo "<script type='text/javascript'>
                    alert('Error Payment Unsuccessful: " . $stmt->error . "');
                    window.location.href = 'payment.php';
                  </script>";
        }

        $stmt->close();
    } else {
        // Show error message and redirect
        echo "<script type='text/javascript'>
                alert('Error: No patient found with the provided full name and email.');
                window.location.href = 'payment.php';
              </script>";
            }
    $conn->close();
} else {
    header('Location: payment.php');
}

?>
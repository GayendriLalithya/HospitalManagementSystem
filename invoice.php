<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Connect to the database
    $con = mysqli_connect("localhost", "root", "", "arogya_hms");

    // Get the form data
    $action = !empty($_POST["action"]) ? $_POST["action"] : null;
    $invoice_id = !empty($_POST["invoice_id"]) ? $_POST["invoice_id"] : null;

    // Check if the invoice ID exists
    $stmt = $con->prepare("SELECT * FROM invoice WHERE invoice_id = ?");
    $stmt->bind_param("i", $invoice_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $invoice_exists = $result->num_rows > 0;

    if ($action === 'insert' || ($action !== 'insert' && $invoice_exists)) {
        $patient_id = !empty($_POST["patient_id"]) ? $_POST["patient_id"] : null;
        $receptionist_id = !empty($_POST["receptionist_id"]) ? $_POST["receptionist_id"] : null;
        $total_amount_due = !empty($_POST["total_amount_due"]) ? $_POST["total_amount_due"] : null;
        $due_date = !empty($_POST["due_date"]) ? $_POST["due_date"] : null;
        $status = !empty($_POST["payment_status"]) ? $_POST["payment_status"] : null;

        // INSERT query
        if ($action === "insert") {
            $sql = "INSERT INTO invoice (invoice_id, patient_id, receptionist_id, total_amount_due, payment_due_date, payment_status) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $con->prepare($sql);
            $stmt->bind_param("iiidss", $invoice_id, $patient_id, $receptionist_id, $total_amount_due, $due_date, $status);
            
            try {
                $stmt->execute();
                echo "<script type='text/javascript'>alert('Record inserted successfully!')</script>";
            } catch (mysqli_sql_exception $exception) {
                echo "<script type='text/javascript'>alert('Error inserting record. Please make sure all required fields are filled out.')</script>";
            }

            $stmt->close();
        }
// UPDATE query
else if ($action === "update") {
    $sql = "UPDATE invoice SET patient_id = ?, receptionist_id = ?, total_amount_due = ?, payment_due_date = ?, payment_status = ? WHERE invoice_id = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("iidssi", $patient_id, $receptionist_id, $total_amount_due, $due_date, $status, $invoice_id);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "<script type='text/javascript'>alert('Record updated successfully!')</script>";
    } else {
        if ($invoice_id !== null) {
            echo "<script type='text/javascript'>alert('Invoice ID does not exist!')</script>";
        } else {
            echo "<script type='text/javascript'>alert('Please provide an Invoice ID!')</script>";
        }
    }
    $stmt->close();
}

// DELETE query
else if ($action === 'delete') {
    $stmt = $con->prepare("DELETE FROM invoice WHERE invoice_id=?");
    $stmt->bind_param("i", $invoice_id);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "<script type='text/javascript'>alert('Record deleted successfully!')</script>";
    } else {
        echo "<script type='text/javascript'>alert('Error deleting record.')</script>";
    }
    $stmt->close();
}

$con->close();

    } else {
        if ($action !== 'insert') {
            if ($invoice_id !== null) {
                // Invoice ID does not exist
                echo "<script type='text/javascript'>alert('Invoice ID does not exist!')</script>";
            } else {
                // No Invoice ID provided
                echo "<script type='text/javascript'>alert('Please provide an Invoice ID!')</script>";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/view.css">
    <title>Receptionist | Invoice Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        h1 {
            text-align: center;
            font-size: 24px;
            margin-bottom: 20px;
        }
        .container{
            width: 600px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            width: 500px;
            margin: 0 auto;
            text-align: left;
        }
        label {
            display: block;
            margin: 5px 0;
        }
        input[type="text"], input[type="date"], input[type="number"], select {
            font-size: 14px;
            padding: 10px;
            width: 100%;
            border: 1px solid #ccc;
            border-radius: 5px;
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
        margin-bottom: 10px;
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

    </style>
</head>
<body>

<div class="main-content">

<div class="sidenav">
        <b><p><a href="index.php">Home</a><br/>
        <b><p><a href="receptionist_dashboard.php">Dashboard</a><br/>
        <b><p><a href="invoice_view.php">All Invoices</a><br/>
        <b><p><a href="logout.php">Logout</a><br/>    
    </div> 
    <div class="container" style="margin-left: 25%; ">
    <h1>Invoice Form</h1>
    <form action="invoice.php" method="post" class="form-group">
        <input type="hidden" name="action" value="insert">
        <input type="hidden" name="invoice_id" value="0">

        <label for="invoice_id">Invoice ID:</label>
    <input type="number" name="invoice_id" id="invoice_id" >

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

    <label for="receptionist-select">Select Receptionist:</label>
    <select id="receptionist-select" name="receptionist_id">
        <option value="">--Choose a Receptionist--</option>
        <?php
            // Get all receptionists from the receptionists table
            $sql_receptionists = "SELECT * FROM `receptionists`";
            $all_receptionists = mysqli_query($con, $sql_receptionists);
            // Use a while loop to fetch data
            // from the $all_receptionists variable
            // and individually display as an option
            while ($receptionist = mysqli_fetch_array($all_receptionists, MYSQLI_ASSOC)) {
                $receptionist_id = $receptionist["receptionist_id"];
                $receptionist_name = $receptionist["first_name"] . " " . $receptionist["last_name"];
                echo "<option value=\"$receptionist_id\">$receptionist_name</option>";
            }
        ?>
    </select>

    <label for="total_amount_due">Total Amount Due:</label>
    <input type="number" name="total_amount_due" id="total_amount_due"step="0.01" min="0">

    <!-- <label for="amount_paid">Amount Paid:</label>
    <input type="number" name="amount_paid" id="amount_paid" step="0.01" min="0"> -->

    <label for="due_date">Due Date:</label>
    <input type="date" name="due_date" id="due_date">

    <div class="form-group">
        <label for="payment_status">Payment Status</label>
        <select id="payment_status" name="payment_status">
            <option value="Paid">Paid</option>
            <option value="Unpaid">Unpaid</option>
        </select>
    </div>
    <br>

    <button type="submit" onclick="document.getElementsByName('action')[0].value = 'insert';">Insert</button>
    <button type="submit" onclick="document.getElementsByName('action')[0].value = 'update';">Update</button>
    <button type="submit" class="red-btn" onclick="document.getElementsByName('action')[0].value = 'delete';">Delete</button>
        
</form>
</div></div>
</body>
</html>


<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Connect to the database
    $con = mysqli_connect("localhost", "root", "", "arogya_hms");

    // Get the form data
$doctor_id = !empty($_POST["doctor"]) ? $_POST["doctor"] : null;
$patient_id = !empty($_POST["patient"]) ? $_POST["patient"] : null;
$record_id = !empty($_POST["record_id"]) ? $_POST["record_id"] : null;
$date = !empty($_POST["date"]) ? $_POST["date"] : null;
$diagnosis = !empty($_POST["diagnosis"]) ? $_POST["diagnosis"] : null;
$treatment = !empty($_POST["treatment"]) ? $_POST["treatment"] : null;
$notes = !empty($_POST["notes"]) ? $_POST["notes"] : null;

// Check if any of the required fields are empty and show an error message
if (is_null($doctor_id) || is_null($patient_id) || is_null($record_id) || is_null($date) || is_null($diagnosis) || is_null($treatment)) {
    echo "<script type='text/javascript'>alert('Please fill in all the required fields.')</script>";
} else {


    // Prepare an SQL statement to insert the record
    $stmt = $con->prepare("INSERT INTO medical_history (record_id, patient_id, doctor_id, date, diagnosis, treatment, notes) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("iiissss", $record_id, $patient_id, $doctor_id, $date, $diagnosis, $treatment, $notes);

    // Execute the statement and check for success
    if ($stmt->execute()) {
        echo "<script type='text/javascript'>alert('Record added successfully!')</script>";
    } else {
        echo "<script type='text/javascript'>alert('Error adding Record: " . $stmt->error . "')</script>";
    }

    // Close the statement and the connection
    $stmt->close();
    $con->close();
}
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/view.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Doctor | Insert Records</title>

    <style>
    body{
            /* overflow: hidden; */
        }
        
        h1 {
            text-align: center;
            font-size: 24px;
            margin-bottom: 20px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            margin-bottom: 15px;
            text-align: left;
        }

        label {
        color: #000;
        font-size: 16px;
        margin-bottom: 5px;
        }

        input[type="number"],
        select {
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

.appointment-form {
    max-width: 600px;
    margin: 30px auto;
    background-color: #fff;
    padding: 30px;
    border-radius: 10px;
    border: 2px solid #ccc;
}

.appointment-form label {
    color: #333;
    font-size: 16px;
    display: block;
    margin-bottom: 5px;
}

.appointment-form select,
.appointment-form input[type="date"],
.appointment-form input[type="time"] {
    font-size: 14px;
    padding: 10px;
    width: 100%;
    border: 1px solid #ccc;
    border-radius: 5px;
    margin-bottom: 20px;
}

.sidenav a {
    padding: 8px 8px 8px 32px;
    text-decoration: none;
    font-size: 25px;
    color: #CCC;
    display: block;
    transition: 0.3s;
    font-family: Arial, sans-serif;
    padding-top: 45px;
}

textarea {
    border: 1px solid #ccc;
    border-radius: 4px;
    padding: 10px;
    width: 100%;
    font-size: 14px;
}

   
    </style>
        
</head>
<body>

<div class="main-content">
    <div class="sidenav">
        <p><a href="index.php">Home</a></p>
        <p><a href="doctor_dashboard.php">Dashboard</a></p>
        <p><a href="doctor_records_view.php">View Records</a></p>
        <p><a href="doctor_records_edit.php">Edit Records</a></p>
        <p><a href="logout.php">Logout</a></p>    
    </div>

    
    <div class="container" style="margin-left: 5%; ">
        <h1>Insert Records</h1>

        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
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

        <label for="patient-select">Select Patient:</label>
    <select id="patient-select" name="patient">
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

        <label for="record-id">Record ID:</label>
        <input type="number" id="record-id" name="record_id" style="margin-bottom: 20px;">

        <label for="date-select">Date:</label>
        <input type="date" id="date-select" name="date" required>
    
    <label for="diagnosis">Diagnosis</label>
    <textarea id="diagnosis" name="diagnosis" required></textarea>
                            
    <label for="treatment">Treatment</label>
    <textarea id="treatment" name="treatment" required></textarea>

    <label for="notes">Notes</label>
    <textarea id="notes" name="notes" required></textarea>
    
    <button id="insert-record">Insert Record</button>
    </form>
</div>
</div>
</body>
</html>
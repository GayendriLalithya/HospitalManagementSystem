<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Connect to the database
    $con = mysqli_connect("localhost", "root", "", "arogya_hms");

    // Get the form data
    $action = !empty($_POST["action"]) ? $_POST["action"] : null;
    $admission_id = !empty($_POST["admission_id"]) ? $_POST["admission_id"] : null;
    $patient_id = !empty($_POST["patient_id"]) ? $_POST["patient_id"] : null;
    $room_id = !empty($_POST["room_id"]) ? $_POST["room_id"] : null;
    $nurse_id = !empty($_POST["nurse_id"]) ? $_POST["nurse_id"] : null;
    $admission_date = !empty($_POST["admission_date"]) ? $_POST["admission_date"] : null;
    $admission_time = !empty($_POST["admission_time"]) ? $_POST["admission_time"] : null;
    $discharge_date = !empty($_POST["discharge_date"]) ? $_POST["discharge_date"] : null;
    $discharge_time = !empty($_POST["discharge_time"]) ? $_POST["discharge_time"] : null;

    if ($action === 'insert') {
        try {
        // Prepare an SQL statement to insert the record
        $stmt = $con->prepare("INSERT INTO admission (admission_id, patient_id, room_id, nurse_id, admission_date, admission_time, discharge_date, discharge_time) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("iiiissss", $admission_id, $patient_id, $room_id, $nurse_id, $admission_date, $admission_time, $discharge_date, $discharge_time);
    
        // Execute the statement and check for success
        if ($stmt->execute()) {
            echo "<script type='text/javascript'>alert('Record added successfully!')</script>";
        } else {
            throw new Exception($stmt->error);
        }
    } catch (Exception $e) {
        if ($e->getCode() == 1062) {
            echo "<script type='text/javascript'>alert('Error adding Record: Duplicate entry for Admission ID. Please use a unique Admission ID.')</script>";
        } else {
            echo "<script type='text/javascript'>alert('Error adding Record: " . $e->getMessage() . "')</script>";
        }
    }

    // Close the statement and the connection
    $stmt->close();
    $con->close();

    
    } elseif ($action === 'update') {
        // Prepare an SQL statement to update the record
        $stmt = $con->prepare("UPDATE admission SET patient_id=?, room_id=?, nurse_id=?, admission_date=?, admission_time=?, discharge_date=?, discharge_time=? WHERE admission_id=?");
        $stmt->bind_param("iiisssss", $patient_id, $room_id, $nurse_id, $admission_date, $admission_time, $discharge_date, $discharge_time, $admission_id);

        // Execute the statement and check for success
        if ($stmt->execute()) {
            echo "<script type='text/javascript'>alert('Record updated successfully!')</script>";
        } else {
            echo "<script type='text/javascript'>alert('Error updating Record: " . $stmt->error . "')</script>";
        }

        // Close the statement and the connection
        $stmt->close();
        $con->close();
    } elseif ($action === 'delete') {
        // Prepare an SQL statement to delete the record
        $stmt = $con->prepare("DELETE FROM admission WHERE admission_id=?");
        $stmt->bind_param("i", $admission_id);
            // Execute the statement and check for success
    if ($stmt->execute()) {
        echo "<script type='text/javascript'>alert('Record deleted successfully!')</script>";
    } else {
        echo "<script type='text/javascript'>alert('Error deleting Record: " . $stmt->error . "')</script>";
    }

    // Close the statement and the connection
    $stmt->close();
    $con->close();
} else {
    echo "<script type='text/javascript'>alert('Invalid action specified.')</script>";
}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/view.css">
    <title>Nurse | Admission Form</title>
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
        input[type="text"], input[type="date"], input[type="number"], input[type="time"], select {
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
        <b><p><a href="nurse_dashboard.php">Dashboard</a><br/>
        <b><p><a href="admission_view.php">All Admissions</a><br/>
        <b><p><a href="logout.php">Logout</a><br/>    
    </div> 
    <div class="container" style="margin-left: 25%; ">
    <h1>Admission Form</h1>
    <form action="nurse_admission.php" method="post" class="form-group">
        <input type="hidden" name="action" value="insert">
        <input type="hidden" name="admission_id" value="0">

        <label for="admission_id">Admission ID:</label>
        <input type="number" name="admission_id" id="admission_id" required>
        
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

        <label for="room_id">Room ID:</label>
        <input type="text" name="room_id" id="room_id" required>

        <label for="nurse-select">Select nurse:</label>
        <select id="nurse-select" name="nurse_id">
            <option value="">--Choose a nurse--</option>
            <?php
                // Connect to the database
                $con = mysqli_connect("localhost", "root", "", "arogya_hms");
                // Get all nurses from the nurses table
                $sql_nurses = "SELECT * FROM `nurses`";
                $all_nurses = mysqli_query($con, $sql_nurses);
                // Use a while loop to fetch data
                // from the $all_nurses variable
                // and individually display as an option
                while ($nurse = mysqli_fetch_array($all_nurses, MYSQLI_ASSOC)) {
                    $nurse_id = $nurse["nurse_id"];
                    $nurse_name = $nurse["first_name"] . " " . $nurse["last_name"];
                    echo "<option value=\"$nurse_id\">$nurse_name</option>";
                }
            ?>
        </select>

        <label for="admission_date">Admission Date:</label>
        <input type="date" name="admission_date" id="admission_date">

        <label for="admission_time">Admission Time:</label>
        <input type="time" name="admission_time" id="admission_time">

        <label for="discharge_date">Discharge Date:</label>
        <input type="date" name="discharge_date" id="discharge_date">

        <label for="discharge_time">Discharge Time:</label>
        <input type="time" name="discharge_time" id="discharge_time">

        <br>

        <button type="submit" onclick="document.getElementsByName('action')[0].value = 'insert';">Insert</button>
        <button type="submit" onclick="document.getElementsByName('action')[0].value = 'update';">Update</button>
        <button type="submit" class="red-btn" onclick="document.getElementsByName('action')[0].value = 'delete';">Delete</button>

    </form>
    </div></div>
</body>
</html>

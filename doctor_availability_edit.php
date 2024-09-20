<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'connection.php';

    if (isset($_POST['action']) && $_POST['action'] == 'delete') {
        $availability_id = $_POST['availability_id'];

        $sql = "DELETE FROM availability WHERE availability_id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $availability_id);
        
        if ($stmt->execute()) {
            echo "<script type='text/javascript'>alert('Availability Deleted Successfully!')</script>";
        } else {
            echo "<script type='text/javascript'>alert('Error Deleting Availability: " . $stmt->error . "')</script>";
        }

    } elseif (isset($_POST['action']) && $_POST['action'] == 'update') {
        $availability_id = $_POST['availability_id'];
        $doctor_id = $_POST['doctor_id'];
        $date = $_POST['date'];
        $start_time = $_POST['start_time'];
        $end_time = $_POST['end_time'];
        $status = $_POST['status'];

        $sql = "UPDATE availability SET doctor_id=?, date=?, start_time=?, end_time=?, status=? WHERE availability_id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("issssi", $doctor_id, $date, $start_time, $end_time, $status, $availability_id);

        if ($stmt->execute()) {
            echo "<script type='text/javascript'>alert('Availability Updated Successfully!')</script>";
        } else {
            echo "<script type='text/javascript'>alert('Error Updating Availability: " . $stmt->error . "')</script>";
        }
    }

    $stmt->close();
    $conn->close();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor | Availability Management</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
    <link rel="stylesheet" href="./css/view.css">

    <style>
        .schedule-form {
    max-width: 600px;
    margin: 30px auto;
    background-color: #fff;
    padding: 30px;
    border-radius: 10px;
    border: 2px solid #ccc;
}

.schedule-form label {
    color: #333;
    font-size: 16px;
    display: block;
    margin-bottom: 5px;
}

.schedule-form input[type="date"],
.schedule-form input[type="time"] {
    font-size: 14px;
    padding: 10px;
    width: 100%;
    border: 1px solid #ccc;
    border-radius: 5px;
    margin-bottom: 20px;
}

input[type="text"],
input[type="number"],
select {
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

.slots-list {
    max-width: 600px;
    margin: 30px auto;
    background-color: #fff;
    padding: 30px;
    border-radius: 10px;
    border: 2px solid #ccc;
}

.slots-list h2 {
    color: #333;
    font-size: 20px;
    text-align: center;
    margin-bottom: 20px;
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
        <b><p><a href="doctor_dashboard.php">Dashboard</a><br/>
        <b><p><a href="doctor_availability_view.php">View Availability</a><br/>
        <b><p><a href="doctor_availability.php">Add Availability</a><br/>
        <b><p><a href="logout.php">Logout</a><br/>    
    </div> 

    <div class="container" style="margin-left: 5%; ">
        <h1>Availability Management</h1>
        
            <!-- form content -->

            <div class="schedule-form">
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

            <label for="availability-select">Select Appointment:</label>
        <select id="availability-select">
        <option value="">--Choose the Appointment ID--</option>
        <?php
        // Connect to the database
        $con = mysqli_connect("localhost", "root", "", "arogya_hms");

        // Get all availability from the availability table
        $sql_availability = "SELECT * FROM `availability`";
        $all_availability = mysqli_query($con, $sql_availability);

        // Use a while loop to fetch data
        // from the $all_availability variable
        // and individually display as an option
        while ($availability = mysqli_fetch_array($all_availability, MYSQLI_ASSOC)) {
            $availability_id = $availability["availability_id"];
            $availability_id = $availability["availability_id"];
            echo "<option value=\"$availability_id\">$availability_id</option>";
        }
        ?>
        </select>

            <form action="doctor_availability_edit.php" method="POST" id="availability-form">
            <input type="hidden" id="doctor_id" name="doctor_id">
            <input type="hidden" id="availability_id" name="availability_id">
            <input type="hidden" id="action" name="action">

            <!-- <label for="availability_id">Availability ID:</label>
            <input type="number" id="availability_id" name="availability_id" style="margin-bottom: 20px;"> -->

            <label for="date-select">Select Date:</label>
            <input type="date" id="date-select" name="date">

            <label for="start-time">Start Time:</label>
            <input type="time" id="start-time" name="start_time">

            <label for="end-time">End Time:</label>
            <input type="time" id="end-time" name="end_time">

            <label for="status">Availability Status:</label>
            <select id="status" name="status">
                <option value="available">Available</option>
                <option value="unavailable">Unavailable</option>
            </select>

            <button type="submit" name="update" id="update-record">Update Availability</button>
            <button id="delete-record" class="red-btn" type="submit" name="delete">Delete Availability</button>
        </form>
        </div>
    </div>
    </div>
    <script>
    document.getElementById("doctor-select").addEventListener("change", function () {
        document.getElementById("doctor_id").value = this.value;
    });

    document.getElementById("availability-select").addEventListener("change", function () {
        document.getElementById("availability_id").value = this.value;
    });

    document.getElementById("update-record").addEventListener("click", function (event) {
        document.getElementById("action").value = "update";
    });

    document.getElementById("delete-record").addEventListener("click", function (event) {
        document.getElementById("action").value = "delete";
    });
</script>

    </body>
</html>
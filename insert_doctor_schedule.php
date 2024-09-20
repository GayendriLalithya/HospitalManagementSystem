<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/view.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Doctor | Add Schedule</title>
    <style>

        body{
            overflow: hidden;
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

        input[type="text"],
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

   
    </style>
</head>
<body>

<div class="main-content">
    <div class="sidenav">
        <p><a href="index.php">Home</a></p>
        <p><a href="doctor_dashboard.php">Dashboard</a></p>
        <p><a href="doctor_schedule.php">View Schedules</a></p>
        <p><a href="update_delete_schedule.php">Manage Schedules</a></p>
        <p><a href="index.php">Logout</a></p>    
    </div> 
    
    <div class="container" style="margin-left: 5%;">
    <h1>Create Schedule</h1>
    <form class="appointment-form" action="nurse_create_schedule.php" method="post">
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

        <label for="date-select">Select Date:</label>
        <input type="date" id="date-select" name="date">

        <label for="start-time">Start Time:</label>
        <input type="time" id="start-time" name="start_time">

        <label for="end-time">End Time:</label>
        <input type="time" id="end-time" name="end_time">

        <button id="create" type="submit" name="submit">Create Schedule</button>

    </form>
</div>

</div>

<?php
if (isset($_POST["submit"])) {
    // Connect to the database
    $con = mysqli_connect("localhost", "root", "", "arogya_hms");

    // Get the submitted form data
    $doctor_id = $_POST["doctor"];
    $date = $_POST["date"];
    $start_time = $_POST["start_time"];
    $end_time = $_POST["end_time"];

    // Prepare the SQL query to insert the data
    $sql = "INSERT INTO schedules (doctor_id, date, start_time, end_time) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, 'isss', $doctor_id, $date, $start_time, $end_time);

    try {
        mysqli_stmt_execute($stmt);
    } catch (mysqli_sql_exception $e) {
        echo "<script type='text/javascript'>
                alert('Error! Schedule creation is unsuccessful. Foreign key constraint violation.');
                window.location.href = 'insert_doctor_schedule.php';
              </script>";
        exit();
    }

    if (mysqli_stmt_affected_rows($stmt) > 0) {
        echo "<script type='text/javascript'>
                alert('Schedule created successfully!');
                window.location.href = 'doctor_schedule.php';
              </script>";
    } else {
        echo "<script type='text/javascript'>
                alert('Error! Schedule creation is unsuccessful: " . mysqli_stmt_error($stmt) . "');
                window.location.href = 'insert_doctor_schedule.php';
              </script>";
    }

    // Close the prepared statement and connection
    mysqli_stmt_close($stmt);
    mysqli_close($con);
}
?>

</body>
</html>


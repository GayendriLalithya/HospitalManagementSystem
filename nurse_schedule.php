<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/view.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Nurse | View Schedule</title>
    
    <style>
        
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
        <p><a href="nurse_dashboard.php">Dashboard</a></p>
        <p><a href="nurse_create_schedule.php">Create Schedule</a></p>
        <p><a href="nurse_edit_schedule.php">Edit Schedule</a></p>
        <p><a href="logout.php">Logout</a></p>    
    </div> 
    

<div class="container" style="margin-left: 5%;">
    <h1>All Schedules</h1>
    <hr>
    
    <!-- Displaying the slots data -->
    <table id="schedules-table">
        <thead>
            <tr>
                <th>Schedule ID</th>
                <th>Doctor Name</th>
                <th>Date</th>
                <th>Start Time</th>
                <th>End Time</th>
            </tr>
        </thead>
        <tbody>
            <!-- Rows will be added dynamically -->
            <?php
                    include 'connection.php';

                    $sql = "SELECT schedules.schedule_id, CONCAT(doctors.first_name, ' ', doctors.last_name) AS doctor_name, schedules.date, schedules.start_time, schedules.end_time
                            FROM schedules
                            JOIN doctors ON schedules.doctor_id = doctors.doctor_id";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row['schedule_id'] . "</td>";
                            echo "<td>" . $row['doctor_name'] . "</td>";
                            echo "<td>" . $row['date'] . "</td>";
                            echo "<td>" . $row['start_time'] . "</td>";
                            echo "<td>" . $row['end_time'] . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5'><b>No Schedules found.</b></td></tr>";
                    }

                    $conn->close();
                ?>
        </tbody>
    </table>
    
</div>
</div>
</body>
</html>

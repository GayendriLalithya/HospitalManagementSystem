<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/view.css">
    <title>Receptionist | Edit Rooms</title>

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
        }

        button:hover {
        background-color: #fff;
        color: #000;
        }

    </style>
</head>
<body>
<div class="main-content">

<div class="sidenav">
    <b><p><a href="index.php">Home</a><br/>
    <b><p><a href="receptionist_dashboard.php">Dashboard</a><br/>
    <b><p><a href="room.php">View Rooms</a><br/>
    <b><p><a href="index.php">Logout</a><br/>    
</div> 
<div class="container" style="margin-left: 5%; ">
    <h1>Edit Rooms</h1>
    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        include 'connection.php';
        
        $room_number = intval($_POST['room_number']);
        $room_type = $_POST['room_type'];
        $availability = $_POST['availability'];
    
        // Check if the room number exists in the database
        $room_check = "SELECT * FROM rooms WHERE room_number=?";
        $stmt_check = $conn->prepare($room_check);
        $stmt_check->bind_param('i', $room_number);
        $stmt_check->execute();
        $result_check = $stmt_check->get_result();
    
        if ($result_check->num_rows > 0) {
            $sql = "UPDATE rooms SET room_type=?, status=? WHERE room_number=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('ssi', $room_type, $availability, $room_number);
    
            if ($stmt->execute()) {
                echo "<script type='text/javascript'>alert('Room availability updated successfully!')</script>";
            } else {
                echo "<script type='text/javascript'>alert('Error updating room availability: " . $stmt->error . "')</script>";
            }
            
            $stmt->close();
        } else {
            echo "<script type='text/javascript'>alert('Room number not found in the database.')</script>";
        }
    
        $stmt_check->close();
        $conn->close();
    }
    
    ?>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <div class="form-group">
            <label for="room_number">Room Number</label>
            <input type="text" id="room_number"  name="room_number" placeholder="Enter room number" required>
        </div>
        <div class="form-group">
            <label for="room_type">Room Type</label>
            <select id="room_type" name="room_type">
                <option value="General">General</option>
                <option value="Private">Private</option>
                <option value="Semi-private">Semi-Private</option>
                <option value="Intensive Care">Intensive Care</option>
                <option value="Hybrid operating room">Hybrid operating room</option>
                <option value="Integrated operating room">Integrated operating room</option>
                <option value="Digital operating room">Digital operating room</option>
            </select>
        </div>
        <div class="form-group">
            <label for="availability">Availability</label>
            <select id="availability" name="availability">
                <option value="Available">Available</option>
                <option value="Unavailable">Unavailable</option>
            </select>
        </div>
        <button type="submit">Update Room Availability</button>
    </form>
</div>

</body>
</html>
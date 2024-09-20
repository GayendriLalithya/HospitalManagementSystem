<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/view.css">
    <title>Receptionist | Payments</title>

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
        <b><p><a href="logout.php">Logout</a><br/>    
    </div> 

    

    <div class="container" style="margin-left: 5%;">
        <h1>All Payments</h1>
        <hr>
    
        <!-- Displaying the rooms data -->
        <table>
            <thead>
                <tr>
                    <th>Payment ID</th>
                    <th>Patient ID</th>
                    <th>Amount</th>
                    <th>Payment Date</th>
                    <th>Payment Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include 'connection.php';
                $sql = "SELECT * FROM payments";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['payment_id'] . "</td>";
                        echo "<td>" . $row['patient_id'] . "</td>";
                        echo "<td>" . $row['amount'] . "</td>";
                        echo "<td>" . $row['payment_date'] . "</td>";
                        echo "<td>" . $row['payment_status'] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>No payments found</td></tr>";
                }

                $conn->close();
                ?>
            </tbody>
        </table>
    </div>
            </body>
            </html>
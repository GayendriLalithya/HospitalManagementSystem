<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient | All Invoices</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
    <link rel="stylesheet" href="./css/view.css">

    <style>
        <style>
    .admissions-list {
    max-width: 600px;
    margin: 30px auto;
    background-color: #fff;
    padding: 30px;
    border-radius: 10px;
    border: 2px solid #ccc;
}

.admissions-list h2 {
    color: #333;
    font-size: 20px;
    text-align: center;
    margin-bottom: 20px;
}

.admission-actions {
    max-width: 600px;
    margin: 30px auto;
    background-color: #fff;
    padding: 30px;
    border-radius: 10px;
    border: 2px solid #ccc;
}

.admission-actions label {
    color: #333;
    font-size: 16px;
    display: block;
    margin-bottom: 5px;
}

.admission-actions select {
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

input[type="date"],
input[type="time"],
textarea {
    border: 1px solid #ccc;
    border-radius: 4px;
    padding: 10px;
    width: 95%;
    font-size: 14px;
    margin: 10px;
}

label{
    text-align: left;
    
}

</style>
    </style>
</head>
<body>

    <div class="sidenav">
        <b><p><a href="index.php">Home</a><br/>
        <b><p><a href="patient_dashboard.php">Dashboard</a><br/>
        <b><p><a href="logout.php">Logout</a><br/>    
    </div> 

    <div class="main-content">
    <div class="container" style="margin-left: 5%;">
        <h1>All Invoices</h1>
        <hr>
        
        <div class="form-group">
            <form action="patient_invoice.php" method="POST"></form>
        </div>
        
        <!-- Displaying the admissions data -->
        <table id="invoices-table">
            <thead>
                <tr>
                    <th>Invoice ID</th>
                    <th>Patient Name</th>
                    <th>Receptionist ID</th>
                    <th>Total Amount Due</th>
                    <th>Payment Status</th>
                    <th>Payment Due Date</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include 'connection.php';
                $sql = "SELECT invoice.invoice_id, CONCAT(patients.first_name, ' ', patients.last_name) AS patient_name, CONCAT(receptionists.first_name, ' ', receptionists.last_name) AS receptionist_name, total_amount_due, payment_due_date, payment_status
                FROM invoice
                JOIN receptionists ON invoice.receptionist_id = receptionists.receptionist_id
                JOIN patients ON invoice.patient_id = patients.patient_id";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['invoice_id'] . "</td>";
                        echo "<td>" . $row['patient_name'] . "</td>";
                        echo "<td>" . $row['receptionist_name'] . "</td>";
                        echo "<td>" . $row['total_amount_due'] . "</td>";
                        echo "<td>" . $row['payment_due_date'] . "</td>";
                        echo "<td>" . $row['payment_status'] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>No invoices found</td></tr>";
                }
                $conn->close();
                ?>
            </tbody>
        </table>
    </div>
    </div>
</body>
</html>    
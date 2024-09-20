<?php
// Connect to the database
$con = mysqli_connect("localhost", "root", "", "arogya_hms");

// Initialize the patient and medical_history arrays
$patient = [];
$medical_history = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['search_patients'])) {
    $search_query = trim($_POST['search_patients']);
    $sql = "SELECT * FROM patients WHERE first_name LIKE ? OR last_name LIKE ? OR email LIKE ? OR patient_id LIKE ?";
    $stmt = $con->prepare($sql);
    $search_param = '%' . $search_query . '%';
    $stmt->bind_param('ssss', $search_param, $search_param, $search_param, $search_param);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $patient = $result->fetch_assoc();

        // Fetch notes from medical_history table for the relevant patient
        $patient_id = $patient['patient_id'];
        $sql_medical_history = "SELECT * FROM medical_history WHERE patient_id = ?";
        $stmt_medical_history = $con->prepare($sql_medical_history);
        $stmt_medical_history->bind_param('i', $patient_id);
        $stmt_medical_history->execute();
        $result_medical_history = $stmt_medical_history->get_result();

        if ($result_medical_history->num_rows > 0) {
            $medical_history = $result_medical_history->fetch_assoc();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900&display=swap" rel="stylesheet">
        <!-- Bootstrap CSS -->
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css'>
        <!-- Font Awesome CSS -->
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css'>
        <link rel="stylesheet" href="./css/profile.css">
        <link rel="stylesheet" href="./css/style.css">
        <!--Icons-->
        <link rel="stylesheet" href="css/all.min.css">
        <!-- <script src="https://kit.fontawesome.com/ec0debbca9.js" crossorigin="anonymous"></script> -->
        <title>Patient | My Profile</title>

        <style>

.container {
    background-color: #FFF;
    padding: 22px;
    border-radius: 5px;
    border: 2px solid #000;
    margin-bottom: 20px;
    margin-left: ;
}

.search-container {
    display: flex;
    justify-content: center;
    margin-bottom: 20px;
}

.search-container input[type="text"] {
    padding: 8px;
    font-size: 14px;
    border: 1px solid #ccc;
    border-radius: 5px;
    width: 700px;
}

.search-container button[type="submit"] {
    padding: 8px;
    font-size: 14px;
    font-weight: bold;
    color: #fff;
    background-color: #3391E7;
    border: 1px solid #000;
    border-radius: 5px;
    cursor: pointer;
    width: 150px !important;
    margin-left: 10px;
    
}

.search-container button[type="submit"]:hover {
    background-color: #fff;
    color: #000;
}


</style>
    
    </head>
    <body>        
        <div class="btn">
            <button class="btn" onclick="window.location.href='index.php'" style="border: 2px solid black;"><i class="fa-solid fa-house"></i></button>
            <button class="btn" onclick="window.location.href='patient_dashboard.php'"  style="border: 2px solid black;"><i class="fa-solid fa-reply"></i></button>
        </div>

        <div class="container">
        <div class="search-container">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <input type="text" name="search_patients" id="search_patientss" placeholder="search patients..." >
            <button type="submit" ><i class="fas fa-search"></i> Search</button>
        </form>

        </div>
    </div>
    
        <div class="patient-profile py-4">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="card shadow-sm">
                            <div class="card-header bg-transparent text-center">
                                <img class="profile_img" src="https://source.unsplash.com/600x300/?student" alt="student dp">
                                <h3>My Profile</h3>
                            </div>
                            <div class="row" style="padding-left: 30px;">
                                <div class="col-md-4 text-left">
                                    <br>
                                    <p class="mb-0"><strong class="pr-1">Patient ID:</strong></p>
                                    <br>
                                    <p class="mb-0"><strong class="pr-1">Email:</strong></p>
                                    <br>
                                </div>

                                <div class="col-md-8 text-left">
                                    <br>
                                    <p class="mb-0"><?php echo isset($patient['patient_id']) ? $patient['patient_id'] : ''; ?></p>
                                    <br>
                                    <p class="mb-0"><?php echo isset($patient['email']) ? $patient['email']:''; ?></p>
                                    <br>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="card shadow-sm">
                            <div class="card-header bg-transparentborder-0">
                                <h3 class="mb-0"><i class="far fa-clone pr-1"></i>General Information</h3>
                            </div>
                            <div class="card-body pt-0">
                                <table class="table table-bordered">
                                    <tr>
                                      <th width="30%">First Name</th>
                                      <td width="2%">:</td>
                                      <td><?php echo isset($patient['first_name']) ? $patient['first_name'] : ''; ?></td>
                                    </tr>
                                    <tr>
                                      <th width="30%">Last Name</th>
                                      <td width="2%">:</td>
                                      <td><?php echo isset($patient['last_name']) ? $patient['last_name'] : ''; ?></td>
                                    </tr>
                                    <tr>
                                      <th width="30%">Age</th>
                                      <td width="2%">:</td>
                                      <td><?php echo isset($patient['age']) ? $patient['age'] : ''; ?></td>
                                    </tr>
                                    <tr>
                                      <th width="30%">Gender</th>
                                      <td width="2%">:</td>
                                      <td><?php echo isset($patient['gender']) ? $patient['gender'] : ''; ?></td>
                                    </tr>
                                    <tr>
                                      <th width="30%">Contact No</th>
                                      <td width="2%">:</td>
                                      <td><?php echo isset($patient['phone']) ? $patient['phone'] : ''; ?></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div style="height: 26px"></div>
                            <div class="card shadow-sm">
                                <div class="card-header bg-transparent border-0">
                                    <h3 class="mb-0"><i class="far fa-clone pr-1"></i>Notes</h3>
                                </div>
                                <div class="card-body pt-0">
                                    <p><?php echo isset($medical_history['notes']) ? $medical_history['notes'] : ''; ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>


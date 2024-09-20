<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title> Doctor | Dashboard </title>

    <!--Dashboard Alignment-->
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <!--Dashboard Styles-->
    <link rel="stylesheet" type="text/css" href="./css/dashboard.css" />
    <!--Dashboard Icons-->
    <link rel="stylesheet" href="css/all.min.css">
    <!-- <script src="https://kit.fontawesome.com/ec0debbca9.js" crossorigin="anonymous"></script> -->
    <!--Header and footer style-->
    <link rel="stylesheet" href="css/responsiveSlides.css">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>

    <body>               
        <section id="services" class="key-features department">
            <div class="container">
                <div class="inner-title">
                
                    <h2 style="font-size: 4rem;">Doctor Dashboard</h2>
                </div>
                <div class="row">

                    <div class="col-lg-4 col-md-6">
                        <a href="change_password.php" class="single-key-link">
                            <div class="single-key">
                                <i class="fa-solid fa-pen"></i>
                                <h5>Change Password</h5>
                            </div>
                        </a>
                    </div>
                
                    <div class="col-lg-4 col-md-6">
                        <a href="doctor_patient_view.php" class="single-key-link">
                            <div class="single-key">
                                <i class="fa-solid fa-clipboard-user"></i>
                                <h5>Patients</h5>
                            </div>
                        </a>
                    </div>
                
                    <div class="col-lg-4 col-md-6">
                        <a href="doctor_room.php" class="single-key-link">
                            <div class="single-key">
                                <i class="fa-solid fa-bed-pulse"></i>
                                <h5>Rooms</h5>
                            </div>
                        </a>
                    </div>

                    <div class="col-lg-4 col-md-6">
                        <a href="appointments.php" class="single-key-link">
                            <div class="single-key">
                                <i class="fa-solid fa-laptop-medical"></i>
                                <h5>Appontments</h5>
                            </div>
                        </a>
                    </div>

                    <div class="col-lg-4 col-md-6">
                        <a href="doctor_records_view.php" class="single-key-link">
                            <div class="single-key">
                                <i class="fa-solid fa-clock-rotate-left"></i>
                                <h5>Medical History</h5>
                            </div>
                        </a>
                    </div>

                    <div class="col-lg-4 col-md-6">
                        <a href="doctor_schedule.php" class="single-key-link">
                            <div class="single-key">
                                <i class="fa-solid fa-calendar-days"></i>
                                <h5>Manage Schedule</h5>
                            </div>
                        </a>
                    </div>

                    <div class="col-lg-4 col-md-6">
                        <a href="doctor_availability.php" class="single-key-link">
                            <div class="single-key">
                                <i class="fa-sharp fa-regular fa-circle-check"></i>
                                <h5>Edit Availability</h5>
                            </div>
                        </a>
                    </div>

                    <div class="col-lg-4 col-md-6">
                        <a href="logout.php" class="single-key-link" id="logout-btn">
                            <div class="single-key">
                                <i class="fa-solid fa-power-off"></i>
                                <h5>Logout</h5>
                            </div>
                        </a>
                    </div>

                </div>
            </div>
        </section>
        <footer>
            <div class="container">
                <div class="footer-left">
                    <ul>
                        <li><a href="index.php">Home</a></li>
                        <li><a href="about_us.php">About Us</a></li>
                        <li><a href="services.php">Services</a></li>
                        <li><a href="contact.php">Contact Us</a></li>
                    </ul>
                </div>
                    <ul>
                        <li height="90" colspan="3" width="319" style="opacity:1"><center>
                            <p>&nbsp;</p>
                            <p><font size="2" face="Arial, Helvetica, sans-serif" color="#CCCCCC" >© 2023 Arogya. All Rights Reserved. Designed by Apex Design</font></p>
                            <p>&nbsp;</p>
                            </center>;
                        </li>
                    </ul>
            </div>
        </footer>
        <script>
$(document).ready(function() {
    $('#logout-btn').on('click', function(e) {
        e.preventDefault(); // Prevent the default action (navigation)

        // Display a confirmation message
        var confirmLogout = confirm("Are you sure you want to log out?");

        if (confirmLogout) {
            // If the user confirms logout, perform the logout action
            $.ajax({
                url: "logout.php",
                type: "POST",
                success: function() {
                    // Redirect to the home page after a successful logout
                    window.location.href = "index.php";
                },
                error: function() {
                    alert("An error occurred while logging out. Please try again.");
                }
            });
        }
    });
});
</script>
    </body>
</html>




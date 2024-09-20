<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Location</title>
    <!--Header style-->
    <link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
    <link href='http://fonts.googleapis.com/css?family=Ropa+Sans' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <!--Search and map icons-->
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!--Header and footer style-->
    <link rel="stylesheet" href="css/responsiveSlides.css">
    
    <link rel="stylesheet" href="css/map.css">
    
    <!-- <script>
        function toggleMapTheme() {
            var mapIframe = document.getElementById('mapIframe');
            var mapLightURL = "https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d253482.3347079283!2d79.77323870596508!3d6.931003760881613!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae2fbf31c32ec99%3A0x593e0480f5aa834!2sArogya%20Hospitals%20Private%20Limited!5e0!3m2!1sen!2slk!4v1682619486660!5m2!1sen!2slk";
            var mapDarkURL = "https://maps.google.com/maps?q=arogya%20hospital&t=k&hl=en&ll=6.931003760881613,79.77323870596508&spn=0.52,0.7&z=10&output=embed&iwloc=near";
            var themeButton = document.getElementById('themeButton');
            
            if (mapIframe.src === mapLightURL) {
                mapIframe.src = mapDarkURL;
                themeButton.innerHTML = '<i class="fas fa-sun"></i>';
            } else {
                mapIframe.src = mapLightURL;
                themeButton.innerHTML = '<i class="fas fa-moon"></i>';
            }
        }
    </script> -->
</head>
<body>
<header>
            <div class="container">
                <div class="row main-nav-row-wrap">
                    <div class="col-md-7 main-menue-wrap">
                        <div class="logo">
                            <a href="index.php">
                                <img src="./images/logo.jpg" alt="Logo">
                            </a>
                        </div>
                        <div class="menu">
                            <ul>
                                <li>
                                    <a href="index.php">HOME</a>
                                </li>
                                <li>
                                    <a href="about_us.php">ABOUT US</a>
                                </li>
                                <li>
                                    <a href="services.php">SERVICES</a>
                                </li>
                                <li>
                                    <a href="contact.php">CONTACT US</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-2 main-menue-ico-wrap" >
                        <div class="header-social text-center">
                            <ul>
                                <li>
                                    <a href="javascript:void(0);">
                                        <i class="fas fa-search"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="map.php">
                                        <i class="fas fa-map-marker-alt"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-3 main-btn-wrap">
                        <a href="login.php" class="btn-green">
                            <i class="fas fa-calendar"></i> Book An Appointment
                        </a>
                    </div>
                </div>
            </div>
        </header>
        <div class="map">
            <h1>Location</h1> 
            <!-- <div class="toggle-theme-btn" id="themeButton" onclick="toggleMapTheme()">
                <i class="fas fa-moon"></i>
            </div> -->
            <iframe id="mapIframe" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d253482.3347079283!2d79.77323870596508!3d6.931003760881613!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae2fbf31c32ec99%3A0x593e0480f5aa834!2sArogya%20Hospitals%20Private%20Limited!5e0!3m2!1sen!2slk!4v1682619486660!5m2!1sen!2slk" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
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
</body>
</html>
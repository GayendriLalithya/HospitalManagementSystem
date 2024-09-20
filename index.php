<!DOCTYPE HTML>
<html>

    <head>
        <title>Hospital Management System</title>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!--Header style-->
        <link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
        <link href='http://fonts.googleapis.com/css?family=Ropa+Sans' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <!--Search and map icons-->
        <link rel="stylesheet" href="css/all.min.css">
        <!--Header and footer style-->
        <link rel="stylesheet" href="css/responsiveSlides.css">
        <!--Js Slider-->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
        <script src="js/responsiveslides.min.js"></script>

       

        <!-- Responsive Slides JavaScript Code -->
        <script>
            $(function () {
                $("#slider1").responsiveSlides({
                    maxwidth: 1600,
                    speed: 600
                });
            });
        </script>
        <!-- Active Header JavaScript Code -->
        <!-- <script>
            var header = document.getElementsByTagName("header");
            window.onscroll = function () {scrollFunction()};

            function scrollFunction (){
                if(document.body.scrollTop > 200 || document.documentElement.scrollTop > 200){
                    header[0].setAttribute("class", "header-active");
                }
                else{
                    header[0].removeAttribute("class")
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
        <div class="clear"></div>
        <div class="image-slider">
            <ul class="rslides" id="slider1">
                <li><img src="images/slider-image1.jpg" alt=""></li>
                <li><img src="images/slider-image2.jpg" alt=""></li>
                <li><img src="images/slider-image3.jpg" alt=""></li>
            </ul>
        </div>
        <div class="clear"> </div>
            	<div class="content-grids">
            		<div class="wrap">
            		    <div class="section group">
                            <div class="listview_1_of_3 images_1_of_3">
            					<div class="listimg listimg_1_of_2">
            						  <img src="images/grid-img3.png">
            					</div>
            					<div class="text list_1_of_2">
            						  <h3 style="color:#000;">Patients Login</h3>
            						  <!--<p>Register & Book Appointment</p>-->
            						  <div><span><a class="btn-green1" href="login.php">Click Here To Login</a></span></div>
            				    </div>
            				</div>
                            <div class="listview_1_of_3 images_1_of_3">
            					<div class="listimg listimg_1_of_2">
            						  <img src="images/grid-img1.png">
            					</div>
            					<div class="text list_1_of_2">
            						  <h3 style="color:#000;">Staff Login</h3>
                                
            						  <div><span><a class="btn-green1" href="login.php">Click Here To Login</a></span></div>
            					</div>
            				</div>
                            <div class="listview_1_of_3 images_1_of_3">
            					<div class="listimg listimg_1_of_2">
            						  <img src="images/grid-img2.png">
            					</div>
            					<div class="text list_1_of_2">
            						  <h3 style="color:#000;">Admin Login</h3>
                                    <div><span><a class="btn-green1" href="login.php">Click Here To Login</a></span></div>
            				    </div>
            				</div>
            			</div>
            		</div>
            	</div>
                <div class="wrap">
            		<div class="content-box">
            		    <div class="section group">
            				<div class="col_1_of_3 span_1_of_3 frist"></div>
            				<div class="col_1_of_3 span_1_of_3 second"></div>
            				<div class="col_1_of_3 span_1_of_3 frist"></div>
            		    </div>
            		</div>
            	</div>
            	<div class="clear"> </div>

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
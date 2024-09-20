<!DOCTYPE HTML>
<html>
	<head>
		<title> Contact Us </title>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<!--Header Style-->
		<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
        <link href='http://fonts.googleapis.com/css?family=Ropa+Sans' rel='stylesheet' type='text/css'>
		<!--Form CSS-->
		<link rel="stylesheet" href="./css/form.css">
		<!--Page alignment-->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
		<!--Search and map icons-->
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
            integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
        <link rel="stylesheet" href="css/responsiveSlides.css">

		<!-- Active Header JavaScript Code -->
        <script>
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
        </script>
        
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
		<div class="clear"> </div>
		<div class="wrap">
		   	<div class="contact">
		   		<div class="section group">
					<div class="col span_1_of_3">
						<div class="company_address">
				     		<h2>Hospital Address  :</h2>
						    <p>Arogya Health Care,</p>
						   	<p>250 Colombo Rd, Gampaha,</p>
						   	<p>Sri Lanka</p>
				   			<p>Phone:(+94) 111 222 333</p>
				   			<p>Fax: (000) 000 00 00 0</p>
				 	 		<p>Email: <span>arogyahms@gmail.com</span></p>
						</div>
					</div>
					<div class="col span_2_of_3">
				  		<div class="contact-form">
				  			<h2>Contact Us</h2>
					    	<form>
					    		<div>
							    	<span><label>NAME</label></span>
							    	<span><input type="text" value=""></span>
							    </div>
							    <div>
							    	<span><label>E-MAIL</label></span>
							    	<span><input type="text" value=""></span>
							    </div>
							    <div>
							     	<span><label>MOBILE NO</label></span>
							    	<span><input type="text" value=""></span>
							    </div>
							    <div>
							    	<span><label>SUBJECT</label></span>
							    	<span><textarea> </textarea></span>
							    </div>
							    <div>
							   		<span><input type="submit" value="Submit"></span>
								</div>
					    	</form>
						</div>
				    </div>
  				</div>
			</div>
		<div class="clear"> </div>
		</div>
		<div class="clear"> </div>
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
	
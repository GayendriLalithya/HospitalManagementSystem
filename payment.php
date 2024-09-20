<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!--Icons-->
        <link rel="stylesheet" href="css/all.min.css">
        <script src="https://kit.fontawesome.com/ec0debbca9.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="./css/payment.css">
        <link rel="stylesheet" href="./css/bil.css">
        <title>Patient | Payment</title>

    </head>
    <body style="margin-top: 30px;">
        <div>
            <button class="btn-1" onclick="window.location.href='index.php'" style="border: 2px solid #000 !important;"><i class="fa-solid fa-house"></i></button>
            <button class="btn-1" onclick="window.location.href='patient_dashboard.php'" style="border: 2px solid #000 !important;"><i class="fa-solid fa-reply"></i></button>
        </div>
        <br>
        <div>
            <div class="row">
              <div class="col-75">
                <div class="container" style="border: 2px solid black;">
                <form action="process_payment.php" method="POST">
                
                



                    <div class="row">
                      <div class="col-50">
                        <h3>Billing Address</h3>
                        <label for="fname"><i class="fa fa-user"></i> First Name</label>
                        <input type="text" id="fname" name="firstname" placeholder="John" required>
                        <label for="lname"><i class="fa fa-user"></i> Last Name</label>
                        <input type="text" id="lname" name="lastname" placeholder="Doe" required>
                        <label for="email"><i class="fa fa-envelope"></i> Email</label>
                        <input type="text" id="email" name="email" placeholder="john@example.com" required>
                        <label for="adr"><i class="fa fa-address-card-o"></i> Address</label>
                        <input type="text" id="adr" name="address" placeholder="542 W. 15th Street">
                        <label for="city"><i class="fa fa-institution"></i> City</label>
                        <input type="text" id="city" name="city" placeholder="New York">

                        <div class="row">
                          <div class="col-50">
                            <label for="state">State</label>
                            <input type="text" id="state" name="state" placeholder="NY">
                          </div>
                          <div class="col-50">
                            <label for="zip">Zip</label>
                            <input type="text" id="zip" name="zip" placeholder="10001">
                          </div>
                        </div>
                      </div>

                      <div class="col-50">
                        <h3>Payment</h3>
                        <label for="fname">Accepted Cards</label>
                        <div class="icon-container">
                          <i class="fa fa-cc-visa" style="color:navy;"></i>
                          <i class="fa fa-cc-amex" style="color:blue;"></i>
                          <i class="fa fa-cc-mastercard" style="color:red;"></i>
                          <i class="fa fa-cc-discover" style="color:orange;"></i>
                        </div>
                        <label for="cname">Name on Card</label>
                        <input type="text" id="cname" name="cardname" placeholder="John More Doe">
                        <label for="ccnum">Credit card number</label>
                        <input type="text" id="ccnum" name="cardnumber" placeholder="1111-2222-3333-4444">
                        <label for="expmonth">Exp Month</label>
                        <input type="text" id="expmonth" name="expmonth" placeholder="September">
                        <label for="amount">Amount</label>
                        <input type="text" id="amount" name="amount" placeholder="30">


                        <div class="row">
                          <div class="col-50">
                            <label for="expyear">Exp Year</label>
                            <input type="text" id="expyear" name="expyear" placeholder="2023">
                          </div>
                          <div class="col-50">
                            <label for="cvv">CVV</label>
                            <input type="text" id="cvv" name="cvv" placeholder="352">
                          </div>
                        </div>
                      </div>

                    </div>
                    <input type="submit" value="Continue to checkout" class="btn" style="border: 2px solid #000 !important;">
                  </form>
                </div>
              </div>

              <div class="col-25" style="border: 2px solid black;">
                <div class="container">
                  <h4>Select the Items you're paying
                    <span class="price" style="color:black">
                      <i class="fa fa-shopping-cart"></i>
                      <b>8</b>
                    </span>
                  </h4>
                  <div id="paymentList">
                    <p><a href="#">Pharmacy/Drugs</a> <span class="price">$25</span></p>
                    <p><a href="#">Admission</a> <span class="price">$150</span></p>
                    <p><a href="#">Room Charge (per day)</a> <span class="price">$100</span></p>
                    <p><a href="#">Laborotory Test</a> <span class="price">$50</span></p>
                    <p><a href="#">CT Scan</a> <span class="price">$250</span></p>
                    <p><a href="#">Operating Room</a> <span class="price">$500</span></p>
                    <p><a href="#">X-Ray</a> <span class="price">$75</span></p>
                    <p><a href="#">Doctor Fee</a> <span class="price">$200</span></p>
                    <hr>
                    <p>Total <span class="price" id="total" style="color:black"><b>$0</b></span></p>
                  </div>
                  <script src="./js/script.js"></script>
                  </div>
              </div>
            </div>
        </div>
    </body>
</html>
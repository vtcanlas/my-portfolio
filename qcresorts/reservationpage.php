<?php
    include_once('connection.php');
    $rateID = isset($_POST['rateid']) ? $_POST['rateid'] : "";
    
    
    $sql = "SELECT * FROM poolrates;";
    $result = mysqli_query($con,$sql);
    $rs=mysqli_num_rows($result);
    if ($rs>0){
        while ($row = mysqli_fetch_assoc($result)){
            if($row['rateid']==$rateID){
            $poolid = $row['pool_id'];
            }
        }
    }
    
?>

<?php

$sql = "SELECT * FROM pool;";
$result = mysqli_query($con,$sql);
$rs=mysqli_num_rows($result);
if ($rs>0){
    while ($row = mysqli_fetch_assoc($result)){
        if($row['pool_id']==$poolid){
        $poolname = $row['pool_name'];
        }
    }
}?>
<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <title><?php echo $poolname ?> - Reservation Form</title>
        <link rel="icon" href="images/qcresorts_icon.png" type="image/icon type">
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:400,400i,700,700i,600,600i&amp;display=swap">
        <link rel="stylesheet" href="assets/css/Features-Cards-icons.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.11.1/baguetteBox.min.css">
        <link rel="stylesheet" href="assets/css/Projects-Grid-images.css">
        <link rel="stylesheet" href="assets/css/vanilla-zoom.min.css">
        <link href='https://ajax.aspnetcdn.com/ajax/jquery.ui/1.12.1/themes/cupertino/jquery-ui.css'
          rel='stylesheet'>
    </head>

<body>
    <nav class="navbar navbar-light navbar-expand-lg fixed-top bg-white clean-navbar">
        <div class="container"><a class="navbar-brand logo" href="#">QCResorts</a><button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navcol-1"><span class="visually-hidden">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div id="navcol-1" class="collapse navbar-collapse">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="home.html">home</a></li>
                    <li class="nav-item"><a class="nav-link" href="http://localhost/qcresorts/resorts.php">Resorts</a></li>
                    <li class="nav-item"><a class="nav-link" href="loginpage.html">Log In</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <main class="page contact-us-page">
        <section class="clean-block clean-form dark">
            
            <div class="container">
            <?php
              $sql = "SELECT * FROM reservationdetails;";
              $result = mysqli_query($con,$sql);
              $rs=mysqli_num_rows($result);
              if ($rs>0){
                while ($row = mysqli_fetch_assoc($result)){
                    if($rateID==$row['rateid'])
                  echo '
                        <div class="block-heading">
                            <h2 class="text-info">Booking a Reservation</h2>
                            <p>Please fill up the following form so that we can process your reservation.</p>
                            <img width="100" height="80" style="width: 306px;height: 235px;margin-top: 44px;" src="data:image/jpeg;base64,'.base64_encode($row['img']).'"/>
                            <p style="color: var(--bs-dark);font-weight: bold;margin-top: 16px;">&quot;'.$row['pool_name'].'&quot;</p>
                            <p style="color: var(--bs-gray);margin-top: 3px;font-size: 15px;">Not the resort you want? Click 
                            <a href="resorts.php"> here </a> to go back.</p>
                        </div>
                    ';
                  }
                }
              ?>
                <form action="insert.php" method="POST">
                    <div class="mb-3" style="margin-top: -20px;">
                        <h1 style="font-size: 30.52px;margin: -3px;margin-top: 20px;">Reservation Details</h1>
                    </div>


                    <!-- PHP To get dates of reservations -->
                    <?php 
                    $datearray = array();
                    $sql = "SELECT * 
                            FROM resdetails 
                            WHERE pool_id = $poolid 
                                AND approved = 1
                                AND rate_id = $rateID";
                    $result = mysqli_query($con,$sql);
                    $rs=mysqli_num_rows($result);
                    if ($rs>0){
                        while ($row = mysqli_fetch_assoc($result)){
                            $datearray[] = '"'.$row['date'].'"';
                        }
                    }
                    $resdatesstring = rtrim(implode(', ', $datearray), ',');
                     /* echo $resdatesstring; */
                    ?>
                    <div class="mb-3"><label class="form-label h3" for="name">Package to Avail</label>
                    <?php
                        $sql = "SELECT * FROM poolrates;";
                        $result = mysqli_query($con,$sql);
                        $rs=mysqli_num_rows($result);
                        if ($rs>0){
                            while ($row = mysqli_fetch_assoc($result)){
                                if($rateID == $row['rateid'])
                            echo '
                                    <p id="ratenamep" style="margin-top: 10px;font-size: 20px;font-style: italic;color: rgba(33,37,41,0.71);">'.$row['ratename'].'</p>
                                    <p id="ratetimep" style="margin-top: -24px;font-size: 20px;font-style: italic;color: rgba(33,37,41,0.71);">'.$row['ratearrivaltime'].' to '.$row['ratedeparturetime'].'</p>
                                    <p id="ratepricep" style="margin-top: -24px;font-size: 20px;font-style: italic;color: rgba(33,37,41,0.71);">P'.$row['rateprice'].'</p>
                                    <p id="ratedescp" style="margin-top: -10px;font-size: 20px;color: rgba(33,37,41,0.69);">'.$row['ratedesc'].'</p>
                                ';
                            }
                        }
                    ?>
                    <br>
                    <div class="mb-3"><label class="form-label" for="name">Date</label><input autocomplete="off" id="datechooser" class="form-control" name="date" type="text" required/></div>
                    <p id="ratedescp" style="margin-top: 0px;font-size: 12px;color: rgba(33,37,41,0.69);">*If your desired date is greyed out this means it is booked, try choosing a different <a href="http://localhost/qcresorts/resorts.php">resort</a>.</p>
                    
                    
                    
                    <div class="mb-3"><input class="form-control" type="text" name="poolID" value="<?php echo $poolid?>" readonly hidden/></div>
                    <div class="mb-3"><input class="form-control" type="text" name="rateID" value="<?php echo $rateID?>" readonly hidden/></div>
                    <?php
                        $sql = "SELECT * FROM pool;";
                        $result = mysqli_query($con,$sql);
                        $rs=mysqli_num_rows($result);
                        if ($rs>0){
                            while ($row = mysqli_fetch_assoc($result)){
                                if($poolid == $row['pool_id'])
                            echo '
                                <div class="mb-3"><input class="form-control" type="text" name="uname" value="'.$row['uname'].'" readonly hidden/></div>
                                ';
                            }
                        }
                    ?>
                    

                    <div class="mb-3" style="margin-top: 46px;">
                        <h1 style="font-size: 30.52px;margin-top: -4px;">Contact Information</h1>
                    </div>
                    <div class="mb-3" style="margin-top: 5px;"><label class="form-label" for="first_name">First Name</label><input id="name-5" class="form-control" type="text" name="first_name"/></div>
                    <div class="mb-3"><label class="form-label" for="lastname">Last Name</label><input id="name-3" class="form-control" type="text" name="last_name" required/></div>
                    <div class="mb-3"><label class="form-label" for="address">Address</label><input id="name-2" class="form-control" type="text" name="address" required/></div>
                    <div class="mb-3"><label class="form-label" for="contactnumber">Contact Number</label><input id="name-1" class="form-control" type="text" name="contactnumber" required/></div>
                    <div class="mb-3"><label class="form-label" for="email">Email Address</label><input id="subject" class="form-control" type="email" name="email" required/></div><br>
                    <div class="mb-3"><label class="form-label" for="proofofpayment">Proof Of Payment</label><input class="form-control" type="file" accept="image/x-png,image/jpeg" name="proofofpayment" required/><small class="form-text">Upload Bank Receipts as Image (JPEG or PNG). For GCASH Payments please include InstaPay Trace No. and for Bank Transfers please include the reference number. </small></div>
                    <br><div class="mb-3"><label class="form-label" for="paymentamount">Amount Paid</label><input id="name-3" class="form-control" type="text" oninput="this.value=this.value.replace(/[^0-9]/g,'');" name="paymentamount" required/> <small class="form-text">Please input total amount paid (Don't include comma) </small> </div>
                    
                    <br><div class="mb-3"><label class="form-label" for="message">Message/Requests</label><textarea  name="message" id="message" class="form-control"></textarea></div>
                    
                    <div class="g-recaptcha" data-sitekey="6LeheXYiAAAAAKw9oRCfCOHLa2BEcwqKM2EL56eg" data-theme="light" data-size="normal" data-image="image"></div>
                    <br>
                    <div class="mb-3"><button class="btn btn-primary" value="Submit" type="submit">Send</button></div>
                    
                    
                </form>
            </div>
        </section>
    </main>

    

    <footer class="text-center py-4">
        <div class="container">
            <div class="row row-cols-1 row-cols-lg-3">
                <div class="col">
                    <p class="text-muted my-2">Copyright&nbsp;© 2022 QCResorts</p>
                </div>
                <div class="col">
                    <ul class="list-inline my-2">
                        <li class="list-inline-item me-4">
                            <div class="bs-icon-circle bs-icon-primary bs-icon"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-facebook">
                                    <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z"></path>
                                </svg></div>
                        </li>
                        <li class="list-inline-item me-4">
                            <div class="bs-icon-circle bs-icon-primary bs-icon"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-twitter">
                                    <path d="M5.026 15c6.038 0 9.341-5.003 9.341-9.334 0-.14 0-.282-.006-.422A6.685 6.685 0 0 0 16 3.542a6.658 6.658 0 0 1-1.889.518 3.301 3.301 0 0 0 1.447-1.817 6.533 6.533 0 0 1-2.087.793A3.286 3.286 0 0 0 7.875 6.03a9.325 9.325 0 0 1-6.767-3.429 3.289 3.289 0 0 0 1.018 4.382A3.323 3.323 0 0 1 .64 6.575v.045a3.288 3.288 0 0 0 2.632 3.218 3.203 3.203 0 0 1-.865.115 3.23 3.23 0 0 1-.614-.057 3.283 3.283 0 0 0 3.067 2.277A6.588 6.588 0 0 1 .78 13.58a6.32 6.32 0 0 1-.78-.045A9.344 9.344 0 0 0 5.026 15z"></path>
                                </svg></div>
                        </li>
                        <li class="list-inline-item">
                            <div class="bs-icon-circle bs-icon-primary bs-icon"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-instagram">
                                    <path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.917 3.917 0 0 0-1.417.923A3.927 3.927 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.916 3.916 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.926 3.926 0 0 0-.923-1.417A3.911 3.911 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0h.003zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599.28.28.453.546.598.92.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.47 2.47 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.478 2.478 0 0 1-.92-.598 2.48 2.48 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233 0-2.136.008-2.388.046-3.231.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92.28-.28.546-.453.92-.598.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045v.002zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92zm-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217zm0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334z"></path>
                                </svg></div>
                        </li>
                    </ul>
                </div>
                <div class="col">
                    <ul class="list-inline my-2">
                        <li class="list-inline-item"><a class="link-secondary" href="#">Privacy Policy</a></li>
                        <li class="list-inline-item"><a class="link-secondary" href="#">Terms of Use</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>

    
</body>
<script src=
"https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js" >
    </script>
      
    <script src=
"https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js" >
    </script>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<script>
    window.onload = function() {
    let
        ratenamechange = document.getElementById("ratenamep"),
        ratetimechange = document.getElementById("ratetimep"),
        ratepricechange = document.getElementById("ratepricep"),
        ratedescchange = document.getElementById("ratedescp"),
        mySelect   = document.getElementById("dropdown")
    ;


    mySelect.onchange = function(){

        switch (mySelect.value)  {
            
            <?php
                $sql = "SELECT * FROM poolrates;";
                $result = mysqli_query($con,$sql);
                $rs=mysqli_num_rows($result);
                if ($rs>0){
                    while ($row = mysqli_fetch_assoc($result)){
                        if($poolid == $row['pool_id'])
                            echo '
                                case "'.$row['rateid'].'":
                                    ratenamechange.textContent = "'.$row['ratename'].'";
                                    ratetimechange.textContent = "'.$row['ratearrivaltime'].'" +" to " +"'.$row['ratedeparturetime'].'";
                                    ratepricechange.textContent = "P" + "'.$row['rateprice'].'";
                                    ratedescchange.textContent = "'.$row['ratedesc'].'";
                                break;
                            ';
                        }
                    }
            ?>
    
        }
    }
    };



    
</script>
<script>

        var array = [<?php echo $resdatesstring?> ]
        $("#datechooser").datepicker({
            dateFormat: 'yy-mm-dd',
            beforeShowDay: function(date){
                var string = jQuery.datepicker.formatDate('yy-mm-dd', date);
                return [ array.indexOf(string) == -1 ]
            }
        }
       );
 
</script>
</html>
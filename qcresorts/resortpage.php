<?php
include_once('connection.php');
$resID = isset($_POST['resortid']) ? $_POST['resortid'] : "";

$sql = "SELECT * FROM pool;";
$result = mysqli_query($con,$sql);
$rs=mysqli_num_rows($result);
if ($rs>0){
    while ($row = mysqli_fetch_assoc($result)){
        if($row['pool_id']==$resID){
        $poolname = $row['pool_name'];
        }
    }
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title><?php echo $poolname ?></title>
    <link rel="icon" href="images/qcresorts_icon.png" type="image/icon type">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:400,400i,700,700i,600,600i&amp;display=swap">
    <link rel="stylesheet" href="assets/css/Features-Cards-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.11.1/baguetteBox.min.css">
    <link rel="stylesheet" href="assets/css/Projects-Grid-images.css">
    <link rel="stylesheet" href="assets/css/vanilla-zoom.min.css">
    
</head>

<body>
    <nav class="navbar navbar-light navbar-expand-lg fixed-top bg-white clean-navbar">
        <div class="container"><a class="navbar-brand logo" href="#">QCResorts</a><button data-bs-toggle="collapse" class="navbar-toggler" data-bs-target="#navcol-1"><span class="visually-hidden">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navcol-1">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="home.html">home</a></li>
                    <li class="nav-item"><a class="nav-link" href="http://localhost/qcresorts/resorts.php" style="color: var(--bs-dark);">Resorts</a></li>
                    <li class="nav-item"><a class="nav-link" href="loginpage.html">Log In</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <main class="page landing-page">
        <section id="heropart1" class="clean-block clean-info dark" style="padding: 22px;">
            <div class="container" style="height: 142px;">
                <div class="block-heading" style="height: 127px;margin: -48px;">
                    <h1 style="margin: 11px;padding: -7px;font-size: 74px;margin-top: -18px;"><?php echo $poolname ?></h1>
                </div>
            </div>
            <div class="container" style="margin-top: 28px;">
                <div class="row">
                    <div class="col-md-4" style="text-align: center;"><a href="#gallery" style="font-size: 39px;color: var(--bs-gray-800);font-style: italic;">Gallery</a></div>
                    <div class="col-md-4" style="text-align: center;"><a href="#packages" style="font-size: 39px;color: var(--bs-gray-800);font-style: italic;">Packages</a></div>
                    <div class="col-md-4" style="text-align: center;"><a href="#contact" style="font-size: 39px;color: var(--bs-gray-800);font-style: italic;">Contact</a></div>
                </div>
            </div>
        </section>
        <section id="heropart2" class="clean-block clean-info dark" style="color: rgb(41,33,37);--bs-body-bg: var(--bs-red);background: rgb(255,255,255);padding: 8px;margin-top: 107px;margin-bottom: 111px;">
            <div class="container">
                <div class="row">

                <?php
                $sql = "SELECT * FROM poolpics;";
                $result = mysqli_query($con,$sql);
                $rs=mysqli_num_rows($result);
                if ($rs>0){
                    while ($row = mysqli_fetch_assoc($result)){
                        if($row['pool_id']==$resID)
                            if($row['active']==1){
                            echo '
                            <div class="col-md-6"><img class="img-thumbnail" src="data:image/jpeg;base64,'.base64_encode($row['img']).'"/ height="428" /></div>
                            
                                    ';
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
                        if($row['pool_id']==$resID){
                            echo '
                            <div class="col-md-6">
                                <h1 style="margin-top: 25px;">'.$row['pool_name'].'</h1>
                                <p style="margin-top: -21px;color: var(--bs-gray);font-size: 19px;text-align: justify;"><br /><span style="color: rgb(33, 37, 41);">'.$row['pool_description'].'</span><br /><br /></p><a href="#packages"><button class="btn btn-primary fs-6" type="button" style="margin-top: -20px;">Book Now</button></a>
                            </div>
                            ';
                        }
                    }
                }
            ?>
                </div>
            </div>
        </section>
    </main>
    <section id="gallery" class="clean-block clean-info dark" style="padding: 8px;">
        <div class="container">
            <div class="block-heading" style="margin-top: -90px;">
                <section class="photo-gallery py-4 py-xl-5">
                    <div class="container-fluid p-0">
                        <div class="row g-0 row-cols-1 row-cols-md-2 row-cols-xl-3 photos" data-bss-baguettebox="">
                        <?php
                        $sql = "SELECT * FROM poolpics;";
                        $result = mysqli_query($con,$sql);
                        $rs=mysqli_num_rows($result);
                        if ($rs>0){
                            while ($row = mysqli_fetch_assoc($result)){
                                if($row['pool_id']==$resID){
                                    echo '
                                    <div class="col item"><a href="data:image/jpeg;base64,'.base64_encode($row['img']).'"> <img style="height:290px;width:450px;"class="img-fluid" src="data:image/jpeg;base64,'.base64_encode($row['img']).'"/></a></div>
                                    ';
                                }
                            }
                        }
                        ?>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </section>
    <section id="packages" class="clean-block clean-info dark" style="padding: 8px;background: rgb(255,255,255);">
        <div class="container py-4 py-xl-5" style="margin-top: 86px;margin-bottom: 15px;">
            <div class="row mb-5">
                <div class=" col-xl-12 text-center mx-auto">
                    <h2>Packages</h2>
                    <p class="w-lg-50">These are the available packages and rates that <?php echo $poolname ?> offers.</p>
                    <div class="row gy-4 row-cols-1 row-cols-md-2 row-cols-xl-3">
                        <div class="col-md-12 col-xl-12" style="padding: 25px;">
                                <?php
                                $sql = "SELECT * FROM poolrates;";
                                $result = mysqli_query($con,$sql);
                                $rs=mysqli_num_rows($result);
                                if ($rs>0){
                                    while ($row = mysqli_fetch_assoc($result)){
                                        if($row['pool_id']==$resID){
                                            echo '
                                            <div class="row" style="margin-top: 18px;margin-bottom: 40px; color:white;">
                                            <div class="col-xxl-12">
                                                <div class="card">
                                                    <div class="card-body p-4" style="background: var(--bs-info);border-radius: 12px;">
                                                        <h4 class="card-title" style="font-weight: bold;">'.$row['ratename'].'</h4>
                                                        <h4 class="card-title" style="font-style: italic;margin-top: 30px;color: rgba(33,37,41,0.72);margin-bottom: -3px;">'.$row['ratearrivaltime'].' to '.$row['ratedeparturetime'].'</h4>
                                                        <h4 class="card-title" style="font-style: italic;margin-top: 27px;color: white;margin-bottom: -4px;">P'.$row['rateprice'].'</h4>
                                                        <p class="card-text" style="margin-top: 36px;padding-left: 50px;padding-right: 50px;">'.$row['ratedesc'].'</p>
                                                        <form method="post" action="reservationpage.php">
                                                            <button type="submit" name="rateid" value="'.$row['rateid'].'" class="btn btn-primary fs-6" style="margin-top: 35px;">Avail Package</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        ';
                                        }
                                    }
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="contact" class="clean-block clean-info dark" style="padding: 8px;background: rgb(246,246,246);">
    <div class="container py-4 py-xl-5" style="background: #f6f6f6;margin-bottom: -57px;">
        <div class="row mb-5">
            <div class="col-md-8 col-xl-6 col-xxl-11 text-center mx-auto">
                <h2>Contact</h2>
                <p class="w-lg-50">Get in touch with <?php echo $poolname ?> directly</p>
            </div>
        </div>
        <section class="position-relative py-4 py-xl-5" style="padding: -105px 0px;">
            <div class="container position-relative">
                <div class="row d-flex justify-content-center" style="margin-top: -86px;">
                    <div class="col-md-6 col-lg-4 col-xl-4">
                        <div class="d-flex flex-column justify-content-center align-items-start h-100">

                        <?php
                        $sql = "SELECT * FROM pool;";
                        $result = mysqli_query($con,$sql);
                        $rs=mysqli_num_rows($result);
                        if ($rs>0){
                            while ($row = mysqli_fetch_assoc($result)){
                            if($row['pool_id']==$resID){
                                    echo '
                                    <div class="d-flex align-items-center p-3">
                                    <div class="bs-icon-md bs-icon-rounded bs-icon-primary d-flex flex-shrink-0 justify-content-center align-items-center d-inline-block bs-icon"><svg class="bi bi-telephone" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16">
                                            <path d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.568 17.568 0 0 0 4.168 6.608 17.569 17.569 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.678.678 0 0 0-.58-.122l-2.19.547a1.745 1.745 0 0 1-1.657-.459L5.482 8.062a1.745 1.745 0 0 1-.46-1.657l.548-2.19a.678.678 0 0 0-.122-.58L3.654 1.328zM1.884.511a1.745 1.745 0 0 1 2.612.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z"></path>
                                        </svg></div>
                                    <div class="px-2">
                                        <h6 class="mb-0">Phone</h6>
                                        <p class="mb-0">+'.$row['contactno1'].'</p>
                                    </div>
                                    </div>
                                    <div class="d-flex align-items-center p-3">
                                        <div class="bs-icon-md bs-icon-rounded bs-icon-primary d-flex flex-shrink-0 justify-content-center align-items-center d-inline-block bs-icon"><svg class="bi bi-envelope" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16">
                                                <path fill-rule="evenodd" d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4Zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2Zm13 2.383-4.708 2.825L15 11.105V5.383Zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741ZM1 11.105l4.708-2.897L1 5.383v5.722Z"></path>
                                            </svg></div>
                                        <div class="px-2">
                                            <h6 class="mb-0">Email</h6>
                                            <p class="mb-0">'.$row['emailaddress'].'</p>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center p-3">
                                        <div class="bs-icon-md bs-icon-rounded bs-icon-primary d-flex flex-shrink-0 justify-content-center align-items-center d-inline-block bs-icon"><svg class="bi bi-pin" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16">
                                                <path d="M4.146.146A.5.5 0 0 1 4.5 0h7a.5.5 0 0 1 .5.5c0 .68-.342 1.174-.646 1.479-.126.125-.25.224-.354.298v4.431l.078.048c.203.127.476.314.751.555C12.36 7.775 13 8.527 13 9.5a.5.5 0 0 1-.5.5h-4v4.5c0 .276-.224 1.5-.5 1.5s-.5-1.224-.5-1.5V10h-4a.5.5 0 0 1-.5-.5c0-.973.64-1.725 1.17-2.189A5.921 5.921 0 0 1 5 6.708V2.277a2.77 2.77 0 0 1-.354-.298C4.342 1.674 4 1.179 4 .5a.5.5 0 0 1 .146-.354zm1.58 1.408-.002-.001.002.001zm-.002-.001.002.001A.5.5 0 0 1 6 2v5a.5.5 0 0 1-.276.447h-.002l-.012.007-.054.03a4.922 4.922 0 0 0-.827.58c-.318.278-.585.596-.725.936h7.792c-.14-.34-.407-.658-.725-.936a4.915 4.915 0 0 0-.881-.61l-.012-.006h-.002A.5.5 0 0 1 10 7V2a.5.5 0 0 1 .295-.458 1.775 1.775 0 0 0 .351-.271c.08-.08.155-.17.214-.271H5.14c.06.1.133.191.214.271a1.78 1.78 0 0 0 .37.282z"></path>
                                            </svg></div>
                                        <div class="px-2">
                                            <h6 class="mb-0">Address</h6>
                                            <p class="mb-0">'.$row['address'].'</p>
                                        </div>
                                    </div>
                            ';
                            }
                        }
                        }
                    ?>
                            



                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section id="packages" class="clean-block clean-info dark" style="padding: 8px;background: rgb(255,255,255);">
        <div class="container py-4 py-xl-5" style="margin-top: 86px;margin-bottom: 15px;">
            <div class="row mb-5">
                <div class=" col-xl-12 text-center mx-auto">
                    <h2>Payment Details</h2>
                    <p class="w-lg-50">Reservation payment options for <?php echo $poolname ?></p>
                        <div class="row gy-4 row-cols-1 row-cols-md-2 row-cols-xl-3">
                            <div class="col">
                                <?php
                                $sql = "SELECT * FROM poolpaymentmode;";
                                $result = mysqli_query($con,$sql);
                                $rs=mysqli_num_rows($result);
                                if ($rs>0){
                                    while ($row = mysqli_fetch_assoc($result)){
                                        if($row['pool_id']==$resID){
                                            echo '
                                            <div class="card">
                                            <div class="card-body p-4">
                                                <h4 class="card-title">'.$row['modeofpayment'].'</h4>
                                                <p class="card-text">'.$row['acc_name'].'</p>
                                                <p class="card-text">'.$row['acc_number'].'</p>
                                                <p class="card-text">'.$row['message'].'</p>
                                            </div>
                                            </div>
                                            </div>
                                        ';
                                        }
                                    }
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>



    </section>

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
    <script src="https://unpkg.com/scrollreveal"></script>
    <script>
        ScrollReveal().reveal('#gallery,#packages,#heropart1,#heropart2',  {distance:'200px',duration:2000});  
    </script>
</body>

</html>
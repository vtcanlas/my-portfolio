<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Untitled</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<?php

$resID = isset($_POST['resortid']) ? $_POST['resortid'] : "";

echo "Your registration is: ".$resID.".";

?>
<body>
    <section class="position-relative py-4 py-xl-5" style="height: 1023.391px;">
        <div class="container position-relative">
            <div class="row d-flex justify-content-center" style="height: 818.391px;">
                <div class="col-md-8 col-lg-6 col-xl-7 col-xxl-6">
                    <div class="card mb-5">
                        <div class="card-body p-sm-5">
                            <h2 class="text-center mb-4" style="color: var(--bs-blue);font-size: 78px;">Add a Reservation</h2>
                            <form method="post">
                                <div class="mb-3"><select class="form-select">
                                        <option value="b">b</option>
                                        <option value="a">a</option>
                                    </select></div>
                                <div class="mb-3"><input class="form-control" type="date"></div>
                                <div class="mb-3"><input class="form-control" type="text" id="name-2" name="firstname" placeholder="First Name"></div>
                                <div class="mb-3"><input class="form-control" type="text" id="email-2" name="lastname" placeholder="Last Name"></div>
                                <div class="mb-3"><textarea class="form-control" placeholder="Home Address" name="address"></textarea></div>
                                <div class="mb-3"><input class="form-control" type="tel" id="email-5" name="contactnumber" placeholder="Contact Number"></div>
                                <div class="mb-3"><input class="form-control" type="email" id="email-4" name="email" placeholder="Email"></div>
                                <div class="mb-3"><small class="form-text">Upload Proof of Payment</small><input class="form-control" type="file" name="ProofOfPayment"></div>
                                <div class="mb-3"><button class="btn btn-primary d-block w-100" type="submit">Send </button></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>
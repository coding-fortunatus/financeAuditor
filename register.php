<?php

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Financial Auditor - Account Registration</title>
    <meta content="" name="description" />
    <meta content="" name="keywords" />
    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon" />
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon" />
    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet" />
    <!-- Vendor CSS Files -->
    <link href="assets/vendor/aos/aos.css" rel="stylesheet" />
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet" />
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet" />
    <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet" />
    <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet" />
    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet" />
</head>

<body>
    <div class="wrapper">
        <div class="form-left">
            <h2 class="text-uppercase">information</h2>
            <p>
                Creating an account ensures that you the right and privilege to use our Web-based Financial Auditing
                Application System to perform basic auditing of your financial resources.
            </p>
            <p class="text">
                <span>By</span>
                signing-up, you agree to the terms and conditions of this system.
            </p>
            <div class="form-field">
                <a href="./login.php" class="account btn btn-outline-info">Have an Account?</a>
            </div>
        </div>
        <div class="form-right">
            <form action="" method="POST">
                <h2 class="text-uppercase">Registration form</h2>
                <div class="row">
                    <div class="col-sm-6 mb-3">
                        <label>First Name</label>
                        <input type="text" name="first_name" id="first_name" class="input-field">
                        <span class="text-danger"></span>
                    </div>
                    <div class="col-sm-6 mb-3">
                        <label>Last Name</label>
                        <input type="text" name="last_name" id="last_name" class="input-field">
                        <span class="text-danger"></span>
                    </div>
                </div>
                <div class="mb-3">
                    <label>Your Email</label>
                    <input type="email" class="input-field" name="email">
                    <span class="text-danger"></span>
                </div>
                <div class="row">
                    <div class="col-sm-6 mb-3">
                        <label>Password</label>
                        <input type="password" name="pwd" id="pwd" class="input-field">
                        <span class="text-danger"></span>
                    </div>
                    <div class="col-sm-6 mb-3">
                        <label>Confirm Password</label>
                        <input type="password" name="cpwd" id="cpwd" class="input-field">
                        <span class="text-danger"></span>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="option">I agree to the <a href="#">Terms and Conditions</a>
                        <input type="checkbox" checked>
                        <span class="checkmark"></span>
                    </label>
                    <span class="text-danger"></span>
                </div>
                <div class="form-field">
                    <input type="submit" value="Register" class="register" name="register">
                </div>
            </form>
        </div>
    </div>
</body>

</html>
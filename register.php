<?php
require_once "./includes/functions.php";
require_once "./includes/config.php";

$firtname = $lastname = $email = $password = $message = $cpass = $agree = "";
$firtname_error = $lastname_error = $email_error = $password_error = $cpass_error = "";

if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['register'])) {
    
    $firtname = input_validator($_POST['firstname']);
    $lastname = input_validator($_POST['lastname']);
    $email = input_validator($_POST['email']);
    $password = input_validator($_POST['password']);
    $cpass = input_validator($_POST['cpass']);

    if ($password !== $cpass) {
        $password_error = "Mismatch!";
        $cpass_error = "Mismatch!";
    }

    if (empty($password_error) && empty($cpass_error)) {
        
        // Register the user
        $result = register($firtname, $lastname, $email, $password);
        
        if ($result == "exists") {
            $message = "<span class='text-warning mb-2'>Email already exists!</span>";
        } else if ($result == "success") {
            $message = "<span class='text-success mb-2'>Registration successful</span>";
        } elseif ($result == "errors") {
            $message = "<span class='text-danger mb-2'>Oops! An error occured</span>";
        } else {
            $message = "";
        }
    }
}


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

<body class="login-body-background">
    <div class="wrapper">
        <div class="form-left pt-5">
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
                <?php echo $message; ?>
                <div class="row">
                    <div class="col-sm-6 mb-2">
                        <label>First Name</label>
                        <input type="text" name="firstname" id="first_name" class="input-field" required>
                    </div>
                    <div class="col-sm-6 mb-2">
                        <label>Last Name</label>
                        <input type="text" name="lastname" id="last_name" class="input-field" required>
                    </div>
                </div>
                <div class="mb-2">
                    <label>Your Email</label>
                    <input type="email" class="input-field" name="email" required>
                    <span class="text-danger"><?php echo $email_error; ?></span>
                </div>
                <div class="row">
                    <div class="col-sm-6 mb-2">
                        <label>Password</label>
                        <input type="password" name="password" id="pwd" class="input-field" required>
                        <span class="text-danger"><?php echo $password_error; ?></span>
                    </div>
                    <div class="col-sm-6 mb-2">
                        <label>Confirm Password</label>
                        <input type="password" name="cpass" id="cpwd" class="input-field" required>
                        <span class="text-danger"><?php echo $cpass_error; ?></span>
                    </div>
                </div>
                <div class="mb-2">
                    <label class="option">I agree to the <a href="#">Terms and Conditions</a>
                        <input type="checkbox" name="agree" required checked>
                        <span class="checkmark"></span>
                    </label>
                </div>
                <div class="form-field">
                    <input type="submit" value="Register" class="register" name="register">
                </div>
            </form>
        </div>
    </div>
</body>

</html>
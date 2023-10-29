<?php
require_once './includes/config.php';
require_once './includes/functions.php';
session_start();

if (isset($_SESSION['loggin']) == true) {
    header("Location: index.php");
} else {
    $email = $password = $email_error = $message = "";

    if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['login'])) {
        // Validate user inputs
        $email = input_validator($_POST['email']);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $email_error = "Supply a valid email!";
        }

        $password = input_validator($_POST['password']);
        

        // Check for error messages before proceeding
        if (empty($email_error)) {          
            $result = login($email, $password);
            if ($result == "Invalid") {
                $message = "<span class='text-warning'>Invalid login credentials</span>";
            } elseif ($result == "Errors") {
                $message = "<span class='text-warning'>Error, try again later</span>";
            } else {
                $message = "";
            }
        }
        mysqli_close($conn);
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Financial Auditor - Account Login</title>
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
        <div class="form-left mt-5">
            <h2 class="text-uppercase">information</h2>
            <p>
                Unlock exclusive benefits by logging in now. Don't miss out on personalized experiences and exciting
                offers that await you on the other side of login!
            </p>
            <p class="text">
                <span>Kindly</span>
                share your login credentials for secure access to the system.
            </p>
            <div class="form-field">
                <a href="./register.php" class="account btn btn-outline-info">Don't Have an Account?</a>
            </div>
        </div>
        <div class="form-right mt-5">
            <form action="" method="POST">
                <h2 class="text-uppercase">Login form</h2>
                <?php echo $message; ?>
                <div class="input-group mb-3">
                    <label>Your Email</label>
                    <input type="email" class="input-field" name="email" required>
                    <span class="text-danger"><?php echo $email_error; ?></span>
                </div>

                <div class="input-group mb-3">
                    <label>Password</label>
                    <input type="password" name="password" id="pwd" class="input-field" required>
                </div>

                <div class="form-field">
                    <input type="submit" value="Login" class="register" name="login">
                </div>
            </form>
        </div>
    </div>
</body>

</html>
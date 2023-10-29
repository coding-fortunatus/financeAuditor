<?php
session_start();
require_once "./includes/functions.php";
require_once "./includes/config.php";

if (isset($_SESSION['loggin']) == true && isset($_SESSION['license']) == true) {
    header("Location: financialStatement.php");
} else {
    if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['continue'])) {
            $agreement = $_POST['agreed'];
        if (proceed($agreement)) {
            $_SESSION['license'] = true;
            header("Location: financialStatement.php");
        } else {
            $_SESSION['license'] = false;
            header("Location: terms.php");
        }
    }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />

    <title>Financial Auditor - License</title>
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
    <!-- ======= Mobile nav toggle button ======= -->
    <i class="bi bi-list mobile-nav-toggle d-xl-none"></i>

    <!-- ======= Header ======= -->
    <header id="header">
        <div class="d-flex flex-column">
            <div class="profile">
                <img src="assets/img/profile-img.jpg" alt="" class="img-fluid rounded-circle" />
                <h1 class="text-light">
                    <a href="index.php">User Agreement</a>
                </h1>
            </div>

            <nav id="navbar" class="nav-menu navbar">
                <ul>
                    <li>
                        <a href="index.php" class="nav-link scrollto"><i class="bx bx-home"></i>
                            <span>Home</span></a>
                    </li>
                    <li>
                        <a href="terms.php" class="nav-link scrollto active"><i class="bx bx-pencil"></i>
                            <span>License</span></a>
                    </li>
                    <li>
                        <a href="financialStatement.php" class="nav-link"><i class="bx bx-file"></i>
                            <span>Financial Statments</span></a>
                    </li>
                    <li>
                        <a href="report.php" class="nav-link scrollto"><i class="bx bx-book-content"></i>
                            <span>Audit Report</span></a>
                    </li>
                </ul>
            </nav>
            <!-- .nav-menu -->
            <a class="nav-item btn btn-danger text-center" href="./includes/logout.php">Logout</a>
        </div>
    </header>
    <!-- End Header -->

    <main id="main">
        <!-- ======= About Section ======= -->
        <section id="about" class="about">
            <div class="container">
                <div class="section-title">
                    <h2>License Agreement</h2>
                    <p>
                        This Audit Process License Agreement is entered into between Financial Auditing System, and the
                        user of the web-based financial statement auditing system.
                    </p>
                </div>

                <div class="row">
                    <div class="col-lg-4" data-aos="fade-right">
                        <img src="assets/img/profile-img.jpg" class="img-fluid" alt="" />
                    </div>
                    <div class="col-lg-8 pt-4 pt-lg-0 content" data-aos="fade-left">
                        <h3>By accessing and using the System, User agrees to the following terms:</h3>
                        <p class="fst-italic">
                            <span class="h5 text-danger">License Grant:</span>
                            Company grants User a non-exclusive, non-transferable license to access and use the System
                            solely for the purpose of conducting financial statement audits.
                        </p>
                        <p class="fst-italic">
                            <span class="h5 text-danger">No Warranty:</span>
                            The System is provided "as is," without warranties of any kind. Company shall not be liable
                            for any damages arising from System use.
                        </p>
                        <p class="fst-italic">
                            <span class="h5 text-danger">Audit Term:</span>
                            This Agreement is effective upon User's acceptance and shall continue until terminated.
                            Either party may terminate this Agreement at any time.
                        </p>
                        <p>
                            By accessing the System, User acknowledges understanding and acceptance of the terms
                            outlined
                            in this Agreement.
                        </p>
                        <div>
                            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="checkbox" value="" name="agreed"
                                        id="flexCheckDefault" required>
                                    <label class="form-check-label" for="flexCheckDefault">
                                        I agree with the license statements.
                                    </label>
                                </div>
                                <div class="d-grid d-md-block">
                                    <input class="btn btn-primary" value="Continue" name="continue" type="submit">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End About Section -->
    </main>
    <!-- End #main -->


    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
    <script src="assets/vendor/aos/aos.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="assets/vendor/typed.js/typed.umd.js"></script>
    <script src="assets/vendor/waypoints/noframework.waypoints.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script>
</body>

</html>
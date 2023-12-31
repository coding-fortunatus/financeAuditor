<?php
session_start();
require_once "./includes/functions.php";
require_once "./includes/config.php";

require_once "./vendor/autoload.php";
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

if (isset($_SESSION['loggin']) == true && (isset($_SESSION['license']) == true)) {
    $message = $user_id = "";

    // Process Budget datas
    if (isset($_POST['financial_budgets'])) {
        // Allowed mime types
        $excelMimes = array('text/xls', 'text/xlsx', 'application/excel', 'application/vnd.msexcel', 'application/vnd.ms-excel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

        // Validate the uploaded file if it's excel file
        if (!empty($_FILES['budgets']['name']) && in_array($_FILES['budgets']['type'], $excelMimes)) {
            // check if the file is uploaded using POST method
            if (is_uploaded_file($_FILES['budgets']['tmp_name'])) {
                $budget_reader = new Xlsx();
                $spreadsheets = $budget_reader->load($_FILES['budgets']['tmp_name']);
                $worksheet = $spreadsheets->getActiveSheet();
                $worksheet_array = $worksheet->toArray();

                // Header row from the data
                unset($worksheet_array[0]);

                foreach($worksheet_array as $row) {
                    $item_name = $row[0];
                    $quantity = (int)$row[1];
                    $budget_price = (float)$row[2];
                    $total_price = (float)$row[3];

                    $user_id = $_SESSION['user_id'];

                    $insert = "INSERT INTO budgets (user_id, item_name, quantity, budget_price, totals)VALUES($user_id, '$item_name', $quantity, $budget_price, $total_price)";
                    if (mysqli_query($conn, $insert)) {
                        $message = "<span class='text-info'>Budgets successfully uploaded</span>";
                    } else {
                        $message = "<span class='text-warning'>An error occured, try again later</span>";
                    }
                }
            }
        }else {
            $message = "<span class='text-warning'>Expenses invalid file type</span>";
        }
    }

    // Process Expenses Data
    if (isset($_POST['financial_expenditure'])) {
        // Allowed mime types
        $excelMimes = array('text/xls', 'text/xlsx', 'application/excel', 'application/vnd.msexcel', 'application/vnd.ms-excel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

        // Validate the uploaded file if it's excel file
        if (!empty($_FILES['expenses']['name']) && in_array($_FILES['expenses']['type'], $excelMimes)) {
            // check if the file is uploaded using POST method
            if (is_uploaded_file($_FILES['expenses']['tmp_name'])) {
                $reader = new Xlsx();
                $spreadsheet = $reader->load($_FILES['expenses']['tmp_name']);
                $worksheet = $spreadsheet->getActiveSheet();
                $worksheet_arr = $worksheet->toArray();

                // Header row from the data
                unset($worksheet_arr[0]);

                foreach($worksheet_arr as $row) {
                    $item_name = $row[0];
                    $quantity = (int)$row[1];
                    $actual_price = (float)$row[2];
                    $total_price = (float)$row[3];

                    $user_id = $_SESSION['user_id'];

                    // Check if there are expenses uploaded by the current user
                    $insert = "INSERT INTO expenses(user_id, item_name, quantity, actual_price, totals)VALUES($user_id, '$item_name', $quantity, $actual_price, $total_price)";
                    if (mysqli_query($conn, $insert)) {
                        $message = "<span class='text-info'>Expenses successfully uploaded</span>";
                    } else {
                        $message = "<span class='text-warning'>Expenses an error occured, try again later</span>";
                    }
                }
            }
        } else {
            $message = "<span class='text-warning'>Expenses invalid file type</span>";
        }
    }
} else {
    header("Location: terms.php");
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />

    <title>Financial Auditor - Financial Statements</title>
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
                    <a href="index.php">Budgets & Expenses</a>
                </h1>
            </div>

            <nav id="navbar" class="nav-menu navbar">
                <ul>
                    <li>
                        <a href="index.php" class="nav-link scrollto"><i class="bx bx-home"></i>
                            <span>Home</span></a>
                    </li>
                    <li>
                        <a href="terms.php" class="nav-link scrollto"><i class="bx bx-pencil"></i>
                            <span>License</span></a>
                    </li>
                    <li>
                        <a href="financialStatement.php" class="nav-link active"><i class="bx bx-file"></i>
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
                    <h2>Upload Financial Statments (Budgets and Expenditures)</h2>
                </div>
                <?php echo $message; ?>
                <div class="card">
                    <div class="card-header">
                        <ul class="nav nav-tabs card-header-tabs">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="true"
                                    href="./financialStatement.php">Upload</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="./view_statement.php">View Statments</a>
                            </li>
                        </ul>
                    </div>
                    <div class="row mt-3 p-3">
                        <div class="col-sm-6 mb-3">
                            <div class="card">
                                <div class="card-header bg-secondary text-white">Financial Budgets</div>
                                <div class="card-body">
                                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST"
                                        enctype="multipart/form-data">
                                        <div class="input-group mb-3">
                                            <input type="file" class="form-control" accept=".xls, .xlsx" name="budgets"
                                                id="budgets" required>
                                        </div>
                                        <div class="d-grid d-md-block">
                                            <input class="btn btn-primary" value="Upload Budgets"
                                                name="financial_budgets" type="submit">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 mb-3">
                            <div class="card">
                                <div class="card-header bg-secondary text-white">Financial Expenditures</div>
                                <div class="card-body">
                                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST"
                                        enctype="multipart/form-data">
                                        <div class="input-group mb-3">
                                            <input type="file" accept=".xls, .xlsx" class="form-control" name="expenses"
                                                id="expenses" required>
                                        </div>
                                        <div class="d-grid d-md-block">
                                            <input class="btn btn-primary" value="Upload Expenses"
                                                name="financial_expenditure" type="submit">
                                        </div>
                                    </form>
                                </div>
                            </div>
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
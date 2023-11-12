<?php
session_start();
require_once "./includes/functions.php";
require_once "./includes/config.php";

if (isset($_SESSION['loggin']) == true && isset($_SESSION['license']) == true) {
    $reports = "reports";
    $id = $_SESSION['user_id'];
    // Get all budgets in the database
    $budget_table = "budgets";
    $budgets = displayStatements($id, $budget_table);

    // Get all expenses in the database
    $expenses_table = "expenses";
    $expenses = displayStatements($id, $expenses_table);

    if (isset($_POST['delete'])) {
        $status1 = deleteStatements($id, $budget_table);
        $status2 = deleteStatements($id, $expenses_table);
        $status3 = deleteStatements($id, $reports);
        if ($status1 == true && $status2 == true && $status3 == true) {
            echo '
            <script>
                alert("Are you sure you want to delete!");
            </script>
            ';
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
                    <h2>View Financial Statments (Budgets and Expenditures)</h2>
                </div>
                <div class="row mt-0 pt-0">
                    <div class="col-3 mt-0 pt-0 mb-2">
                        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                            <div class="d-grid d-md-block">
                                <input class="btn btn-outline-danger" value="Truncate Statements" name="delete"
                                    type="submit">
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card shadow">
                    <div class="card-header">
                        <ul class="nav nav-tabs card-header-tabs">
                            <li class="nav-item">
                                <a class="nav-link" href="./financialStatement.php">Upload</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="true" href="./view_statement.php">View
                                    Statments</a>
                            </li>
                        </ul>
                    </div>
                    <div class="row mt-3 p-3">
                        <div class="col-sm-12 col-md-12 col-lg-6 mb-3 gx-5">
                            <table class="table table-bordered border-primary table-hover table-reponsive">
                                <div class="table-caption">Financial Budgets</div>
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Item Name</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Budget price (₦)</th>
                                        <th scope="col">Total (₦)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        if (mysqli_num_rows($budgets) > 0) {
                                            while ($row = mysqli_fetch_assoc($budgets)) {
                                                echo "
                                                <tr>
                                                    <th scope='row'>".$row['id']."</th>
                                                    <td>".$row['item_name']."</td>
                                                    <td>".$row['quantity']."</td>
                                                    <td>".$row['budget_price']."</td>
                                                    <td>".$row['totals']."</td>
                                                </tr>
                                                ";
                                            }
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-6 mb-3 gx-5">
                            <table class="table table-bordered border-danger table-hover table-reponsive">
                                <div class="table-caption">Financial Expenditures</div>
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Item Name</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Actual price (₦)</th>
                                        <th scope="col">Total (₦)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        if (mysqli_num_rows($expenses) > 0) {
                                            while ($row = mysqli_fetch_assoc($expenses)) {
                                                echo "
                                                <tr>
                                                    <th scope='row'>".$row['id']."</th>
                                                    <td>".$row['item_name']."</td>
                                                    <td>".$row['quantity']."</td>
                                                    <td>".$row['actual_price']."</td>
                                                    <td>".$row['totals']."</td>
                                                </tr>
                                                ";
                                            }
                                        }
                                    ?>
                                </tbody>
                            </table>
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
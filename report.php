<?php
session_start();
require_once "./includes/functions.php";
require_once "./includes/config.php";

if (isset($_SESSION['loggin']) == true && isset($_SESSION['license']) == true) {

    // 
    $user_id = $_SESSION['user_id'];
    $report_table = "reports";
    // Check if the audit report is generated all ready
    $reports = displayStatements($user_id, $report_table);
    if (mysqli_num_rows($reports) == 0) {
        makeReports($user_id);
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
    <i class="d-print-none bi bi-list bg-info mobile-nav-toggle d-xl-none"></i>

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
                        <a href="index.php" class="nav-link"><i class="bx bx-home"></i>
                            <span>Home</span></a>
                    </li>
                    <li>
                        <a href="terms.php" class="nav-link"><i class="bx bx-pencil"></i>
                            <span>License</span></a>
                    </li>
                    <li>
                        <a href="financialStatement.php" class="nav-link"><i class="bx bx-file"></i>
                            <span>Financial Statments</span></a>
                    </li>
                    <li>
                        <a href="report.php" class="nav-link active"><i class="bx bx-book-content"></i>
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
                <div class="section-title d-print-none">
                    <h2>View Financial Reports</h2>
                    <form>
                        <div class="row">
                            <div class="col-2">
                                <button type="button" class="btn btn-info" onclick="window.print()">
                                    <i class="bi bi-printer"></i> Export</button>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="card shadow d-lg-block d-print-block">
                    <div class="d-none d-print-block">
                        <h2 class="h2 mb-3 text-center fw-bold">AUDIT REPORT</h2>
                    </div>
                    <div class="row mt-2 p-3">
                        <div class="col-md-12 col-sm-8">
                            <table class="table table-bordered border-primary table-hover table-reponsive">
                                <div class="table-caption">Audit Overviews</div>
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Item Name</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Budget price (₦)</th>
                                        <th scope="col">Actual price (₦)</th>
                                        <th scope="col">Differences (₦)</th>
                                        <th scope="col">Variances (%)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $total_budget_price = 0;
                                    $total_actual_price = 0;
                                    $total_diffs = 0;
                                        if (mysqli_num_rows($reports) > 0) {
                                            while ($row = mysqli_fetch_assoc($reports)) {
                                                $total_budget_price += $row['budget_price'];
                                                $total_actual_price += $row['actual_price'];
                                                $total_diffs += $row['differences'];
                                                echo "
                                                <tr>
                                                    <th scope='row'>".$row['id']."</th> 
                                                    <td>".$row['item_name']."</td>
                                                    <td>".$row['quantity']."</td>
                                                    <td>".number_format($row['budget_price'])."</td>
                                                    <td>".number_format($row['actual_price'])."</td>
                                                    <td class=".colorize($row['differences']).">".number_format($row['differences'])."</td>
                                                    <td>".getVariance($row['actual_price'], $row['budget_price'])."</td>
                                                </tr>
                                                ";
                                            }
                                        }
                                    ?>
                                    <tr>
                                        <td class="text-center bg-dark"></td>
                                        <td class="text-center bg-dark"></td>
                                        <td class="fw-bold">Totals</td>
                                        <td class="bg-info text-white"><?= number_format($total_budget_price) ?>
                                        </td>
                                        <td class="bg-success text-white"><?= number_format($total_actual_price) ?>
                                        </td>
                                        <td class="bg-warning text-white"><?= number_format($total_diffs) ?></td>
                                        <td class="bg-danger text-white">
                                            <?= getVariance($total_actual_price, $total_budget_price) ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-none d-print-block m-2 p-3">
                <!-- <h2 class="h2 mb-3 text-center fw-bold">AUDIT REPORT</h2> -->
                <h5 class="h5 mt-3 mb-3">The table above show an overview of the user financial statement audit
                    report.
                </h5>
                <h5 class="h5 mb-2">In Auditing Financial Statemets;</h5>
                <ol>
                    <li class="h5 mb-2">When expenses are below the budget, it might be described as a <span
                            class="fw-bold">Favorable
                            Variance</span>
                    </li>
                    <li class="h5 mb-2">When expenses are exactly on budget, it often termed <span
                            class="fw-bold capitalized">Zero
                            Variance</span>
                    </li>
                    <li class="h5 mb-2">When expenses exceed the budget, it's referred to as an <span
                            class="fw-bold">Unfavorable
                            Variance</span> or <span class="fw-bold">Adverse
                            Variance</span>
                    </li>
                </ol>
                <p class="h5 mb-2">These terms help auditors and stakeholders understand
                    the variations between planned and actual expenses.
                </p>
                <p class="h5 mb-2">
                <h4 class="mb-2 fw-bold">Variance Explained</h4>
                Variance in these system is the percentage(%) increase (+ve differences)
                between the budge price and actual price. The formula is as folows; <br>
                VARIANCE = ((actual price - budget price ) / actual price) * 100%
                </p>
                <p class="h5 mb-2">
                <h4 class="mb-2 fw-bold">Audit Conclusion</h4>
                In the context of your financial statement <?php echo $_SESSION['firstname'] ?>, your financial
                statement variance is <?= getVariance($total_actual_price, $total_budget_price) ?> therefore, we
                conclude the your statement is having
                <span class="fw-bold text-warning">
                    <?php if (getVariance($total_actual_price, $total_budget_price) > 0): ?>
                    Unfavorable Variance.
                    <?php elseif(getVariance($total_actual_price, $total_budget_price) < 0): ?>
                    Favorable Variance.
                    <?php else: ?>
                    Zero Variance.
                    <?php endif ?>
                </span>
                </p>
                <p class="h4">
                    Thank you for using our FINANCIAL STATEMENT AUDITING SYSTEM.
                </p>
            </div>
        </section>
        <!-- End About Section -->
    </main>
    <!-- End #main -->


    <a href="#" class="back-to-top d-print-none d-flex align-items-center justify-content-center"><i
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
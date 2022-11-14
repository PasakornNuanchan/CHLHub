<?php
session_start();
?>
<!doctype html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Hope UI | Responsive Bootstrap 5 Admin Dashboard Template</title>
    <?php include '../assets/include/theme_include_css.php'; ?>

</head>

<body class="  ">
    <!-- loader Start -->
    <div id="loading">
        <div class="loader simple-loader">
            <div class="loader-body"></div>
        </div>
    </div>
    <!-- loader END -->
    <!--Sidebar Start-->
    <?php include 'include/sidebarmain.php'; ?>
    <!--Sidebar End-->

    <main class="main-content">
        <div class="position-relative iq-banner">
            <!--Nav Start-->
            <?php include 'include/nevbarmain.php'; ?>
            <!--Nav End-->
        </div>
        <div class="conatiner-fluid content-inner mt-n5 py-0">
            <!-- MAIN BODY START -->
            <div>
                <div class="row">
                    <div class="col-sm-12 col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title text-center">Petty Cash Balance</h4>
                                <h4 class="card-title text-center">18,000.00</h4>
                                <h4 class="card-title text-center">THB</h4>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <p>Petty Cash Waiting for clear</p>
                                <div class="table-responsive mt-4">
                                    <table id="basic-table" class="table table-striped mb-0" role="grid">
                                        <thead>
                                            <tr>
                                                <th>PT. Number</th>
                                                <th>Job</th>
                                                <th>Return</th>
                                                <th>Customs Clearance</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="text-center">
                                                <td>PT220902</td>
                                                <td>2</td>
                                                <td>18,000.00</td>
                                                <td><span class="badge rounded-pill bg-success">Success</span></td>
                                                <td><button class="btn btn-primary rounded-pill btn-xs "><i class="bi bi-eye"></i> Check</button></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title text-center">Advance Cash Balance</h4>
                                <h4 class="card-title text-center">21,000.00</h4>
                                <h4 class="card-title text-center">THB</h4>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <p>Advance Waiting tranfer</p>
                                <div class="table-responsive mt-4">
                                    <table id="basic-table" class="table table-striped mb-0" role="grid">
                                        <thead>
                                            <tr>
                                                <th>AD. Number</th>
                                                <th>Job</th>
                                                <th>Return</th>
                                                <th>Customs Clearance</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="text-center">
                                                <td>PT220902</td>
                                                <td>2</td>
                                                <td>18,000.00</td>
                                                <td><span class="badge rounded-pill bg-success">Success</span></td>
                                                <td><button class="btn btn-primary rounded-pill btn-xs "><i class="bi bi-eye"></i> Check</button></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <p>Job Not Have Create Advance Cash</p>
                                <div class="table-responsive mt-4">
                                    <table id="basic-table" class="table table-striped mb-0 text-center" role="grid">
                                        <thead>
                                            <tr>
                                                <th>Job Nubmer</th>
                                                <th>Amount</th>
                                                <th>Customs Clearance</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="text-center">
                                                <td>PT220902</td>
                                                <td>17,000.00</td>
                                                <td><span class="badge rounded-pill bg-success">Success</span></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- MAIN BODY END -->
        </div>

        <!-- Footer Section Start -->
        <?php include 'include/footermain.php'; ?>
        <!-- Footer Section End -->
    </main>
    <!-- Wrapper End-->
    <!-- offcanvas start -->
    <?php include 'include/offcanvas.php'; ?>
    <?php include '../assets/include/theme_include_js.php'; ?>
</body>

</html>
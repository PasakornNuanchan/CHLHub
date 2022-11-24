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


            <div class="row mt-5">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body p-0">
                            <div class="mt-4">
                                <table id="basic-table" class="table table-striped table-hover mb-0" role="grid">
                                    <thead>
                                        <tr>
                                            <th>Create Date</th>
                                            <th>Job number</th>
                                            <th>B/L</th>
                                            <th>Carrier</th>
                                            <th>Consignee</th>
                                            <th>Port of discharging</th>
                                            <th>ETA</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>05/09/2022</td>
                                            <td>T2209042</td>
                                            <td>A15CX16008</td>
                                            <td>Wanhai Line c...</td>
                                            <td>WINTEK Co.,ltd</td>
                                            <td>Lamchabang, thailand</td>
                                            <td>2022/09/24</td>
                                            <td>010</td>
                                        </tr>
                                        <tr>
                                            <td>05/09/2022</td>
                                            <td>T2209042</td>
                                            <td>A15CX16008</td>
                                            <td>Wanhai Line c...</td>
                                            <td>WINTEK Co.,ltd</td>
                                            <td>Lamchabang, thailand</td>
                                            <td>2022/09/24</td>
                                            <td>010</td>
                                        </tr>
                                        <tr>
                                            <td>05/09/2022</td>
                                            <td>T2209042</td>
                                            <td>A15CX16008</td>
                                            <td>Wanhai Line c...</td>
                                            <td>WINTEK Co.,ltd</td>
                                            <td>Lamchabang, thailand</td>
                                            <td>2022/09/24</td>
                                            <td>010</td>
                                        </tr>
                                    </tbody>
                                </table>
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
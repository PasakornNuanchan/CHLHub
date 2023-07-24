<?php
include 'core/conn.php';
require 'function/auth/get_session.php';
include 'core/con_path.php';
?>
<!doctype html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Report Customer service</title>
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

            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row mx-auto">
                                <div class="col-xs-2 col-sm-2 col-md-4 col-lg-4 col-xl-4 mx-auto">
                                    <div class="btnmr text-center text-md-start text-lg-start text-xl-start"></div>
                                </div>
                                <div class="col-xs-2 col-sm-2 col-md-4 col-lg-4 col-xl-4 mx-auto">
                                    <div class="h_mounth text-center" style="text-align:center;"></div>
                                </div>
                                <div class="col-xs-2 col-sm-2 col-md-4 col-lg-4 col-xl-4 mx-auto">
                                    <div class="btnmz text-center text-md-end text-lg-end text-xl-end" >
                                        
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="bd-example table-responsive">
                            <table border=1 class="table table-responsive text-center p_data">
                                <thead>
                                    <tr>
                                        <td>Mon</td>
                                        <td>Tue</td>
                                        <td>Wed</td>
                                        <td>Thu</td>
                                        <td>Fri</td>
                                        <td>Sat</td>
                                        <td>Sun</td>
                                    </tr>
                                </thead>
                                <tbody>

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
<script src="js/reportcs-calendar/reportcs_calendar_set.js"></script>

<script>
    $(document).ready(function() {
        sidebar_main.set_data_rows();

        //customs_list_set.set_data_rows();
        reportcs_calendar_set.lunch_page_header();

        reportcs_calendar_set.runtime_lunch();
    });
</script>

<script>
    


</script>
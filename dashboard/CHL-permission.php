<?php
include 'core/conn.php';
require 'function/auth/get_session.php';
?>
<!doctype html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Permission</title>
    <?php include '../assets/include/theme_include_css.php'; ?>
    <?php include 'include/lang_lib.php' ?>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
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

            <!-- breadcrumb -->

            <div class="row">
                <div class="col-md-12 col-xl-3"></div>
                <div class="col-md-12 col-xl-6">
                    <!-- Booking -->
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <div class="header-title">
                                <h4 class="card-title">Setting permission by department</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <label class="control-label col-sm-3 lg-3 align-self-center ">Department</label>
                                <div class="col-sm-9 col-md-9 col-lg-9">
                                    <select name="" id="" class="form-select form-select-sm sel_department" onchange="permission_set.change_department()">
                                        <option value="">pleses select department</option>
                                    </select>
                                </div>
                            </div>
                            <div class="add_menu_select">

                            </div>
                            <div style="float: right">
                                <button class="btn btn-success rounded-pill btn-sm " onclick="permission_set.save_per()"><i class="bi bi-check-square"></i> Save</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-xl-3"></div>
                <!-- container information -->
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
<!-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> -->
<script src="js/permission/permission_default.js"></script>
<script src="js/permission/permission_set.js"></script>


<script>
    $(document).ready(function() {
        sidebar_main.set_data_rows();
        permission_set.run();
    });
</script>
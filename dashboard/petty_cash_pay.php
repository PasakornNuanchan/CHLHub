<?php
include 'core/conn.php';
require 'function/auth/get_session.php';
?>
<!doctype html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Petty cash pay (for Account)</title>
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
                <div class="col-md-12 col-xl-12">
                    <!-- Booking -->
                    <div class="card">
                        <div class="card-body card_body_head_nav">
                            <ul class="nav nav-pills justify-content-center" id="pills-tab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link rounded head_menu active" id="payble" data-bs-toggle="pill" data-bs-target="#payble_tab_target" type="button" role="tab" aria-controls="pills-pettycash" aria-selected="true">Payble</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link rounded head_menu" id="advancecash" data-bs-toggle="pill" data-bs-target="#advancecash_tab_target" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Advance cash</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link rounded head_menu" id="pettycash" data-bs-toggle="pill" data-bs-target="#pettycash_tab_target" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Petty Cash</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link rounded head_menu" id="returnpettycash" data-bs-toggle="pill" data-bs-target="#returnpettycash_tab_target" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Return petty cash</button>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="card p-3">
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade menu_tab show active" id="payble_tab_target" role="tabpanel" aria-labelledby="payble">
                                <div class="bd-example table-responsive">
                                    <table id="myTable" class="table table-hover">
                                        <thead>
                                            <tr class="text-center bg-gradient" style="background-color :#0D47A1; color :aliceblue;">
                                                <th>Create Date Time</th>
                                                <th>Job number</th>
                                                <th>Type</th>
                                                <th>Pay to</th>
                                                <th>Description</th>
                                                <th>amount</th>
                                                <th>currency</th>
                                                <th>Picture</th>
                                                <th>Create By.</th>
                                                <th>stauts</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody style="text-align:center;">
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane fade menu_tab" id="pettycash_tab_target" role="tabpanel" aria-labelledby="pettycash">
                                <div class="bd-example table-responsive">
                                    <table id="myTablept" class="table table-hover">
                                        <thead>
                                            <tr class="text-center bg-gradient" style="background-color :#0D47A1; color :aliceblue;">
                                                <th>Create Date Time</th>
                                                <th>Petty Cash Number</th>
                                                <th>Request by</th>
                                                <th>stauts</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody style="text-align:center;">
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane fade menu_tab" id="advancecash_tab_target" role="tabpanel" aria-labelledby="advancecash">
                                <div class="bd-example table-responsive">
                                    <table id="myTablead" class="table table-hover">
                                        <thead>
                                            <tr class="text-center bg-gradient" style="background-color :#0D47A1; color :aliceblue;">
                                                <th>Create Date Time</th>
                                                <th>Job number</th>
                                                <th>Type</th>
                                                <th>Pay to</th>
                                                <th>Description</th>
                                                <th>amount</th>
                                                <th>currency</th>
                                                <th>Picture</th>
                                                <th>Create By.</th>
                                                <th>stauts</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody style="text-align:center;">
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane fade menu_tab" id="returnpettycash_tab_target" role="tabpanel" aria-labelledby="returnpettycash">
                                <div class="bd-example table-responsive">
                                    <table id="myTablere" class="table table-hover">
                                        <thead>
                                            <tr class="text-center bg-gradient" style="background-color :#0D47A1; color :aliceblue;">
                                            <th>Create Date Time</th>
                                                <th>Petty Cash Number</th>
                                                <th>Request by</th>
                                                <th>stauts</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody style="text-align:center;">
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
<!-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> -->
<script src="js/petty_cash_pay/petty_cash_pay.js"></script>


<script>
    $(document).ready(function() {
        sidebar_main.set_data_rows();
        petty_cash_pay.set_header_page();
    });
</script>


<?php
include 'core/conn.php';
require 'function/auth/get_session.php';
?>
<!doctype html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Debit Note</title>
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
                                    <button class="nav-link rounded active" id="job_detail_tab" data-bs-toggle="pill" data-bs-target="#ar_job_target" type="button" role="tab" aria-controls="pills-home" aria-selected="false">ค้างชำระ AR by job</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link rounded " id="reportcs_tab" data-bs-toggle="pill" data-bs-target="#ap_job_target" type="button" role="tab" aria-controls="pills-profile" aria-selected="true">ค้างชำระ AP by job</button>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="ar_job_target" role="tabpanel" aria-labelledby="job_detail_tab">
                        <div class="card p-4">
                                <div class="card-body">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-sx-3">
                                                <div class="row">
                                                    <div class="col-xl-5 col-lg-5 col-md-5 col-sm-5 col-sx-5 text-end">
                                                        Job number :
                                                    </div>
                                                    <div class="col-xl-7 col-lg-7 col-md-7 col-sm-7 col-sx-7">
                                                        <input type="text" class="form-control form-control-sm inp_job_number_ar_job">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-sx-6">
                                                <div class="row">
                                                    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-sx-2 text-end">
                                                        Date
                                                    </div>
                                                    <div class="col-xl-5 col-lg-5 col-md-5 col-sm-5 col-sx-5">
                                                        <input type="date" class="form-control form-control-sm inp_date_start_ar_job">
                                                    </div>
                                                    <div class="col-xl-5 col-lg-5 col-md-5 col-sm-5 col-sx-5">
                                                        <input type="date" class="form-control form-control-sm inp_date_stop_ar_job">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-sx-3">
                                                <div class="row">
                                                    <div class="col-xl-5 col-lg-5 col-md-5 col-sm-5 col-sx-5 text-end">
                                                        Bill to :
                                                    </div>
                                                    <div class="col-xl-7 col-lg-7 col-md-7 col-sm-7 col-sx-7 ">
                                                        <select class="form-select form-select-sm inp_bill_to_ar_job">
                                                            <option data_type="" value="">ALL</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-sx-3">
                                                <div class="row">
                                                    <div class="col-xl-5 col-lg-5 col-md-5 col-sm-5 col-sx-5 text-end">
                                                        CS Support :
                                                    </div>
                                                    <div class="col-xl-7 col-lg-7 col-md-7 col-sm-7 col-sx-7">
                                                        <select class="form-select form-select-sm inp_cs_support_ar_job">
                                                            <option value="">ALL</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-end">
                                    <button class="btn btn-primary btn-sm rounded" onclick="setting_page.set_ar_by_job()">Search</button>
                                </div>
                            </div>
                            <div class="card p-4">
                                <div class="card-body">
                                    <div class="bd-exsample table-responsive">
                                        <table class="table table-bordered table_data_ar_by_job">
                                            <thead>
                                                <tr class="text-center">
                                                    <th>Create Date</th>
                                                    <th>Bill to</th>
                                                    <th>INV NO.</th>
                                                    <th>MBL</th>
                                                    <th>Container No.</th>
                                                    <th>Container qty.</th>
                                                    <th>Description</th>
                                                    <th>USD</th>
                                                    <th>THB</th>
                                                    <th>RMB</th>
                                                    <th>YEN</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                               
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade " id="ap_job_target" role="tabpanel" aria-labelledby="job_detail_tab">
                            <div class="card p-4">
                                <div class="card-body">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-sx-3">
                                                <div class="row">
                                                    <div class="col-xl-5 col-lg-5 col-md-5 col-sm-5 col-sx-5 text-end">
                                                        Job number :
                                                    </div>
                                                    <div class="col-xl-7 col-lg-7 col-md-7 col-sm-7 col-sx-7">
                                                        <input type="text" class="form-control form-control-sm inp_job_number_ap_job">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-sx-6">
                                                <div class="row">
                                                    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-sx-2 text-end">
                                                        Date
                                                    </div>
                                                    <div class="col-xl-5 col-lg-5 col-md-5 col-sm-5 col-sx-5">
                                                        <input type="date" class="form-control form-control-sm inp_date_start_ap_job">
                                                    </div>
                                                    <div class="col-xl-5 col-lg-5 col-md-5 col-sm-5 col-sx-5">
                                                        <input type="date" class="form-control form-control-sm inp_date_stop_ap_job">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-sx-3">
                                                <div class="row">
                                                    <div class="col-xl-5 col-lg-5 col-md-5 col-sm-5 col-sx-5 text-end">
                                                        Bill to :
                                                    </div>
                                                    <div class="col-xl-7 col-lg-7 col-md-7 col-sm-7 col-sx-7 ">
                                                        <select class="form-select form-select-sm inp_bill_to_ap_job">
                                                            <option data_type="" value="">ALL</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-sx-3">
                                                <div class="row">
                                                    <div class="col-xl-5 col-lg-5 col-md-5 col-sm-5 col-sx-5 text-end">
                                                        CS Support :
                                                    </div>
                                                    <div class="col-xl-7 col-lg-7 col-md-7 col-sm-7 col-sx-7">
                                                        <select class="form-select form-select-sm inp_cs_support_ap_job">
                                                            <option value="">ALL</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-end">
                                    <button class="btn btn-primary btn-sm rounded" onclick="setting_page.set_ap_by_job()">Search</button>
                                </div>
                            </div>
                            <div class="card p-4">
                                <div class="card-body">
                                    <div class="bd-exsample table-responsive">
                                        <table class="table table-bordered table_data_ap_by_job">
                                            <thead>
                                                <tr class="text-center">
                                                    <th>Create Date</th>
                                                    <th>Bill to</th>
                                                    <th>INV NO.</th>
                                                    <th>MBL</th>
                                                    <th>Container No.</th>
                                                    <th>Container qty.</th>
                                                    <th>Description</th>
                                                    <th>USD</th>
                                                    <th>THB</th>
                                                    <th>RMB</th>
                                                    <th>YEN</th>
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
<!-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> -->
<script src="js/debit_note/setting_page.js"></script>
<script src="js/debit_note/setting_default_data.js"></script>


<script>
    $(document).ready(function() {
        sidebar_main.set_data_rows();
        setting_page.set_header_page();
    });
</script>